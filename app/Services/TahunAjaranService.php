<?php

namespace App\Services;

use App\Models\TahunAjaran;
use Exception;

class TahunAjaranService
{
    public function getPaginatedTahunAjaran(array $filters = [], int $perPage = 10)
    {
        $query = TahunAjaran::query();

        if (!empty($filters['search'])) {
            $query->where('tahun', 'like', '%' . $filters['search'] . '%');
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->latest('id')->simplePaginate($perPage)->withQueryString();
    }

    public function createTahunAjaran(array $data)
    {
        return TahunAjaran::create($data);
    }

    public function updateTahunAjaran($id, array $data)
    {
        $tahunAjaran = TahunAjaran::findOrFail($id);
        $tahunAjaran->update($data);
        return $tahunAjaran;
    }

    public function deleteTahunAjaran($id)
    {
        $tahunAjaran = TahunAjaran::findOrFail($id);
        return $tahunAjaran->delete();
    }

    public function getTahunAjaranById($id)
    {
        return TahunAjaran::findOrFail($id);
    }
}
