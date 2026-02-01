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
            
        
        
        
            'Investimentos',
        
            'Supermercado',
        
        
        
            'Assinaturas',
        
            'Farmácia',
        
        
        
        
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate([
                'name' => $name,
                'user_id' => null,
            ]);
        }
    }
}
