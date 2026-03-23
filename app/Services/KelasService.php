<?php

namespace App\Services;

use App\Models\Kelas;
use Exception;

class KelasService
{
    public function getPaginatedKelas(array $filters = [], int $perPage = 10)
    {
        $query = Kelas::with(['jurusan', 'waliKelas']);

        if (!empty($filters['search'])) {
            $query->where('nama_kelas', 'like', '%' . $filters['search'] . '%');
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->latest('id')->simplePaginate($perPage)->withQueryString();
    }

    public function createKelas(array $data)
    {
        return Kelas::create($data);
    }

    public function updateKelas($id, array $data)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->update($data);
        return $kelas;
    }

    public function deleteKelas($id)
    {
        $kelas = Kelas::findOrFail($id);
        return $kelas->delete();
    }

    public function getKelasById($id)
    {
        return Kelas::findOrFail($id);
    }
}
