<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    // Campos liberados para preenchimento
    protected $fillable = [
        'name',
        'user_id',
        'color'
    ];

    /**
     * A categoria pertence a um usuário (ou null para categoria padrão)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A categoria pode ter várias despesas
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }
}
