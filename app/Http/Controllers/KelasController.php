<?php

namespace App\Http\Controllers;

use App\Services\KelasService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class KelasController extends Controller
{
    protected $kelasService;

    public function __construct(KelasService $kelasService)
    {
        $this->kelasService = $kelasService;
    }

    public function index(Request $request)
    {
        if (!$request->wantsJson()) {
            return view('kelas.index');
        }

        try {
            $filters = $request->only(['search', 'status']);
            $perPage = $request->get('per_page', 10);
            $kelas = $this->kelasService->getPaginatedKelas($filters, $perPage);

            return response()->json([
                'success' => true,
                'message' => 'Data Kelas berhasil diambil',
                'data' => $kelas->items(),
                'meta' => [
                    'current_page' => $kelas->currentPage(),
                    'per_page' => $kelas->perPage(),
                    'has_more_pages' => $kelas->hasMorePages()
                ]
            ]);
        } catch (Exception $e) {
            Log::error('Error fetching kelas: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan server.'], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:100',
            'jurusan_id' => 'required|exists:jurusans,id',
            'wali_kelas_id' => 'nullable|exists:gurus,id',
            'status' => 'sometimes|in:aktif,nonaktif'
        ]);

        try {
            $kelas = $this->kelasService->createKelas($validated);
            return response()->json(['success' => true, 'message' => 'Kelas berhasil ditambahkan.', 'data' => $kelas], 201);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan data.'], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $kelas = $this->kelasService->getKelasById($id);
            return response()->json(['success' => true, 'data' => $kelas]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:100',
            'jurusan_id' => 'required|exists:jurusans,id',
            'wali_kelas_id' => 'nullable|exists:gurus,id',
            'status' => 'sometimes|in:aktif,nonaktif'
        ]);

        try {
            $kelas = $this->kelasService->updateKelas($id, $validated);
            return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui.', 'data' => $kelas]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui data.'], 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->kelasService->deleteKelas($id);
            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data.'], 500);
        }
    }
}
