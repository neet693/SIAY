<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Formulir PPDB {{ $student->fullname }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }

        .header {
            display: grid;
            grid-template-columns: auto 1fr auto;
            /* Membagi header menjadi tiga kolom, dengan ukuran otomatis untuk logo dan slogan */
            align-items: center;
            margin-bottom: 20px;
            background-color: #2b6eff;
            height: 100px;
        }

        .logo img,
        .slogan img {
            max-height: 70px;
            /* Sesuaikan dengan ukuran yang diinginkan */
        }

        input[type="checkbox"]:checked {
            color: #2b6eff;
            /* Change the font color of the label when checkbox is checked */
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="logo">
            <img src="{{ asset('app/assets/images/siay-logo.png') }}" alt="Logo Sekolah">
        </div>
        <div class="text-center text-white font-bold">
            <h1>Form Pendaftaran</h1>
            <h2>{{ $student->schoolInformation->academicYear->name }}</h2>
        </div>
        <div class="slogan">
            <img src="{{ asset('app/assets/images/slogan-yahya.png') }}" alt="Logo Sekolah">
        </div>
    </div>


    <div class="text-center font-bold">
        <h1>Form Pendaftaran</h1>
        <h2>{{ $student->schoolInformation->academicYear->name }}</h2>
    </div>

    <div class="school-data p-4">
        <span class="flex items-center">
            <span class="h-px flex-1 bg-black"></span>
            <span class="shrink-0 px-6">Data Umum</span>
            <span class="h-px flex-1 bg-black"></span>
        </span>
        <ul>
            {{-- Fieldset Unit --}}
            <fieldset>
                <div class="flex space-x-4">
                    <li>Unit: </li>

                    <label for="Option1" class="flex cursor-pointer items-start gap-4">
                        <div class="flex items-center">
                            &#8203;
                            <input type="checkbox" class="size-4 rounded border-gray-300" id="Option1" disabled
                                {{ $student->schoolInformation->educationLevel->level_name === 'TK' ? 'checked' : '' }} />
                        </div>

                        <div>
                            <strong class="font-medium text-gray-900"> TK </strong>
                        </div>
                    </label>

                    <label for="Option2" class="flex cursor-pointer items-start gap-4">
                        <div class="flex items-center">
                            &#8203;
                            <input type="checkbox" class="size-4 rounded border-gray-300" id="Option2" disabled
                                {{ $student->schoolInformation->educationLevel->level_name === 'SD' ? 'checked' : '' }} />
                        </div>

                        <div>
                            <strong class="font-medium text-gray-900"> SD </strong>
                        </div>
                    </label>

                    <label for="Option3" class="flex cursor-pointer items-start gap-4">
                        <div class="flex items-center">
                            &#8203;
                            <input type="checkbox" class="size-4 rounded border-gray-300" id="Option3" disabled
                                {{ $student->schoolInformation->educationLevel->level_name === 'SMP' ? 'checked' : '' }} />
                        </div>

                        <div>
                            <strong class="font-medium text-gray-900"> SMP </strong>
                        </div>
                    </label>

                    <label for="Option4" class="flex cursor-pointer items-start gap-4">
                        <div class="flex items-center">
                            &#8203;
                            <input type="checkbox" class="size-4 rounded border-gray-300" id="Option3" disabled
                                {{ $student->schoolInformation->educationLevel->level_name === 'SMA' ? 'checked' : '' }} />
                        </div>

                        <div>
                            <strong class="font-medium text-gray-900"> SMA </strong>
                        </div>
                    </label>
                </div>
            </fieldset>
            <li>Unit: {{ $student->schoolInformation->educationLevel->level_name }}</li>
            <li>Asal Sekolah:{{ $student->schoolInformation->last_school }}</li>
            <li>Mengetahui Sekolah Kristen Yahya dari: {{ $student->schoolInformation->news_from }}</li>
            <!-- Tambahkan data lainnya -->
        </ul>
    </div>

    <div class="student-data p-4">
        <span class="flex items-center">
            <span class="h-px flex-1 bg-black"></span>
            <span class="shrink-0 px-6">Data Siswa</span>
            <span class="h-px flex-1 bg-black"></span>
        </span>

        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="h-32">
                <ul class="p-2">
                    <li>Nama Lengkap: {{ $student->fullname }}</li>
                    <li>Nama Panggilan: {{ $student->nickname }}</li>
                    <li>Jenis Kelamin: {{ $student->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}</li>
                    <li>Tempat Tanggal Lahir: {{ $student->birth_place }}, {{ $student->birth_date->format('d M Y') }}
                    </li>
                    <li>Alamat: {{ $student->studentAddress->student_province }},
                        {{ $student->studentAddress->student_district }},{{ $student->studentAddress->student_regency }},
                        {{ $student->studentAddress->student_village }},{{ $student->studentAddress->address }}</li>
                </ul>
            </div>
            <div class="h-32">
                <ul class="p-2">
                    <li>Kewarganegaraan: {{ $student->citizenship }}</li>
                    <li>Status Tinggal: {{ $student->residenceStatus->status_name }}</li>
                    <li>Status dalam keluarga: Anak ke - {{ $student->child_position }} dari -
                        {{ $student->child_number }}
                        bersaudara</li>
                    <li>Agama: {{ $student->religion->religion_name }}</li>
                    <li>Berjemaat di: {{ $student->studentAddress->address }}</li>
                    <li>Email: {{ $student->email }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="parent-data p-4">
        <span class="flex items-center">
            <span class="h-px flex-1 bg-black"></span>
            <span class="shrink-0 px-6">Data Orangtua / Wali</span>
            <span class="h-px flex-1 bg-black"></span>
        </span>
        <ul>
            @if ($student->residence_status_id === 1)
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <div class="h-32">
                        <ul class="p-2">
                            <li>Nama Ayah: {{ $student->studentParent->dad_name }}</li>
                            <li>Gelar Ayah: {{ $student->studentParent->dad_degree }}</li>
                            <li>Pekerjaan Ayah: {{ $student->studentParent->dad_job }}</li>
                            <li>No. Telp Ayah: {{ $student->studentParent->dad_tel }}</li>
                        </ul>
                    </div>
                    <div class="h-32">
                        <ul class="p-2">
                            <li>Nama Ibu: {{ $student->studentParent->mom_name }}</li>
                            <li>Gelar Ibu: {{ $student->studentParent->mom_degree }}</li>
                            <li>Pekerjaan Ibu: {{ $student->studentParent->mom_job }}</li>
                            <li>No. Telp Ibu: {{ $student->studentParent->mom_tel }}</li>
                            <li>Alamat: {{ $student->studentParent->studentParentAddress->parent_province }},
                                {{ $student->studentParent->studentParentAddress->parent_district }},{{ $student->studentParent->studentParentAddress->parent_regency }},
                                {{ $student->studentParent->studentParentAddress->parent_village }},{{ $student->studentParent->studentParentAddress->address }}
                            </li>
                        </ul>
                    </div>
                </div>
            @else
                <li>Nama Wali: {{ $student->wali->wali_name }}</li>
                <li>Gelar Wali: {{ $student->wali->wali_degree }}</li>
                <li>Pekerjaan Wali: {{ $student->wali->wali_job }}</li>
                <li>Alamat Wali: {{ $student->wali->wali_address }}</li>
                <li>No. Telp Wali: {{ $student->wali->wali_tel }}</li>
            @endif

            <!-- Tambahkan data lainnya -->
        </ul>
    </div>

    <!-- Tombol cetak -->
    <div class="text-center no-print">
        <button
            class="group relative inline-flex items-center overflow-hidden rounded border border-current px-8 py-3 text-indigo-600 focus:outline-none focus:ring active:text-indigo-500"
            onclick="window.print()">
            <span class="absolute -end-full transition-all group-hover:end-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                </svg>

            </span>

            <span class="text-sm font-medium transition-all group-hover:me-4"> Cetak </span>
        </button>
    </div>
</body>

</html>
