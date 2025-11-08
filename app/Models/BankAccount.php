<?php

namespace App\Models;

use App\BankAccountType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'balance',
    ];

    protected $casts = [
        'balance' => 'integer',
        'type' => BankAccountType::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getBalanceAttribute(): float
    {
        $user_id = $this->user_id;

        $income = $this->expenses()->where('user_id', $user_id)->where('type', 'income')->where('status', 'paid')->sum('amount');
        $expense = $this->expenses()->where('user_id', $user_id)->where('type', 'expense')->where('status', 'paid')->sum('amount');

        return ($income - $expense) / 100;
    }

    public function setBalanceAttribute($value): void
    {
        // Remove símbolos e converte vírgula para ponto
        $clean = preg_replace('/[^\d.,]/', '', $value);
        $clean = str_replace(',', '.', $clean);

        $this->attributes['balance'] = (int) round($clean * 100);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }


    protected static function booted(): void
    {
        static::creating(function ($account) {
            $account->user_id ??= Auth::id();
        });
    }
}
