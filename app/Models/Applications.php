<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Applications extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_number',
        'name',
        'email',
        'phone',
        'nim_nisn',
        'institusi',
        'jurusan',
        'total_interns',
        'start_date',
        'end_date',
        'recommendation_letter',
        'proposal',
        'registration_token',
        'token_quota',
        'token_used',
        'status',
    ];

    public function internship(): HasMany
    {
        return $this->hasMany(Internships::class);
    }
}
