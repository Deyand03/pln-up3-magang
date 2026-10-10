<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Internships extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mentor_id',
        'application_id',
        'nim_nisn',
        'department',
        'status',
    ];


    // Function BelongsTo
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function mentor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
    public function applications(): BelongsTo
    {
        return $this->belongsTo(Applications::class);
    }

    // Function HasTo
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendances::class);
    }
    public function logbooks(): HasMany
    {
        return $this->hasMany(Logbooks::class);
    }
    public function evaluation(): HasOne
    {
        return $this->hasOne(Evaluation::class);
    }
}
