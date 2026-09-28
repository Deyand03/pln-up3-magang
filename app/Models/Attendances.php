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
        'status',
        'notes',
    ];

    public function internship(): BelongsTo
    {
        return $this->belongsTo(Internships::class);
    }
}
