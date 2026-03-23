<?php

namespace App\Services;

use App\Models\Jurusan;
use Exception;

class JurusanService
{
    public function getPaginatedJurusan(array $filters = [], int $perPage = 10)
    {
        $query = Jurusan::query();

        if (!empty($filters['search'])) {
            $query->where('nama_jurusan', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('kode_jurusan', 'like', '%' . $filters['search'] . '%');
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->latest('id')->simplePaginate($perPage)->withQueryString();
    }

    public function createJurusan(array $data)
    {
        return Jurusan::create($data);
    }

    public function updateJurusan($id, array $data)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->update($data);
        return $jurusan;
    }

    public function deleteJurusan($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return $jurusan->delete();
    }

    public function getJurusanById($id)
    {
        return Jurusan::findOrFail($id);
    }
}
