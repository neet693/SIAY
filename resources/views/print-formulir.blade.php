<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Formulir PPDB {{ $student->fullname }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            html,
            body {
                margin: 0;
                padding: 0;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>
</head>

<body class="text-sm text-black bg-white">

    <!-- HEADER -->
    <div class="bg-[#2b6eff] text-white grid grid-cols-3 items-center justify-center text-center px-4 py-3 gap-2">
        <div class="flex justify-start">
            <img src="{{ asset('app/assets/images/siay-logo.png') }}" alt="Logo Sekolah" class="h-10 sm:h-12 md:h-16">
        </div>
        <div class="text-center">
            <h1 class="text-sm font-bold leading-tight sm:text-base">SEKOLAH KRISTEN YAHYA</h1>
            <h2 class="text-xs font-semibold leading-tight sm:text-sm">TERAKREDITASI "A"</h2>
            <p class="text-[10px] sm:text-xs leading-tight">Jl. L. L. R. E. Martadinata No. 71A - 73 - Bandung</p>
            <p class="text-[10px] sm:text-xs leading-tight">Telp: +62 22 - 420 6108 , +62 813 2210 8575</p>
            <p class="text-[10px] sm:text-xs leading-tight">Email: info@sekolahyahya.sch.id</p>
        </div>
        <div class="flex justify-end">
            <img src="{{ asset('app/assets/images/slogan-yahya.png') }}" alt="Slogan Sekolah"
                class="h-10 sm:h-12 md:h-16">
        </div>
    </div>

    <!-- TOMBOL CETAK -->
    <div class="my-4 text-center no-print">
        <button onclick="window.print()"
            class="px-6 py-2 font-semibold text-white bg-indigo-600 rounded hover:bg-indigo-700">
            🖨️ Cetak Formulir
        </button>
    </div>

    <!-- FORMULIR -->
    <div class="max-w-4xl px-4 mx-auto">
        <h1 class="mb-2 text-xl font-bold text-center">Form Pendaftaran</h1>
        <h2 class="mb-6 font-semibold text-center text-md">{{ $student->schoolInformation->academicYear->name }}</h2>

        <!-- Data Umum -->
        <div class="mb-6">
            <h3 class="pb-1 mb-2 text-lg font-semibold border-b">Data Umum</h3>
            <ul class="space-y-1 list-disc list-inside">
                <li>Unit Tujuan: <strong>{{ $student->schoolInformation->educationLevel->level_name }}</strong></li>
                <li>Asal Sekolah: {{ $student->schoolInformation->last_school }}</li>
                <li>Mengetahui Sekolah Kristen Yahya dari: {{ $student->schoolInformation->news_from }}</li>
            </ul>
        </div>

        <!-- Data Siswa -->
        <div class="mb-6">
            <h3 class="pb-1 mb-2 text-lg font-semibold border-b">Data Siswa</h3>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <ul class="space-y-1 list-inside">
                    <li>Nama Lengkap: {{ $student->fullname }}</li>
                    <li>Nama Panggilan: {{ $student->nickname }}</li>
                    <li>Jenis Kelamin: {{ $student->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}</li>
                    <li>Tempat, Tanggal Lahir: {{ $student->birth_place }},
                        {{ $student->birth_date->format('d M Y') }}</li>
                    <li>Email: {{ $student->email }}</li>
                </ul>
                <ul class="space-y-1 list-inside">
                    <li>Alamat: {{ $student->studentAddress->student_province }},
                        {{ $student->studentAddress->student_district }},
                        {{ $student->studentAddress->student_regency }},
                        {{ $student->studentAddress->student_village }},
                        {{ $student->studentAddress->address }}</li>
                    <li>Kewarganegaraan: {{ $student->citizenship }}</li>
                    <li>Status Tinggal: {{ $student->residenceStatus->status_name }}</li>
                    <li>Status dalam keluarga: Anak ke-{{ $student->child_position }} dari
                        {{ $student->child_number }} bersaudara</li>
                    <li>Agama: {{ $student->religion->religion_name }}</li>
                    <li>Berjemaat di: {{ $student->studentAddress->address }}</li>
                </ul>
            </div>
        </div>

        <!-- Data Orangtua -->
        <div class="mb-6">
            <h3 class="pb-1 mb-2 text-lg font-semibold border-b">Data Orangtua / Wali</h3>
            @if ($student->residence_status_id == 1)
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <ul class="space-y-1">
                        <li>Nama Ayah: {{ $student->studentParent->dad_name }}</li>
                        <li>Gelar Ayah: {{ $student->studentParent->dad_degree }}</li>
                        <li>Pekerjaan Ayah: {{ $student->studentParent->dad_job }}</li>
                        <li>No. Telp Ayah: {{ $student->studentParent->dad_tel }}</li>
                    </ul>
                    <ul class="space-y-1">
                        <li>Nama Ibu: {{ $student->studentParent->mom_name }}</li>
                        <li>Gelar Ibu: {{ $student->studentParent->mom_degree }}</li>
                        <li>Pekerjaan Ibu: {{ $student->studentParent->mom_job }}</li>
                        <li>No. Telp Ibu: {{ $student->studentParent->mom_tel }}</li>
                        <li>Alamat: {{ $student->studentParent->studentParentAddress->parent_province }},
                            {{ $student->studentParent->studentParentAddress->parent_district }},
                            {{ $student->studentParent->studentParentAddress->parent_regency }},
                            {{ $student->studentParent->studentParentAddress->parent_village }},
                            {{ $student->studentParent->studentParentAddress->address }}</li>
                    </ul>
                </div>
            @else
                <ul class="space-y-1">
                    <li>Nama Wali: {{ $student->wali->wali_name ?? 'Tidak ada' }}</li>
                    <li>Gelar Wali: {{ $student->wali->wali_degree ?? 'Tidak ada' }}</li>
                    <li>Pekerjaan Wali: {{ $student->wali->wali_job ?? 'Tidak ada' }}</li>
                    <li>Alamat Wali: {{ $student->wali->wali_address ?? 'Tidak ada' }}</li>
                    <li>No. Telp Wali: {{ $student->wali->wali_tel ?? 'Tidak ada' }}</li>
                </ul>
            @endif
        </div>

        <!-- Tanggal & Tanda Tangan -->
        <div class="pr-2 mt-10 text-right">
            <p>Bandung, {{ $student->created_at->format('d F Y') }}</p>
            <br><br>
            <p>Orang Tua/Wali,</p>
            <br><br>
            <p>_____________________</p>
        </div>
    </div>

</body>

</html>
