<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

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
        'due_date',
        'category_id',
    ];

    protected $casts = [
        'payment_date' => 'datetime',
        'due_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getAmountAttribute($value)
    {
        return $value / 100;
    }

    public function setAmountAttribute($value)
    {
        // Se já for inteiro ou string só com números → já está em centavos
        if (is_numeric($value) && !str_contains((string) $value, '.') && !str_contains((string) $value, ',')) {
            $this->attributes['amount'] = (int) $value;
            return;
        }

        // Se tiver pontuação, trata como valor em reais
        $clean = preg_replace('/[^\d.,]/', '', (string) $value);

        // Remove milhares e normaliza decimal
        if (str_contains($clean, ',')) {
            $clean = str_replace('.', '', $clean);
            $clean = str_replace(',', '.', $clean);
        }

        $this->attributes['amount'] = (int) round(((float) $clean) * 100);
    }

    protected static function booted()
    {
        static::saving(function ($expense) {
            if (!isset($expense->payment_date) && $expense->status === 'paid') {
                $expense->payment_date = Carbon::parse($expense->payment_date);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
