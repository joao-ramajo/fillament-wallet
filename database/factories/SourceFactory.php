<?php

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
            'color' => $this->faker->hexColor(),
            'is_default' => false,
            'allow_negative' => false,
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
}
