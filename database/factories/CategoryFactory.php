<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => ucfirst($this->faker->word()),
            'color' => $this->faker->hexColor(),
            'user_id' => User::factory(), // padrão: categoria do usuário
        ];
    }

    /**
     * Categoria global (sem dono)
     */
    public function global(): static
    {
        return $this->state(fn () => [
            'user_id' => null,
        ]);
    }

    /**
     * Categoria específica de um usuário
     */
    public function forUser(User $user): static
    {
        return $this->state(fn () => [
            'user_id' => $user->id,
        ]);
    }
}
