<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendances extends Model
{
    use HasFactory;

    protected $fillable = [
        'internship_id',
        'date',
        'check_in',
        'check_out',
        'latitude_in',
        'longitude_in',
        'latitude_out',
        'longitude_out',
        'distance_in',
        'distance_out',
        'surat_izin',
        'status',
        'notes',
        'is_valid',
    ];

    public function internship(): BelongsTo
    {
        return $this->belongsTo(Internships::class, 'internship_id');
    }
}
