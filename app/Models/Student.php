<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Student extends Model
{
    use HasFactory;

    /**
     * Field yang diizinkan untuk mass assignment.
     */
    protected $fillable = [
        'nis',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'kelas_id',
        'status'
    ];

    /**
     * Type casting fomat data
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Relasi belongsTo ke model Kelas.
     */
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    /**
     * Local scope: get data siswa aktif.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Local scope: query filter berdasarkan kelas.
     */
    public function scopeByKelas(Builder $query, $kelas_id): Builder
    {
        return $query->where('kelas_id', $kelas_id);
    }
}
