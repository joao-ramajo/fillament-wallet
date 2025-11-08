<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    /** @use HasFactory<\Database\Factories\ExpenseFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'amount',
        'user_id',
        'status',
        'type',
        'payment_date',
    ];

    protected $casts = [
        'payment_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

   public function getAmountAttribute($value)
{
    // Exibe o valor em reais no painel
    return $value / 100;
}

public function setAmountAttribute($value)
{
    // Remove símbolos e converte para centavos antes de salvar
    $clean = preg_replace('/[^\d.,]/', '', $value);
    $clean = str_replace(',', '.', $clean);

    $this->attributes['amount'] = (int) round($clean * 100);
}

}
