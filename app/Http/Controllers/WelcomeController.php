<?php

namespace App\Http\Controllers;

use App\Models\Student;

class WelcomeController extends Controller
{
    public function index()
    {
        // Jika sudah login, arahkan ke dashboard sesuai role
        if (auth()->check()) {
            return redirect()->route(
                auth()->user()->getRedirectRoute()
            );
        }

        // Banner website sekolah
        $banners = app(SchoolBannerController::class)
            ->getBanners();

        return view('welcome', compact(
            'banners'
        ));
    }
}
