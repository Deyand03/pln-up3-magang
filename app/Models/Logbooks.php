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
        'activity_description',
        'file_proof',
        'approval_status',
        'mentor_notes',
    ];

    public function internship(): BelongsTo
    {
        return $this->belongsTo(Internships::class);
    }
}
