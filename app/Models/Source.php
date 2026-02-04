<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    /** @use HasFactory<\Database\Factories\SourceFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'color',
        'is_default',
        'allow_negative',
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'allow_negative' => 'boolean',
    ];
}
