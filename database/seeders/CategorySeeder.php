<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Alimentação',
            'Transporte',
            'Moradia',
            'Educação',
            'Saúde',
            'Lazer',
            'Investimentos',
            'Compras',
            'Supermercado',
            'Água',
            'Luz',
            'Internet',
            'Telefone',
            'Assinaturas',
            'Impostos',
            'Farmácia',
            'Roupas',
            'Pets',
            'Carro / Moto',
            'Emergências',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate([
                'name' => $name,
                'user_id' => null,
            ]);
        }
    }
}
