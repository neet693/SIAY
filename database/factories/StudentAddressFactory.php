<?php

namespace Database\Factories;

use App\Models\StudentAddress;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentAddress>
 */
class StudentAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = StudentAddress::class;
    public function definition(): array
    {
        // Ambil data provinsi dari API
        $provinces = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')->json();

        // Pilih satu provinsi secara acak
        $selectedProvince = $this->faker->randomElement($provinces);

        // Ambil data kota/kabupaten dari API berdasarkan provinsi
        $regencies = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/{$selectedProvince['id']}.json")->json();

        // Pilih satu kota/kabupaten secara acak
        $selectedRegency = $this->faker->randomElement($regencies);

        // Ambil data kecamatan dari API berdasarkan kota/kabupaten
        $districts = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/districts/{$selectedRegency['id']}.json")->json();

        // Pilih satu kecamatan secara acak
        $selectedDistrict = $this->faker->randomElement($districts);

        // Ambil data desa/kelurahan dari API berdasarkan kecamatan
        $villages = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/villages/{$selectedDistrict['id']}.json")->json();

        // Pilih satu desa/kelurahan secara acak
        $selectedVillage = $this->faker->randomElement($villages);

        return [
            'student_id' => $this->faker->numberBetween(1, 10),
            'student_province' => $selectedProvince['name'],
            'student_regency' => $selectedRegency['name'],
            'student_district' => $selectedDistrict['name'],
            'student_village' => $selectedVillage['name'],
            'address' => $this->faker->address(),
        ];
    }
}
