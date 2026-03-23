<?php

namespace App\Services;

use App\Models\Ruangan;
use Exception;

class RuanganService
{
    public function getPaginatedRuangan(array $filters = [], int $perPage = 10)
    {
        $query = Ruangan::query();

        if (!empty($filters['search'])) {
            $query->where('nama_ruangan', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('kode_ruangan', 'like', '%' . $filters['search'] . '%');
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->latest('id')->simplePaginate($perPage)->withQueryString();
    }

    public function createRuangan(array $data)
    {
        return Ruangan::create($data);
    }

    public function updateRuangan($id, array $data)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->update($data);
        return $ruangan;
    }

    public function deleteRuangan($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return $ruangan->delete();
    }

    public function getRuanganById($id)
    {
        return Ruangan::findOrFail($id);
    }
}
