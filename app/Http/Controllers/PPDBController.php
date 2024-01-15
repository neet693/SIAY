<?php

namespace App\Http\Controllers;

use App\Models\PPDB;
use Illuminate\Http\Request;

class PPDBController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('PPDB.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'education_level_id' => 'required',
            'academic_year_id' => 'required',
            // ... tambahkan validasi lainnya sesuai kebutuhan
        ]);

        // Proses penyimpanan data ke database
        $ppdb = new PPDB();
        $ppdb->education_level_id = $request->education_level_id;
        $ppdb->academic_year_id = $request->academic_year_id;
        $ppdb->news_from = $request->news_from;
        $ppdb->last_school = $request->last_school;
        // ... set semua field yang diperlukan sesuai dengan form Anda

        // Simpan data
        $ppdb->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $step)
    {
        $step = $request->input('step', 1);

        // Tampilkan view sesuai dengan langkah
        if ($step == 1) {
            return view('PPDB.step1');
        } elseif ($step == 2) {
            // Ambil data dari sesi
            $step1Data = session('step1');
            return view('PPDB.step2', compact('step1Data'));
        } else {
            // Handle langkah-langkah berikutnya
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
