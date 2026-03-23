<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kelas',
        'jurusan_id',
        'wali_kelas_id',
        'status',
    ];

    /**
     * Get all students for the kelas.
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'kelas_id');
    }

    /**
     * Get the jurusan for the kelas.
     */
    public function jurusan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

    /**
     * Get the wali kelas (Guru) for the kelas.
     */
    public function waliKelas(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Guru::class, 'wali_kelas_id');
    }
}
