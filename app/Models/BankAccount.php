<?php

namespace App\Models;

use App\BankAccountType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

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

    public function getBalanceAttribute($value): float
    {
        return $value / 100;
    }

    public function setBalanceAttribute($value): void
    {
        // Remove símbolos e converte vírgula para ponto
        $clean = preg_replace('/[^\d.,]/', '', $value);
        $clean = str_replace(',', '.', $clean);

        $this->attributes['balance'] = (int) round($clean * 100);
    }
}
