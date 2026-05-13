<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Models\Source;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class UpdateSourceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    /** @return array<string, ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'size:7'],
            'allow_negative' => ['boolean'],
            'credit_limit' => ['nullable', 'integer', 'min:1'],
            'statement_closing_day' => ['nullable', 'integer', 'between:1,31'],
            'statement_due_day' => ['nullable', 'integer', 'between:1,31'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            $sourceId = (int) $this->route('id');
            $source = Source::query()->find($sourceId);

            if (! $source instanceof Source || ! $source->isCreditCard()) {
                return;
            }

            if (! $this->has('credit_limit') || $this->input('credit_limit') === '') {
                $validator->errors()->add('credit_limit', 'O limite é obrigatório para cartão.');
            }

            if (! $this->has('statement_closing_day') || $this->input('statement_closing_day') === '') {
                $validator->errors()->add('statement_closing_day', 'O dia de fechamento é obrigatório.');
            }

            if (! $this->has('statement_due_day') || $this->input('statement_due_day') === '') {
                $validator->errors()->add('statement_due_day', 'O dia de vencimento é obrigatório.');
            }

            $closingDay = $this->integer('statement_closing_day');
            $dueDay = $this->integer('statement_due_day');

            if (
                $this->filled('statement_closing_day')
                && $this->filled('statement_due_day')
                && $dueDay <= $closingDay
            ) {
                $validator->errors()->add('statement_due_day', 'O vencimento deve ser após o fechamento.');
            }
        });
    }
}
