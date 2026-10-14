<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir PPDB - {{ $student->fullname }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
<style>
    @page {
        size: A4 portrait;
        margin: 8mm;
    }

    * {
        box-sizing: border-box;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
        color: #111827;
        font-size: 12px;
        line-height: 1.5;
    }

    .section-title {
        font-size: 13px;
        font-weight: 700;
        color: #1e40af;
        text-transform: uppercase;
        letter-spacing: .025em;
        padding-bottom: 6px;
        margin-bottom: 10px;
        border-bottom: 1.5px solid #cbd5e1;
    }

    .field {
        margin-bottom: 8px;
        min-width: 0;
        overflow-wrap: anywhere;
    }

    .field-label {
        color: #475569;
        font-size: 10px;
        font-weight: 500;
        display: block;
        margin-bottom: 1px;
    }

    .field-value {
        font-size: 12px;
        font-weight: 600;
        color: #111827;
    }

    .school-header {
        background: #1e40af;
        color: #ffffff;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    .info-box {
        border: 1px solid #cbd5e1;
        border-radius: 7px;
        padding: 12px;
        min-width: 0;
    }

    @media screen {
        body {
            background: #f1f5f9;
            padding: 20px;
        }

        .paper {
            max-width: 800px;
            min-height: 1120px;
            margin: 0 auto;
            padding: 24px;
            background: #ffffff;
            box-shadow: 0 4px 24px rgb(15 23 42 / 8%);
        }
    }

    @media print {
        html,
        body {
            margin: 0;
            padding: 0;
            background: #ffffff;
            font-size: 11px;
            line-height: 1.4;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .no-print {
            display: none !important;
        }

        .paper {
            width: 100%;
            margin: 0;
            padding: 0;
            box-shadow: none;
        }

        .school-header {
            background: #1e40af !important;
            color: #ffffff !important;
        }

        .section-title {
            font-size: 12px;
            margin-bottom: 7px;
            padding-bottom: 4px;
        }

        .info-box {
            padding: 9px;
            border-color: #cbd5e1;
            border-radius: 4px;
        }

        .field {
            margin-bottom: 5px;
        }

        .field-label {
            font-size: 9px;
            color: #475569 !important;
        }

        .field-value {
            font-size: 10.5px;
            color: #111827 !important;
        }

        .avoid-break {
            break-inside: avoid;
            page-break-inside: avoid;
        }
    }
</style>
</head>

<body>

    <div class="no-print flex justify-center gap-3 mb-5">
        <button onclick="window.print()"
            class="rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-800">
            🖨️ Cetak Formulir
        </button>

        <a href="{{ route('dashboard') }}"
            class="rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-100">
            Kembali ke Dashboard
        </a>
    </div>

    <main class="paper">

        <!-- HEADER SEKOLAH -->
        <header class="school-header flex items-center justify-between gap-3 rounded-lg px-4 py-3 mb-4">
            <div class="shrink-0">
                <img src="{{ asset('app/assets/images/siay-logo.png') }}"
                    alt="Logo Sekolah" class="h-12 w-auto object-contain">
            </div>

            <div class="flex-1 text-center">
                <h1 class="text-sm font-bold tracking-wide">
                    SEKOLAH KRISTEN YAHYA
                </h1>
                <p class="text-[9px] font-semibold">TERAKREDITASI "A"</p>
                <p class="mt-1 text-[8px]">
                    Jl. L. L. R. E. Martadinata No. 71A–73, Bandung
                </p>
                <p class="text-[8px]">
                    Telp. +62 22 420 6108 · +62 813 2210 8575
                </p>
                <p class="text-[8px]">info@sekolahyahya.sch.id</p>
            </div>

            <div class="shrink-0">
                <img src="{{ asset('app/assets/images/slogan-yahya.png') }}"
                    alt="Slogan Sekolah" class="h-12 w-auto object-contain">
            </div>
        </header>

        <!-- JUDUL FORMULIR -->
        <div class="mb-4 flex items-center justify-between gap-3">
            <div>
                <h2 class="text-base font-bold text-slate-900">
                    FORMULIR PENDAFTARAN
                </h2>
                <p class="text-xs font-medium text-slate-500">
                    Penerimaan Peserta Didik Baru
                </p>
            </div>

            <div class="text-right">
                <span class="field-label">Tahun Ajaran</span>
                <p class="text-xs font-bold text-blue-800">
                    {{ $student->schoolInformation->academicYear->name }}
                </p>
                <span class="field-label mt-1">Unit Tujuan</span>
                <p class="font-bold">
                    {{ $student->schoolInformation->educationLevel->level_name }}
                </p>
            </div>
        </div>

        <!-- DATA UMUM -->
        <section class="info-box avoid-break mb-3">
            <h3 class="section-title">01 · Informasi Pendaftaran</h3>

            <div class="grid grid-cols-3 gap-x-4">
                <div class="field">
                    <span class="field-label">Unit Tujuan</span>
                    <span class="field-value">
                        {{ $student->schoolInformation->educationLevel->level_name }}
                    </span>
                </div>

                <div class="field">
                    <span class="field-label">Asal Sekolah</span>
                    <span class="field-value">
                        {{ $student->schoolInformation->last_school ?: '-' }}
                    </span>
                </div>

                <div class="field">
                    <span class="field-label">Sumber Informasi</span>
                    <span class="field-value">
                        {{ $student->schoolInformation->news_from ?: '-' }}
                    </span>
                </div>
            </div>
        </section>

        <!-- DATA SISWA -->
        <section class="info-box avoid-break mb-3">
            <h3 class="section-title">02 · Data Calon Siswa</h3>

            <div class="grid grid-cols-2 gap-x-5">
                <div>
                    <div class="field">
                        <span class="field-label">Nama Lengkap</span>
                        <span class="field-value text-xs">
                            {{ $student->fullname }}
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-x-3">
                        <div class="field">
                            <span class="field-label">Nama Panggilan</span>
                            <span class="field-value">{{ $student->nickname ?: '-' }}</span>
                        </div>

                        <div class="field">
                            <span class="field-label">Jenis Kelamin</span>
                            <span class="field-value">
                                {{ $student->gender === 'male' ? 'Laki-laki' : ($student->gender === 'female' ? 'Perempuan' : '-') }}
                            </span>
                        </div>
                    </div>

                    <div class="field">
                        <span class="field-label">Tempat, Tanggal Lahir</span>
                        <span class="field-value">
                            {{ $student->birth_place ?: '-' }},
                            {{ $student->birth_date ? $student->birth_date->format('d-m-Y') : '-' }}
                        </span>
                    </div>

                    <div class="field">
                        <span class="field-label">Email</span>
                        <span class="field-value">{{ $student->email ?: '-' }}</span>
                    </div>

                    <div class="field">
                        <span class="field-label">Kewarganegaraan</span>
                        <span class="field-value">{{ $student->citizenship ?: '-' }}</span>
                    </div>
                </div>

                <div>
                    <div class="field">
                        <span class="field-label">Alamat Lengkap</span>
                        <span class="field-value">
                            {{ $student->studentAddress->address ?? '-' }},
                            {{ $student->studentAddress->student_village ?? '' }},
                            {{ $student->studentAddress->student_district ?? '' }},
                            {{ $student->studentAddress->student_regency ?? '' }},
                            {{ $student->studentAddress->student_province ?? '' }}
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-x-3">
                        <div class="field">
                            <span class="field-label">Agama</span>
                            <span class="field-value">
                                {{ $student->religion->religion_name ?? '-' }}
                            </span>
                        </div>

                        <div class="field">
                            <span class="field-label">Status Tinggal</span>
                            <span class="field-value">
                                {{ $student->residenceStatus->status_name ?? '-' }}
                            </span>
                        </div>
                    </div>

                    <div class="field">
                        <span class="field-label">Urutan Anak</span>
                        <span class="field-value">
                            Anak ke-{{ $student->child_position ?? '-' }}
                            dari {{ $student->child_number ?? '-' }} bersaudara
                        </span>
                    </div>

                    <div class="field">
                        <span class="field-label">Berjemaat di</span>
                        <span class="field-value">
                            {{ $student->studentAddress->church ?? '-' }}
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <!-- DATA ORANG TUA / WALI -->
        <section class="info-box avoid-break mb-3">
            <h3 class="section-title">03 · Data Orang Tua / Wali</h3>

            @if ($student->residence_status_id == 1)
                <div class="grid grid-cols-2 gap-x-5">
                    <div>
                        <p class="mb-2 font-bold text-slate-800">Data Ayah</p>

                        <div class="field">
                            <span class="field-label">Nama Lengkap</span>
                            <span class="field-value">
                                {{ $student->studentParent->dad_name ?? '-' }}
                            </span>
                        </div>

                        <div class="field">
                            <span class="field-label">Gelar</span>
                            <span class="field-value">
                                {{ $student->studentParent->dad_degree ?: '-' }}
                            </span>
                        </div>

                        <div class="field">
                            <span class="field-label">Pekerjaan</span>
                            <span class="field-value">
                                {{ $student->studentParent->dad_job ?: '-' }}
                            </span>
                        </div>

                        <div class="field">
                            <span class="field-label">Nomor Telepon</span>
                            <span class="field-value">
                                {{ $student->studentParent->dad_tel ?: '-' }}
                            </span>
                        </div>
                    </div>

                    <div>
                        <p class="mb-2 font-bold text-slate-800">Data Ibu</p>

                        <div class="field">
                            <span class="field-label">Nama Lengkap</span>
                            <span class="field-value">
                                {{ $student->studentParent->mom_name ?? '-' }}
                            </span>
                        </div>

                        <div class="field">
                            <span class="field-label">Gelar</span>
                            <span class="field-value">
                                {{ $student->studentParent->mom_degree ?: '-' }}
                            </span>
                        </div>

                        <div class="field">
                            <span class="field-label">Pekerjaan</span>
                            <span class="field-value">
                                {{ $student->studentParent->mom_job ?: '-' }}
                            </span>
                        </div>

                        <div class="field">
                            <span class="field-label">Nomor Telepon</span>
                            <span class="field-value">
                                {{ $student->studentParent->mom_tel ?: '-' }}
                            </span>
                        </div>
                    </div>

                    <div class="col-span-2 mt-1">
                        <div class="field">
                            <span class="field-label">Alamat Orang Tua</span>
                            <span class="field-value">
                                {{ $student->studentParent->studentParentAddress->address ?? '-' }},
                                {{ $student->studentParent->studentParentAddress->parent_village ?? '' }},
                                {{ $student->studentParent->studentParentAddress->parent_district ?? '' }},
                                {{ $student->studentParent->studentParentAddress->parent_regency ?? '' }},
                                {{ $student->studentParent->studentParentAddress->parent_province ?? '' }}
                            </span>
                        </div>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-2 gap-x-5">
                    <div class="field">
                        <span class="field-label">Nama Wali</span>
                        <span class="field-value">
                            {{ $student->wali->wali_name ?? '-' }}
                        </span>
                    </div>

                    <div class="field">
                        <span class="field-label">Gelar Wali</span>
                        <span class="field-value">
                            {{ $student->wali->wali_degree ?? '-' }}
                        </span>
                    </div>

                    <div class="field">
                        <span class="field-label">Pekerjaan Wali</span>
                        <span class="field-value">
                            {{ $student->wali->wali_job ?? '-' }}
                        </span>
                    </div>

                    <div class="field">
                        <span class="field-label">Nomor Telepon Wali</span>
                        <span class="field-value">
                            {{ $student->wali->wali_tel ?? '-' }}
                        </span>
                    </div>

                    <div class="field col-span-2">
                        <span class="field-label">Alamat Wali</span>
                        <span class="field-value">
                            {{ $student->wali->wali_address ?? '-' }}
                        </span>
                    </div>
                </div>
            @endif
        </section>

        <!-- PERNYATAAN & TANDA TANGAN -->
        <section class="avoid-break mt-5 flex justify-end">
            <div class="w-56 text-center">
                <p>
                    Bandung,
                    {{ $student->created_at->translatedFormat('d F Y') }}
                </p>

                <p class="mt-1">Orang Tua / Wali,</p>

                <div class="h-12"></div>

                <p class="font-semibold">
                    (........................................)
                </p>
            </div>
        </section>

        <footer class="mt-4 border-t border-slate-200 pt-2 text-center text-[8px] text-slate-400">
            Dokumen pendaftaran calon peserta didik baru · Sekolah Kristen Yahya
        </footer>

    </main>

</body>
</html>