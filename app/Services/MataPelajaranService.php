<?php

namespace App\Services;

use App\Models\MataPelajaran;
use Exception;

class MataPelajaranService
{
    public function getPaginatedMataPelajaran(array $filters = [], int $perPage = 10)
    {
        $query = MataPelajaran::query();

        if (!empty($filters['search'])) {
            $query->where('nama_mapel', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('kode_mapel', 'like', '%' . $filters['search'] . '%');
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->latest('id')->simplePaginate($perPage)->withQueryString();
    }

    public function createMataPelajaran(array $data)
    {
        return MataPelajaran::create($data);
    }

    public function updateMataPelajaran($id, array $data)
    {
        $mapel = MataPelajaran::findOrFail($id);
        $mapel->update($data);
        return $mapel;
    }

    public function deleteMataPelajaran($id)
    {
        $mapel = MataPelajaran::findOrFail($id);
        return $mapel->delete();
    }

    public function getMataPelajaranById($id)
    {
        return MataPelajaran::findOrFail($id);
    }
}
