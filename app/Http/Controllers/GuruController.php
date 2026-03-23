<?php

namespace App\Http\Controllers;

use App\Services\GuruService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class GuruController extends Controller
{
    protected $guruService;

    public function __construct(GuruService $guruService)
    {
        $this->guruService = $guruService;
    }

    public function index(Request $request): JsonResponse
    {
        try {
            $filters = $request->only(['search', 'status']);
            $perPage = $request->get('per_page', 10);
            $gurus = $this->guruService->getPaginatedGurus($filters, $perPage);

            return response()->json([
                'success' => true,
                'message' => 'Data Guru berhasil diambil',
                'data' => $gurus->items(),
                'meta' => [
                    'current_page' => $gurus->currentPage(),
                    'per_page' => $gurus->perPage(),
                    'has_more_pages' => $gurus->hasMorePages()
                ]
            ]);
        } catch (Exception $e) {
            Log::error('Error fetching guru: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan server.'], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nip' => 'nullable|string|max:50|unique:gurus,nip',
            'nama_guru' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'no_telp' => 'nullable|string|max:20',
            'status' => 'sometimes|in:aktif,nonaktif'
        ]);

        try {
            $guru = $this->guruService->createGuru($validated);
            return response()->json(['success' => true, 'message' => 'Guru berhasil ditambahkan.', 'data' => $guru], 201);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan data.'], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $guru = $this->guruService->getGuruById($id);
            return response()->json(['success' => true, 'data' => $guru]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'nip' => 'nullable|string|max:50|unique:gurus,nip,' . $id,
            'nama_guru' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'no_telp' => 'nullable|string|max:20',
            'status' => 'sometimes|in:aktif,nonaktif'
        ]);

        try {
            $guru = $this->guruService->updateGuru($id, $validated);
            return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui.', 'data' => $guru]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui data.'], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->guruService->deleteGuru($id);
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data.'], 500);
        }
    }
}
