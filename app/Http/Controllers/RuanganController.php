<?php

namespace App\Http\Controllers;

use App\Services\RuanganService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class RuanganController extends Controller
{
    protected $ruanganService;

    public function __construct(RuanganService $ruanganService)
    {
        $this->ruanganService = $ruanganService;
    }

    public function index(Request $request): JsonResponse
    {
        try {
            $filters = $request->only(['search', 'status']);
            $perPage = $request->get('per_page', 10);
            $data = $this->ruanganService->getPaginatedRuangan($filters, $perPage);

            return response()->json([
                'success' => true,
                'message' => 'Data Ruangan berhasil diambil',
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
            'nama_ruangan' => 'required|string|max:100',
            'kode_ruangan' => 'required|string|max:20|unique:ruangans,kode_ruangan',
            'kapasitas' => 'required|integer|min:1',
            'status' => 'sometimes|in:aktif,nonaktif'
        ]);

        try {
            $data = $this->ruanganService->createRuangan($validated);
            return response()->json(['success' => true, 'message' => 'Ruangan berhasil ditambahkan.', 'data' => $data], 201);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan data.'], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $data = $this->ruanganService->getRuanganById($id);
            return response()->json(['success' => true, 'data' => $data]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'nama_ruangan' => 'required|string|max:100',
            'kode_ruangan' => 'required|string|max:20|unique:ruangans,kode_ruangan,' . $id,
            'kapasitas' => 'required|integer|min:1',
            'status' => 'sometimes|in:aktif,nonaktif'
        ]);

        try {
            $data = $this->ruanganService->updateRuangan($id, $validated);
            return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui.', 'data' => $data]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui data.'], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->ruanganService->deleteRuangan($id);
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data.'], 500);
        }
    }
}
