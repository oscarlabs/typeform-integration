<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeformResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'response_id',
        'submitted_at',
        'landed_at',
        'questions',
        'answers',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'landed_at' => 'datetime',
        'questions' => 'array',
        'answers' => 'array',
    ];
}
