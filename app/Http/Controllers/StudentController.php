<?php

namespace App\Http\Controllers;

use App\Services\StudentService;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    protected $studentService;

    // Dependency Injection (Service Container API)
    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    /**
     * Display a paginated listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $filters = $request->only(['search', 'kelas_id', 'status']);
            $perPage = $request->get('per_page', 10);
            
            $students = $this->studentService->getPaginatedStudents($filters, $perPage);

            return response()->json([
                'success' => true,
                'message' => 'Data Siswa berhasil diambil',
                'data' => $students->items(),
                'meta' => [
                    'current_page' => $students->currentPage(),
                    'per_page' => $students->perPage(),
                    'has_more_pages' => $students->hasMorePages()
                ]
            ], 200);

        } catch (Exception $e) {
            Log::error('Error fetching students: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server saat mengambil data.',
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request): JsonResponse
    {
        try {
            $student = $this->studentService->createStudent($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Siswa berhasil ditambahkan.',
                'data' => $student
            ], 201);
        } catch (Exception $e) {
            Log::error('Error storing student: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data.'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        try {
            $student = $this->studentService->getStudentById($id);
            return response()->json([
                'success' => true,
                'data' => $student
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data siswa tidak ditemukan.'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, $id): JsonResponse
    {
        try {
            $student = $this->studentService->updateStudent($id, $request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Data siswa berhasil diperbarui.',
                'data' => $student
            ]);
        } catch (Exception $e) {
            Log::error('Error updating student: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data siswa atau siswa tidak ditemukan.'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        try {
            $this->studentService->deleteStudent($id);

            return response()->json([
                'success' => true,
                'message' => 'Siswa berhasil dihapus.'
            ]);
        } catch (Exception $e) {
            Log::error('Error deleting student: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data siswa.'
            ], 500);
        }
    }
}
