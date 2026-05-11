<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Source;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'amount' => $this->faker->numberBetween(100, 50000), // em centavos
            'type' => $this->faker->randomElement(['expense', 'income']),
            'status' => $this->faker->randomElement(['pending', 'paid']),
            'payment_date' => null,
            'purchase_date' => null,
            'due_date' => now()->addDays(rand(1, 30)),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'source_id' => Source::factory(),
            'origin_type' => Expense::ORIGIN_DIRECT,
            'occurrence_type' => Expense::OCCURRENCE_DIRECT,
            'credit_card_statement_id' => null,
            'installment_group_id' => null,
            'installment_number' => null,
            'installment_total' => null,
        ];
    }

    public function paid(): static
    {
        return $this->state(fn () => [
            'status' => 'paid',
            'payment_date' => now(),
        ]);
    }

    public function pending(): static
    {
        return $this->state(fn () => [
            'status' => 'pending',
            'payment_date' => null,
        ]);
    }

    public function withoutCategory(): static
    {
        return $this->state(fn () => [
            'category_id' => null,
        ]);
    }
}
