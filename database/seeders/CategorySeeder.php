<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Alimentação',
            'Transporte',
            'Contas & Serviços',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate([
                'name' => $name,
                'user_id' => null,
            ]);
        }
    }
}
