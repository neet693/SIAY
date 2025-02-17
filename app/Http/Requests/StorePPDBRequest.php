<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePPDBRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'education_level_id' => 'required',
            'academic_year_id' => 'required',
            'news_from' => 'required',
            'last_school' => 'required',
            'fullname' => 'required|string|max:255',
            'nickname' => 'required|string|max:255',
            'citizenship' => 'required',
            'gender' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required',
            'religion_id' => 'required',
            'church_domicile' => 'required',
            'child_position' => 'required',
            'child_number' => 'required',
            'blood_type_id' => 'required',
            'email' => 'required|email|unique:users,email',
            'residence_status_id' => 'required',
            'dad_tel' => 'required',
            'mom_tel' => 'required',
            'dad_name' => 'required|string|max:255',
            'mom_name' => 'required|string|max:255',
            'dad_degree' => 'required',
            'mom_degree' => 'required',
            'dad_job' => 'required',
            'mom_job' => 'required',
            'parent_province' => 'required',
            'parent_regency' => 'required',
            'parent_district' => 'required',
            'parent_village' => 'required',
            'address' => 'required',
            'parentStay' => 'required',
            'transaction_type_id' => 'required',
            'title' => 'required',
            'interview_date' => 'required',
            'method' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'education_level_id.required' => 'Level pendidikan harus dipilih.',
            'academic_year_id.required' => 'Tahun ajaran harus dipilih.',
            'news_from.required' => 'Sumber berita harus diisi.',
            'last_school.required' => 'Sekolah terakhir harus diisi.',
            'fullname.required' => 'Nama lengkap harus diisi.',
            'fullname.string' => 'Nama lengkap harus berupa string.',
            'fullname.max' => 'Nama lengkap maksimal 255 karakter.',
            'nickname.required' => 'Nama panggilan harus diisi.',
            'nickname.string' => 'Nama panggilan harus berupa string.',
            'nickname.max' => 'Nama panggilan maksimal 255 karakter.',
            'citizenship.required' => 'Kewarganegaraan harus dipilih.',
            'gender.required' => 'Jenis kelamin harus dipilih.',
            'birth_place.required' => 'Tempat lahir harus diisi.',
            'birth_date.required' => 'Tanggal lahir harus diisi.',
            'religion_id.required' => 'Agama harus dipilih.',
            'church_domicile.required' => 'Domisili gereja harus diisi.',
            'child_position.required' => 'Posisi anak dalam keluarga harus dipilih.',
            'child_number.required' => 'Nomor anak dalam keluarga harus diisi.',
            'blood_type_id.required' => 'Golongan darah harus dipilih.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'residence_status_id.required' => 'Status tempat tinggal harus dipilih.',
            'dad_tel.required' => 'Nomor telepon ayah harus diisi.',
            'mom_tel.required' => 'Nomor telepon ibu harus diisi.',
            'dad_name.required' => 'Nama ayah harus diisi.',
            'dad_name.string' => 'Nama ayah harus berupa string.',
            'dad_name.max' => 'Nama ayah maksimal 255 karakter.',
            'mom_name.required' => 'Nama ibu harus diisi.',
            'mom_name.string' => 'Nama ibu harus berupa string.',
            'mom_name.max' => 'Nama ibu maksimal 255 karakter.',
            'dad_degree.required' => 'Gelar ayah harus diisi.',
            'mom_degree.required' => 'Gelar ibu harus diisi.',
            'dad_job.required' => 'Pekerjaan ayah harus diisi.',
            'mom_job.required' => 'Pekerjaan ibu harus diisi.',
            'parent_province.required' => 'Provinsi orang tua harus diisi.',
            'parent_regency.required' => 'Kabupaten orang tua harus diisi.',
            'parent_district.required' => 'Kecamatan orang tua harus diisi.',
            'parent_village.required' => 'Desa orang tua harus diisi.',
            'address.required' => 'Alamat harus diisi.',
            'parentStay.required' => 'Status tinggal orang tua harus dipilih.',
            'transaction_type_id.required' => 'Tipe transaksi harus dipilih.',
            'title.required' => 'Jabatan harus diisi.',
            'interview_date.required' => 'Tanggal wawancara harus diisi.',
            'method.required' => 'Metode wawancara harus dipilih.',
        ];
    }
}
