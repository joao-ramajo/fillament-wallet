<?php

declare(strict_types=1);

namespace App\Http\Requests\Dashboard;

use App\Enum\DashboardSummaryCard;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateSummaryCardsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    /** @return array<string, ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'card_ids' => ['required', 'array', 'size:3'],
            'card_ids.*' => ['required', 'string', 'distinct', 'in:'.implode(',', DashboardSummaryCard::values())],
        ];
    }
}
