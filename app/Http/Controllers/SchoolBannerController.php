<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SchoolBannerController extends Controller
{
    /**
     * Website resmi sekolah.
     */
    private string $schoolWebsite = 'https://sekolahyahya.sch.id/';

    /**
     * Cache banner selama 30 menit.
     */
    private int $cacheMinutes = 30;

    /**
     * Ambil banner utama dari website resmi sekolah.
     *
     * Hanya gambar yang memenuhi kriteria:
     * - berasal dari website sekolah
     * - berada di wp-content/uploads
     * - memiliki nama file SKY-Banner
     */
    public function getBanners(): array
    {
        return Cache::remember(
            'school_official_main_banners',
            now()->addMinutes($this->cacheMinutes),
            function () {
                try {
                    $response = Http::timeout(10)
                        ->retry(2, 500)
                        ->withHeaders([
                            'User-Agent' => 'Mozilla/5.0 Laravel PPDB Banner Fetcher',
                            'Accept' => 'text/html,application/xhtml+xml',
                        ])
                        ->get($this->schoolWebsite);

                    if (!$response->successful()) {
                        Log::warning('Gagal mengambil website sekolah.', [
                            'status' => $response->status(),
                        ]);

                        return $this->getFallbackBanners();
                    }

                    $html = $response->body();

                    $banners = $this->extractMainBanners($html);

                    if (empty($banners)) {
                        Log::warning(
                            'Banner utama tidak ditemukan di website sekolah.'
                        );

                        return $this->getFallbackBanners();
                    }

                    Log::info('Banner utama berhasil ditemukan.', [
                        'total' => count($banners),
                        'banners' => $banners,
                    ]);

                    return $banners;
                } catch (\Throwable $e) {
                    Log::error('Error mengambil banner utama.', [
                        'message' => $e->getMessage(),
                    ]);

                    return $this->getFallbackBanners();
                }
            }
        );
    }

    /**
     * Extract hanya banner utama.
     */
    private function extractMainBanners(string $html): array
    {
        $banners = [];

        /**
         * =========================================================
         * 1. Cari element Elementor carousel utama
         * =========================================================
         *
         * Kita tetap mencari element carousel,
         * tetapi URL wajib memiliki:
         *
         * wp-content/uploads
         *
         * dan nama file:
         *
         * SKY-Banner
         */
        preg_match_all(
            '/elementor-carousel-image[^>]*style=["\'][^"\']*background-image\s*:\s*url\([\'"]?([^\'"\)]+)[\'"]?\)/i',
            $html,
            $matches
        );

        if (!empty($matches[1])) {
            foreach ($matches[1] as $url) {
                $this->addMainBanner($banners, $url);
            }
        }

        /**
         * =========================================================
         * 2. Coba pola style sebelum class
         * =========================================================
         */
        preg_match_all(
            '/style=["\'][^"\']*background-image\s*:\s*url\([\'"]?([^\'"\)]+)[\'"]?\)[^"\']*["\'][^>]*class=["\'][^"\']*elementor-carousel-image/i',
            $html,
            $matches
        );

        if (!empty($matches[1])) {
            foreach ($matches[1] as $url) {
                $this->addMainBanner($banners, $url);
            }
        }

        /**
         * =========================================================
         * 3. Cari img yang memiliki SKY-Banner
         * =========================================================
         */
        preg_match_all(
            '/<img[^>]+(?:src|data-src)=["\']([^"\']*SKY-Banner[^"\']*)["\'][^>]*>/i',
            $html,
            $matches
        );

        if (!empty($matches[1])) {
            foreach ($matches[1] as $url) {
                $this->addMainBanner($banners, $url);
            }
        }

        /**
         * =========================================================
         * 4. Cari URL SKY-Banner langsung dari HTML
         * =========================================================
         *
         * Ini menjadi fallback jika struktur Elementor berubah.
         */
        preg_match_all(
            '/(?:https?:)?\/\/[^"\'>\s]+\/wp-content\/uploads\/[^"\'>\s]*SKY-Banner[^"\'>\s]*\.(?:jpg|jpeg|png|webp|avif|gif)/i',
            $html,
            $matches
        );

        if (!empty($matches[0])) {
            foreach ($matches[0] as $url) {
                $this->addMainBanner($banners, $url);
            }
        }

        return array_values($banners);
    }

    /**
     * Tambahkan hanya gambar yang benar-benar merupakan
     * banner utama.
     */
    private function addMainBanner(
        array &$banners,
        ?string $url
    ): void {
        if (!$url) {
            return;
        }

        /**
         * Decode HTML entity.
         */
        $url = html_entity_decode($url);

        /**
         * Bersihkan whitespace dan quote.
         */
        $url = trim($url);
        $url = trim($url, "\"' ");

        if (empty($url)) {
            return;
        }

        /**
         * Protocol-relative URL.
         *
         * //sekolahyahya.sch.id/...
         */
        if (str_starts_with($url, '//')) {
            $url = 'https:' . $url;
        }

        /**
         * Relative URL.
         *
         * /wp-content/uploads/...
         */
        elseif (str_starts_with($url, '/')) {
            $url = rtrim($this->schoolWebsite, '/') . $url;
        }

        /**
         * Pastikan URL valid.
         */
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return;
        }

        /**
         * =========================================================
         * FILTER UTAMA
         * =========================================================
         *
         * Hanya ambil:
         *
         * wp-content/uploads
         *
         * dan:
         *
         * SKY-Banner
         */
        if (!str_contains($url, '/wp-content/uploads/')) {
            return;
        }

        if (
            !str_contains(
                strtolower($url),
                'sky-banner'
            )
        ) {
            return;
        }

        /**
         * Pastikan domain berasal dari website sekolah.
         */
        $host = parse_url($url, PHP_URL_HOST);

        if (
            !$host ||
            !str_ends_with(
                strtolower($host),
                'sekolahyahya.sch.id'
            )
        ) {
            return;
        }

        /**
         * Pastikan ekstensi gambar.
         */
        $path = parse_url($url, PHP_URL_PATH) ?? '';

        $extension = strtolower(
            pathinfo($path, PATHINFO_EXTENSION)
        );

        $allowedExtensions = [
            'jpg',
            'jpeg',
            'png',
            'webp',
            'avif',
            'gif',
        ];

        if (
            !in_array(
                $extension,
                $allowedExtensions,
                true
            )
        ) {
            return;
        }

        /**
         * Hindari duplikat.
         */
        if (!in_array($url, $banners, true)) {
            $banners[] = $url;
        }
    }

    /**
     * Banner fallback.
     */
    private function getFallbackBanners(): array
    {
        return [
            'https://sekolahyahya.sch.id/wp-content/uploads/2026/01/SKY-Banner-3-1-1024x307.webp',

            'https://sekolahyahya.sch.id/wp-content/uploads/2026/01/SKY-Banner-2-1-1024x307.webp',
        ];
    }

    /**
     * Hapus cache banner.
     */
    public function clearCache()
    {
        Cache::forget('school_official_main_banners');

        return response()->json([
            'success' => true,
            'message' => 'Cache banner utama berhasil dihapus.',
        ]);
    }
}
