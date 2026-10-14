<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Logbooks extends Model
{
    use HasFactory;

    protected $fillable = [
        'internship_id',
        'date',
        'jam_mulai',
        'jam_selesai',
        'nama_kegiatan',
        'deskripsi_kegiatan',
        'status',
    ];

    public function internship(): BelongsTo
    {
        return $this->belongsTo(Internships::class, 'internship_id');
    }
}
