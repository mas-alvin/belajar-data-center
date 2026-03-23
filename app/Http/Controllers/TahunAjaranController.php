<?php

namespace App\Http\Controllers;

use App\Services\TahunAjaranService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class TahunAjaranController extends Controller
{
    protected $tahunAjaranService;

    public function __construct(TahunAjaranService $tahunAjaranService)
    {
        $this->tahunAjaranService = $tahunAjaranService;
    }

    public function index(Request $request): JsonResponse
    {
        try {
            $filters = $request->only(['search', 'status']);
            $perPage = $request->get('per_page', 10);
            $data = $this->tahunAjaranService->getPaginatedTahunAjaran($filters, $perPage);

            return response()->json([
                'success' => true,
                'message' => 'Data Tahun Ajaran berhasil diambil',
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
            'tahun' => 'required|string|max:20',
            'semester' => 'required|in:Ganjil,Genap',
            'status' => 'sometimes|in:aktif,nonaktif'
        ]);

        try {
            $data = $this->tahunAjaranService->createTahunAjaran($validated);
            return response()->json(['success' => true, 'message' => 'Tahun Ajaran berhasil ditambahkan.', 'data' => $data], 201);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan data.'], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $data = $this->tahunAjaranService->getTahunAjaranById($id);
            return response()->json(['success' => true, 'data' => $data]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'tahun' => 'required|string|max:20',
            'semester' => 'required|in:Ganjil,Genap',
            'status' => 'sometimes|in:aktif,nonaktif'
        ]);

        try {
            $data = $this->tahunAjaranService->updateTahunAjaran($id, $validated);
            return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui.', 'data' => $data]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui data.'], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->tahunAjaranService->deleteTahunAjaran($id);
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data.'], 500);
        }
    }
}
