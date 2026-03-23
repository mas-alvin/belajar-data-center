<?php

namespace App\Http\Controllers;

use App\Services\JurusanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class JurusanController extends Controller
{
    protected $jurusanService;

    public function __construct(JurusanService $jurusanService)
    {
        $this->jurusanService = $jurusanService;
    }

    public function index(Request $request): JsonResponse
    {
        try {
            $filters = $request->only(['search', 'status']);
            $perPage = $request->get('per_page', 10);
            $data = $this->jurusanService->getPaginatedJurusan($filters, $perPage);

            return response()->json([
                'success' => true,
                'message' => 'Data Jurusan berhasil diambil',
                'data' => $data->items(),
                'meta' => [
                    'current_page' => $data->currentPage(),
                    'per_page' => $data->perPage(),
                    'has_more_pages' => $data->hasMorePages()
                ]
            ]);
        } catch (Exception $e) {
            Log::error('Error fetching jurusan: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan server.'], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama_jurusan' => 'required|string|max:100',
            'kode_jurusan' => 'required|string|max:20|unique:jurusans,kode_jurusan',
            'status' => 'sometimes|in:aktif,nonaktif'
        ]);

        try {
            $jurusan = $this->jurusanService->createJurusan($validated);
            return response()->json(['success' => true, 'message' => 'Jurusan berhasil ditambahkan.', 'data' => $jurusan], 201);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan data.'], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $jurusan = $this->jurusanService->getJurusanById($id);
            return response()->json(['success' => true, 'data' => $jurusan]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'nama_jurusan' => 'required|string|max:100',
            'kode_jurusan' => 'required|string|max:20|unique:jurusans,kode_jurusan,' . $id,
            'status' => 'sometimes|in:aktif,nonaktif'
        ]);

        try {
            $jurusan = $this->jurusanService->updateJurusan($id, $validated);
            return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui.', 'data' => $jurusan]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui data.'], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->jurusanService->deleteJurusan($id);
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data.'], 500);
        }
    }
}
