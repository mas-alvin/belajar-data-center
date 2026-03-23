<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // For standard operations, assume true (or check roles/permissions)
        return true;
    }

    /**
     * Prepare the data for validation.
     * Sanitization input (trimming and standardizing) sebelum validasi.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'nama' => strip_tags(trim($this->nama)),
            // Remove unnecessary whitespaces for safety
            'nis' => preg_replace('/\s+/', '', $this->nis),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     * Strict rules are applied for security and integrity.
     */
    public function rules(): array
    {
        return [
            'nis' => 'required|string|max:20|unique:students,nis',
            'nama' => 'required|string|min:3|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date|before:today',
            'alamat' => 'nullable|string|max:500',
            'kelas_id' => 'required|exists:kelas,id',
            'status' => 'sometimes|in:aktif,nonaktif'
        ];
    }

    /**
     * Set custom messages.
     */
    public function messages(): array
    {
        return [
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah terdaftar pada sistem.',
            'kelas_id.exists' => 'Kelas tidak ditemukan dalam database.',
            'jenis_kelamin.in' => 'Pilih jenis kelamin Laki-laki (L) atau Perempuan (P).'
        ];
    }
}
