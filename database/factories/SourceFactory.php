<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Source;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SourceFactory extends Factory
{
    protected $model = Source::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->word(),
            'type' => Source::TYPE_CASH_LIKE,
            'color' => $this->faker->hexColor(),
            'is_default' => false,
            'allow_negative' => false,
            'credit_limit' => null,
            'statement_closing_day' => null,
            'statement_due_day' => null,
        ];
    }

    public function default()
    {
        return $this->state([
            'is_default' => true,
        ]);
    }

    public function allowNegative()
    {
        return $this->state([
            'allow_negative' => true,
        ]);
    }

    public function creditCard()
    {
        return $this->state([
            'type' => Source::TYPE_CREDIT_CARD,
            'credit_limit' => 500000,
            'statement_closing_day' => 5,
            'statement_due_day' => 10,
            'allow_negative' => false,
        ]);
    }
}
