<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'internship_id',
        'score_discipline',
        'score_performance',
        'score_attitude',
        'score_initiative',
        'final_score',
        'grade',
        'feedback',
    ];

    public function internship(): BelongsTo
    {
        return $this->belongsTo(Internships::class);
    }
}
