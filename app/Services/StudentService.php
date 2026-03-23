<?php

namespace App\Services;

use App\Models\Student;
use Exception;

class StudentService
{
    /**
     * Get paginated students with dynamic filters and eager loading.
     */
    public function getPaginatedStudents(array $filters = [], int $perPage = 10)
    {
        $query = Student::with(['kelas:id,nama_kelas'])
                        ->select(['id', 'nis', 'nama', 'jenis_kelamin', 'kelas_id', 'status']);

        // Filter Search By Name
        if (!empty($filters['search'])) {
            $query->where('nama', 'like', '%' . $filters['search'] . '%');
        }

        // Filter By Kelas
        if (!empty($filters['kelas_id'])) {
            $query->byKelas($filters['kelas_id']);
        }

        // Filter By Status
        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->latest('id')->simplePaginate($perPage)->withQueryString();
    }

    /**
     * Store new student.
     */
    public function createStudent(array $data)
    {
        return Student::create($data);
    }

    /**
     * Update existing student by ID.
     */
    public function updateStudent($id, array $data)
    {
        $student = Student::findOrFail($id);
        $student->update($data);
        return $student;
    }

    /**
     * Delete student by ID.
     */
    public function deleteStudent($id)
    {
        $student = Student::findOrFail($id);
        return $student->delete();
    }

    /**
     * Get single student with relations.
     */
    public function getStudentById($id)
    {
        return Student::with(['kelas:id,nama_kelas,jurusan_id,wali_kelas_id', 'kelas.jurusan', 'kelas.waliKelas'])->findOrFail($id);
    }
}
