<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->has('nama')) {
            $this->merge([
                'nama' => strip_tags(trim($this->nama)),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // $this->route('student') could be the ID or Model itself depending on binding
        $studentId = $this->route('student');
        if (is_object($studentId)) {
            $studentId = $studentId->id;
        }

        return [
            'nis' => ['required', 'string', 'max:20', Rule::unique('students', 'nis')->ignore($studentId)],
            'nama' => 'required|string|min:3|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date|before:today',
            'alamat' => 'nullable|string|max:500',
            'kelas_id' => 'required|exists:kelas,id',
            'status' => 'sometimes|in:aktif,nonaktif'
        ];
    }

    public function messages(): array
    {
        return [
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah digunakan oleh siswa lain.',
            'kelas_id.exists' => 'Kelas tidak ditemukan dalam database.'
        ];
    }
}
