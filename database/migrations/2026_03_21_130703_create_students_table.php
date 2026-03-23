<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Table fields for students: id, nis (unik), nama, jenis_kelamin, tanggal_lahir, alamat, kelas_id (fk), status (aktif/nonaktif)
     * Indexes: nis, kelas_id, status.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->unique();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_lahir');
            $table->text('alamat')->nullable();
            
            // Foreign key to kelas efficiently indexed
            $table->foreignId('kelas_id')
                  ->constrained('kelas')
                  ->onUpdate('cascade')
                  ->onDelete('restrict'); // Data integritas: jangan hapus kelas jika ada siswa
                  
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();

            // Additional composite indexes if needed, but single indexes are requested:
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['kelas_id']);
        });
        Schema::dropIfExists('students');
    }
};
