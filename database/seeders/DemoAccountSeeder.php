<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Source;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DemoAccountSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $user = User::updateOrCreate(
                ['email' => 'demo@kado.local'],
                [
                    'name' => 'Conta Demo Kado',
                    'password' => Hash::make('Aa123123'),
                ]
            );

            // Mantem o seeder idempotente sem acumular dados antigos.
            Expense::where('user_id', $user->id)->delete();
            Category::where('user_id', $user->id)->delete();
            Source::where('user_id', $user->id)->delete();

            $sources = [
                'principal' => Source::create([
                    'user_id' => $user->id,
                    'name' => 'Carteira principal',
                    'color' => '#3B82F6',
                    'is_default' => true,
                    'allow_negative' => true,
                ]),
                'reserva' => Source::create([
                    'user_id' => $user->id,
                    'name' => 'Reserva de emergência',
                    'color' => '#10B981',
                    'is_default' => false,
                    'allow_negative' => false,
                ]),
                'viagem' => Source::create([
                    'user_id' => $user->id,
                    'name' => 'Fundo viagem',
                    'color' => '#8B5CF6',
                    'is_default' => false,
                    'allow_negative' => true,
                ]),
            ];

            $categories = [
                'moradia' => Category::create([
                    'name' => 'Moradia',
                    'color' => '#EF4444',
                    'user_id' => $user->id,
                ]),
                'alimentacao' => Category::create([
                    'name' => 'Alimentação',
                    'color' => '#F59E0B',
                    'user_id' => $user->id,
                ]),
                'transporte' => Category::create([
                    'name' => 'Transporte',
                    'color' => '#06B6D4',
                    'user_id' => $user->id,
                ]),
                'lazer' => Category::create([
                    'name' => 'Lazer',
                    'color' => '#A855F7',
                    'user_id' => $user->id,
                ]),
                'saude' => Category::create([
                    'name' => 'Saúde',
                    'color' => '#14B8A6',
                    'user_id' => $user->id,
                ]),
            ];

            $this->createExpenses($user->id, $sources, $categories);
        });
    }

    private function createExpenses(int $userId, array $sources, array $categories): void
    {
        $expenses = [
            [
                'title' => 'Salário mensal',
                'amount' => 850000,
                'type' => 'income',
                'status' => 'paid',
                'source_id' => $sources['principal']->id,
                'payment_date' => '2026-01-05 09:00:00',
                'created_at' => '2026-01-05 09:00:00',
                'category_id' => null,
            ],
            [
                'title' => 'Aluguel apartamento',
                'amount' => 220000,
                'type' => 'expense',
                'status' => 'paid',
                'source_id' => $sources['principal']->id,
                'payment_date' => '2026-01-06 10:00:00',
                'created_at' => '2026-01-06 10:00:00',
                'category_id' => $categories['moradia']->id,
            ],
            [
                'title' => 'Supermercado mensal',
                'amount' => 68000,
                'type' => 'expense',
                'status' => 'paid',
                'source_id' => $sources['principal']->id,
                'payment_date' => '2026-01-09 19:30:00',
                'created_at' => '2026-01-09 19:30:00',
                'category_id' => $categories['alimentacao']->id,
            ],
            [
                'title' => 'Consulta médica',
                'amount' => 35000,
                'type' => 'expense',
                'status' => 'pending',
                'source_id' => $sources['principal']->id,
                'payment_date' => null,
                'created_at' => '2026-01-12 08:30:00',
                'category_id' => $categories['saude']->id,
            ],
            [
                'title' => 'Uber trabalho',
                'amount' => 2800,
                'type' => 'expense',
                'status' => 'paid',
                'source_id' => $sources['principal']->id,
                'payment_date' => '2026-01-14 18:45:00',
                'created_at' => '2026-01-14 18:45:00',
                'category_id' => $categories['transporte']->id,
            ],
            [
                'title' => 'Transferência para reserva',
                'amount' => 100000,
                'type' => 'income',
                'status' => 'paid',
                'source_id' => $sources['reserva']->id,
                'payment_date' => '2026-01-20 11:00:00',
                'created_at' => '2026-01-20 11:00:00',
                'category_id' => null,
            ],
            [
                'title' => 'Jantar especial',
                'amount' => 18500,
                'type' => 'expense',
                'status' => 'paid',
                'source_id' => $sources['principal']->id,
                'payment_date' => '2026-02-02 21:15:00',
                'created_at' => '2026-02-02 21:15:00',
                'category_id' => $categories['lazer']->id,
            ],
            [
                'title' => 'Salário mensal',
                'amount' => 850000,
                'type' => 'income',
                'status' => 'paid',
                'source_id' => $sources['principal']->id,
                'payment_date' => '2026-02-05 09:00:00',
                'created_at' => '2026-02-05 09:00:00',
                'category_id' => null,
            ],
            [
                'title' => 'Parcela do curso',
                'amount' => 62000,
                'type' => 'expense',
                'status' => 'pending',
                'source_id' => $sources['principal']->id,
                'payment_date' => null,
                'created_at' => '2026-02-08 10:00:00',
                'category_id' => $categories['lazer']->id,
            ],
            [
                'title' => 'Passagem aérea promoção',
                'amount' => 140000,
                'type' => 'expense',
                'status' => 'paid',
                'source_id' => $sources['viagem']->id,
                'payment_date' => '2026-02-10 14:00:00',
                'created_at' => '2026-02-10 14:00:00',
                'category_id' => $categories['lazer']->id,
            ],
            [
                'title' => 'Hotel viagem',
                'amount' => 98000,
                'type' => 'expense',
                'status' => 'overdue',
                'source_id' => $sources['viagem']->id,
                'payment_date' => null,
                'created_at' => '2026-02-12 16:20:00',
                'category_id' => $categories['lazer']->id,
            ],
            [
                'title' => 'Freela website',
                'amount' => 210000,
                'type' => 'income',
                'status' => 'pending',
                'source_id' => $sources['principal']->id,
                'payment_date' => null,
                'created_at' => '2026-02-18 12:10:00',
                'category_id' => null,
            ],
            [
                'title' => 'Farmácia',
                'amount' => 12400,
                'type' => 'expense',
                'status' => 'paid',
                'source_id' => $sources['principal']->id,
                'payment_date' => '2026-03-01 18:00:00',
                'created_at' => '2026-03-01 18:00:00',
                'category_id' => $categories['saude']->id,
            ],
            [
                'title' => 'Combustível',
                'amount' => 24500,
                'type' => 'expense',
                'status' => 'pending',
                'source_id' => $sources['principal']->id,
                'payment_date' => null,
                'created_at' => '2026-03-03 07:45:00',
                'category_id' => $categories['transporte']->id,
            ],
            [
                'title' => 'Aporte reserva',
                'amount' => 75000,
                'type' => 'income',
                'status' => 'paid',
                'source_id' => $sources['reserva']->id,
                'payment_date' => '2026-03-05 09:30:00',
                'created_at' => '2026-03-05 09:30:00',
                'category_id' => null,
            ],
        ];

        foreach ($expenses as $item) {
            Expense::create([
                'title' => $item['title'],
                'amount' => $item['amount'],
                'user_id' => $userId,
                'status' => $item['status'],
                'type' => $item['type'],
                'payment_date' => $item['payment_date'],
                'due_date' => null,
                'category_id' => $item['category_id'],
                'source_id' => $item['source_id'],
                'created_at' => $item['created_at'],
                'updated_at' => $item['created_at'],
            ]);
        }
    }
}
