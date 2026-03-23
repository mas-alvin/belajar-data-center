<?php

namespace App\Services;

use App\Models\Guru;
use Illuminate\Pagination\LengthAwarePaginator;

class GuruService
{
    /**
     * Get paginated and filtered gurus.
     *
     * @param array $filters
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginatedGurus(array $filters = [], int $perPage = 10): \Illuminate\Contracts\Pagination\Paginator
    {
        $query = Guru::query();

        if (!empty($filters['search'])) {
            $query->where('nama_guru', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('nip', 'like', '%' . $filters['search'] . '%');
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->latest()->simplePaginate($perPage)->withQueryString();
    }

    /**
     * Get a guru by ID.
     *
     * @param int $id
     * @return Guru
     */
    public function getGuruById(int $id): Guru
    {
        return Guru::findOrFail($id);
    }

    /**
     * Create a new guru.
     *
     * @param array $data
     * @return Guru
     */
    public function createGuru(array $data): Guru
    {
        return Guru::create($data);
    }

    /**
     * Update an existing guru.
     *
     * @param int $id
     * @param array $data
     * @return Guru
     */
    public function updateGuru(int $id, array $data): Guru
    {
        $guru = $this->getGuruById($id);
        $guru->update($data);
        return $guru;
    }

    /**
     * Delete a guru.
     *
     * @param int $id
     * @return bool|null
     */
    public function deleteGuru(int $id): ?bool
    {
        $guru = $this->getGuruById($id);
        return $guru->delete();
    }
}
