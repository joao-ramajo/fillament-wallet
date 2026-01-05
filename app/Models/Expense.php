<?php

namespace App\Models;

use Carbon\Carbon;
use Filament\Notifications\Notification;
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
        'bank_account_id',
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

    public function bankAccount(): BelongsTo
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function setAmountAttribute($value)
    {
        // Remove símbolos e converte para centavos antes de salvar
        $clean = preg_replace('/[^\d.,]/', '', $value);
        $clean = str_replace(',', '.', $clean);

        $this->attributes['amount'] = (int) round((int) $clean * 100);
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
