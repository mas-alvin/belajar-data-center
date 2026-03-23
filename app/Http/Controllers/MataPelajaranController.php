<?php

namespace App\Http\Controllers;

use App\Services\MataPelajaranService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class MataPelajaranController extends Controller
{
    protected $mapelService;

    public function __construct(MataPelajaranService $mapelService)
    {
        $this->mapelService = $mapelService;
    }

    public function index(Request $request): JsonResponse
    {
        try {
            $filters = $request->only(['search', 'status']);
            $perPage = $request->get('per_page', 10);
            $data = $this->mapelService->getPaginatedMataPelajaran($filters, $perPage);

            return response()->json([
                'success' => true,
                'message' => 'Data Mata Pelajaran berhasil diambil',
                'data' => $data->items(),
                'meta' => [
                    'current_page' => $data->currentPage(),
                    'per_page' => $data->perPage(),
                    'has_more_pages' => $data->hasMorePages()
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan server.'], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama_mapel' => 'required|string|max:100',
            'kode_mapel' => 'required|string|max:20|unique:mata_pelajarans,kode_mapel',
            'kelompok' => 'nullable|string|max:50',
            'status' => 'sometimes|in:aktif,nonaktif'
        ]);

        try {
            $data = $this->mapelService->createMataPelajaran($validated);
            return response()->json(['success' => true, 'message' => 'Mata Pelajaran berhasil ditambahkan.', 'data' => $data], 201);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan data.'], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $data = $this->mapelService->getMataPelajaranById($id);
            return response()->json(['success' => true, 'data' => $data]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'nama_mapel' => 'required|string|max:100',
            'kode_mapel' => 'required|string|max:20|unique:mata_pelajarans,kode_mapel,' . $id,
            'kelompok' => 'nullable|string|max:50',
            'status' => 'sometimes|in:aktif,nonaktif'
        ]);

        try {
            $data = $this->mapelService->updateMataPelajaran($id, $validated);
            return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui.', 'data' => $data]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui data.'], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->mapelService->deleteMataPelajaran($id);
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data.'], 500);
        }
    }
}
