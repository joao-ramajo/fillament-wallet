<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CreditCardStatement;
use App\Models\Expense;
use App\Models\Source;
use App\Models\User;
use DateTimeInterface;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LocalAccountSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function (): void {
            $user = User::query()->updateOrCreate(['email' => 'local@kado.local'], [
                'name' => 'local',
                'password' => Hash::make('Aa123123'),
            ]);

            Expense::query()->where('user_id', $user->id)->delete();
            CreditCardStatement::query()
                ->whereHas('source', fn ($query) => $query->where('user_id', $user->id))
                ->delete();
            Category::query()->where('user_id', $user->id)->delete();
            Source::query()->where('user_id', $user->id)->delete();

            $now = now();

            $categories = $this->createCategories($user->id);
            $sources = $this->createSources($user->id);

            $this->createCashFlows($user->id, $sources, $categories, $now);
            $this->createCardFlows($user->id, $sources, $categories, $now);
        });
    }

    /**
     * @return array<string, Category>
     */
    private function createCategories(int $userId): array
    {
        return [
            'moradia' => Category::query()->create([
                'name' => 'Moradia',
                'color' => '#EF4444',
                'user_id' => $userId,
            ]),
            'alimentacao' => Category::query()->create([
                'name' => 'Alimentação',
                'color' => '#F59E0B',
                'user_id' => $userId,
            ]),
            'transporte' => Category::query()->create([
                'name' => 'Transporte',
                'color' => '#06B6D4',
                'user_id' => $userId,
            ]),
            'saude' => Category::query()->create([
                'name' => 'Saúde',
                'color' => '#14B8A6',
                'user_id' => $userId,
            ]),
            'lazer' => Category::query()->create([
                'name' => 'Lazer',
                'color' => '#A855F7',
                'user_id' => $userId,
            ]),
            'assinaturas' => Category::query()->create([
                'name' => 'Assinaturas',
                'color' => '#3B82F6',
                'user_id' => $userId,
            ]),
            'educacao' => Category::query()->create([
                'name' => 'Educação',
                'color' => '#8B5CF6',
                'user_id' => $userId,
            ]),
            'viagem' => Category::query()->create([
                'name' => 'Viagem',
                'color' => '#EC4899',
                'user_id' => $userId,
            ]),
        ];
    }

    /**
     * @return array<string, Source>
     */
    private function createSources(int $userId): array
    {
        return [
            'carteira' => Source::query()->create([
                'user_id' => $userId,
                'name' => 'Carteira local',
                'type' => Source::TYPE_CASH_LIKE,
                'color' => '#2563EB',
                'is_default' => true,
                'allow_negative' => true,
            ]),
            'salario' => Source::query()->create([
                'user_id' => $userId,
                'name' => 'Conta salário',
                'type' => Source::TYPE_CASH_LIKE,
                'color' => '#10B981',
                'is_default' => false,
                'allow_negative' => false,
            ]),
            'reserva' => Source::query()->create([
                'user_id' => $userId,
                'name' => 'Reserva de emergência',
                'type' => Source::TYPE_CASH_LIKE,
                'color' => '#F59E0B',
                'is_default' => false,
                'allow_negative' => false,
            ]),
            'cartao_principal' => Source::query()->create([
                'user_id' => $userId,
                'name' => 'Cartão Principal',
                'type' => Source::TYPE_CREDIT_CARD,
                'color' => '#EF4444',
                'is_default' => false,
                'allow_negative' => false,
                'credit_limit' => 250000,
                'statement_closing_day' => 5,
                'statement_due_day' => 12,
            ]),
            'cartao_viagem' => Source::query()->create([
                'user_id' => $userId,
                'name' => 'Cartão Viagem',
                'type' => Source::TYPE_CREDIT_CARD,
                'color' => '#8B5CF6',
                'is_default' => false,
                'allow_negative' => false,
                'credit_limit' => 200000,
                'statement_closing_day' => 18,
                'statement_due_day' => 25,
            ]),
        ];
    }

    /** @param array<string, Source> $sources @param array<string, Category> $categories */
    private function createCashFlows(int $userId, array $sources, array $categories, DateTimeInterface $now): void
    {
        $baseMonth = $now->format('Y-m');

        $cashExpenses = [
            [
                'title' => 'Salário local',
                'amount' => 980000,
                'type' => 'income',
                'status' => 'paid',
                'source_id' => $sources['carteira']->id,
                'payment_date' => $baseMonth.'-05 09:00:00',
                'due_date' => null,
                'category_id' => null,
            ],
            [
                'title' => 'Salário adicional',
                'amount' => 125000,
                'type' => 'income',
                'status' => 'pending',
                'source_id' => $sources['salario']->id,
                'payment_date' => null,
                'due_date' => null,
                'category_id' => null,
            ],
            [
                'title' => 'Aluguel',
                'amount' => 245000,
                'type' => 'expense',
                'status' => 'paid',
                'source_id' => $sources['carteira']->id,
                'payment_date' => $baseMonth.'-06 10:00:00',
                'due_date' => $baseMonth.'-06',
                'category_id' => $categories['moradia']->id,
            ],
            [
                'title' => 'Supermercado',
                'amount' => 87600,
                'type' => 'expense',
                'status' => 'paid',
                'source_id' => $sources['carteira']->id,
                'payment_date' => $baseMonth.'-08 18:20:00',
                'due_date' => $baseMonth.'-08',
                'category_id' => $categories['alimentacao']->id,
            ],
            [
                'title' => 'Conta de água',
                'amount' => 34200,
                'type' => 'expense',
                'status' => 'overdue',
                'source_id' => $sources['carteira']->id,
                'payment_date' => null,
                'due_date' => $baseMonth.'-10',
                'category_id' => $categories['moradia']->id,
            ],
            [
                'title' => 'Assinatura de música',
                'amount' => 2990,
                'type' => 'expense',
                'status' => 'pending',
                'source_id' => $sources['salario']->id,
                'payment_date' => null,
                'due_date' => $baseMonth.'-20',
                'category_id' => $categories['assinaturas']->id,
            ],
            [
                'title' => 'Aporte na reserva',
                'amount' => 50000,
                'type' => 'income',
                'status' => 'paid',
                'source_id' => $sources['reserva']->id,
                'payment_date' => $baseMonth.'-12 11:00:00',
                'due_date' => null,
                'category_id' => null,
            ],
            [
                'title' => 'Viagem pendente',
                'amount' => 45000,
                'type' => 'expense',
                'status' => 'pending',
                'source_id' => $sources['reserva']->id,
                'payment_date' => null,
                'due_date' => $baseMonth.'-28',
                'category_id' => $categories['viagem']->id,
            ],
        ];

        foreach ($cashExpenses as $item) {
            Expense::query()->create([
                'title' => $item['title'],
                'amount' => $item['amount'],
                'user_id' => $userId,
                'status' => $item['status'],
                'type' => $item['type'],
                'payment_date' => $item['payment_date'],
                'purchase_date' => null,
                'due_date' => $item['due_date'],
                'category_id' => $item['category_id'],
                'source_id' => $item['source_id'],
                'origin_type' => Expense::ORIGIN_DIRECT,
                'occurrence_type' => Expense::OCCURRENCE_DIRECT,
                'credit_card_statement_id' => null,
                'installment_group_id' => null,
                'installment_number' => null,
                'installment_total' => null,
                'created_at' => $item['payment_date'] ?? $now,
                'updated_at' => $item['payment_date'] ?? $now,
            ]);
        }
    }

    /** @param array<string, Source> $sources @param array<string, Category> $categories */
    private function createCardFlows(int $userId, array $sources, array $categories, DateTimeInterface $now): void
    {
        $currentMonth = $now->copy()->startOfMonth()->toDateString();
        $previousMonth = $now->copy()->subMonthNoOverflow()->startOfMonth()->toDateString();

        $openStatementClosingAt = $now->format('Y-m-d');
        $openStatementClosingAt = date('Y-m-d', strtotime($openStatementClosingAt.' +7 days'));

        $openStatementDueAt = date('Y-m-d', strtotime($openStatementClosingAt.' +7 days'));

        $closedStatementClosingAt = date('Y-m-d', strtotime($now->format('Y-m-d').' -15 days'));
        $closedStatementDueAt = date('Y-m-d', strtotime($closedStatementClosingAt.' +7 days'));

        $paidStatementPaidAt = date('Y-m-d H:i:s', strtotime($now->format('Y-m-d H:i:s').' -8 days'));
        $paidStatementClosingAt = date('Y-m-d', strtotime($paidStatementPaidAt.' -10 days'));
        $paidStatementDueAt = date('Y-m-d', strtotime($paidStatementClosingAt.' +7 days'));

        $openStatement = CreditCardStatement::query()->create([
            'source_id' => $sources['cartao_principal']->id,
            'reference_month' => $currentMonth,
            'closing_at' => $openStatementClosingAt,
            'due_at' => $openStatementDueAt,
            'status' => CreditCardStatement::STATUS_OPEN,
            'total_amount' => 205000,
            'paid_at' => null,
            'payment_source_id' => null,
        ]);

        $closedStatement = CreditCardStatement::query()->create([
            'source_id' => $sources['cartao_principal']->id,
            'reference_month' => $previousMonth,
            'closing_at' => $closedStatementClosingAt,
            'due_at' => $closedStatementDueAt,
            'status' => CreditCardStatement::STATUS_CLOSED,
            'total_amount' => 76000,
            'paid_at' => null,
            'payment_source_id' => null,
        ]);

        $paidStatement = CreditCardStatement::query()->create([
            'source_id' => $sources['cartao_viagem']->id,
            'reference_month' => $previousMonth,
            'closing_at' => $paidStatementClosingAt,
            'due_at' => $paidStatementDueAt,
            'status' => CreditCardStatement::STATUS_PAID,
            'total_amount' => 142000,
            'paid_at' => $paidStatementPaidAt,
            'payment_source_id' => $sources['carteira']->id,
        ]);

        $this->createCardPurchase([
            'user_id' => $userId,
            'source_id' => $sources['cartao_principal']->id,
            'statement_id' => $openStatement->id,
            'title' => 'Notebook - parcela 1',
            'amount' => 60000,
            'status' => 'pending',
            'payment_date' => null,
            'purchase_date' => date('Y-m-d', strtotime($now->format('Y-m-d').' -2 days')),
            'due_date' => $openStatementDueAt,
            'category_id' => $categories['educacao']->id,
            'origin_type' => Expense::ORIGIN_CREDIT_CARD,
            'occurrence_type' => Expense::OCCURRENCE_PURCHASE,
            'installment_group_id' => 'local-notebook-001',
            'installment_number' => 1,
            'installment_total' => 3,
        ]);
        $this->createCardPurchase([
            'user_id' => $userId,
            'source_id' => $sources['cartao_principal']->id,
            'statement_id' => $openStatement->id,
            'title' => 'Notebook - parcela 2',
            'amount' => 60000,
            'status' => 'pending',
            'payment_date' => null,
            'purchase_date' => date('Y-m-d', strtotime($now->format('Y-m-d').' -1 days')),
            'due_date' => $openStatementDueAt,
            'category_id' => $categories['educacao']->id,
            'origin_type' => Expense::ORIGIN_CREDIT_CARD,
            'occurrence_type' => Expense::OCCURRENCE_PURCHASE,
            'installment_group_id' => 'local-notebook-001',
            'installment_number' => 2,
            'installment_total' => 3,
        ]);
        $this->createCardPurchase([
            'user_id' => $userId,
            'source_id' => $sources['cartao_principal']->id,
            'statement_id' => $openStatement->id,
            'title' => 'Notebook - parcela 3',
            'amount' => 60000,
            'status' => 'pending',
            'payment_date' => null,
            'purchase_date' => $now->format('Y-m-d'),
            'due_date' => $openStatementDueAt,
            'category_id' => $categories['educacao']->id,
            'origin_type' => Expense::ORIGIN_CREDIT_CARD,
            'occurrence_type' => Expense::OCCURRENCE_PURCHASE,
            'installment_group_id' => 'local-notebook-001',
            'installment_number' => 3,
            'installment_total' => 3,
        ]);
        $this->createCardPurchase([
            'user_id' => $userId,
            'source_id' => $sources['cartao_principal']->id,
            'statement_id' => $openStatement->id,
            'title' => 'Headset',
            'amount' => 25000,
            'status' => 'pending',
            'payment_date' => null,
            'purchase_date' => $now->format('Y-m-d'),
            'due_date' => $openStatementDueAt,
            'category_id' => $categories['lazer']->id,
            'origin_type' => Expense::ORIGIN_CREDIT_CARD,
            'occurrence_type' => Expense::OCCURRENCE_PURCHASE,
            'installment_group_id' => null,
            'installment_number' => null,
            'installment_total' => null,
        ]);
        $this->createCardPurchase([
            'user_id' => $userId,
            'source_id' => $sources['cartao_principal']->id,
            'statement_id' => $closedStatement->id,
            'title' => 'Smartwatch',
            'amount' => 76000,
            'status' => 'pending',
            'payment_date' => null,
            'purchase_date' => date('Y-m-d', strtotime($now->format('Y-m-d').' -22 days')),
            'due_date' => $closedStatementDueAt,
            'category_id' => $categories['lazer']->id,
            'origin_type' => Expense::ORIGIN_CREDIT_CARD,
            'occurrence_type' => Expense::OCCURRENCE_PURCHASE,
            'installment_group_id' => null,
            'installment_number' => null,
            'installment_total' => null,
        ]);

        $this->createCardPurchase([
            'user_id' => $userId,
            'source_id' => $sources['cartao_viagem']->id,
            'statement_id' => $paidStatement->id,
            'title' => 'Passagem aérea',
            'amount' => 98000,
            'status' => 'paid',
            'payment_date' => $paidStatementPaidAt,
            'purchase_date' => date('Y-m-d', strtotime($paidStatementPaidAt)),
            'due_date' => $paidStatementDueAt,
            'category_id' => $categories['viagem']->id,
            'origin_type' => Expense::ORIGIN_CREDIT_CARD,
            'occurrence_type' => Expense::OCCURRENCE_PURCHASE,
            'installment_group_id' => null,
            'installment_number' => null,
            'installment_total' => null,
        ]);
        $this->createCardPurchase([
            'user_id' => $userId,
            'source_id' => $sources['cartao_viagem']->id,
            'statement_id' => $paidStatement->id,
            'title' => 'Hotel',
            'amount' => 44000,
            'status' => 'paid',
            'payment_date' => $paidStatementPaidAt,
            'purchase_date' => date('Y-m-d', strtotime($paidStatementPaidAt)),
            'due_date' => $paidStatementDueAt,
            'category_id' => $categories['viagem']->id,
            'origin_type' => Expense::ORIGIN_CREDIT_CARD,
            'occurrence_type' => Expense::OCCURRENCE_PURCHASE,
            'installment_group_id' => null,
            'installment_number' => null,
            'installment_total' => null,
        ]);

        Expense::query()->create([
            'title' => 'Pagamento de fatura - Cartão Viagem',
            'amount' => 142000,
            'user_id' => $userId,
            'status' => 'paid',
            'type' => 'expense',
            'payment_date' => $paidStatementPaidAt,
            'purchase_date' => $paidStatement->reference_month->toDateString(),
            'due_date' => $paidStatementDueAt,
            'category_id' => $categories['assinaturas']->id,
            'source_id' => $sources['carteira']->id,
            'origin_type' => Expense::ORIGIN_DIRECT,
            'occurrence_type' => Expense::OCCURRENCE_INVOICE_PAYMENT,
            'credit_card_statement_id' => $paidStatement->id,
            'installment_group_id' => null,
            'installment_number' => null,
            'installment_total' => null,
            'created_at' => $paidStatementPaidAt,
            'updated_at' => $paidStatementPaidAt,
        ]);
    }

    /** @param array<string, mixed> $attributes */
    private function createCardPurchase(array $attributes): void
    {
        Expense::query()->create([
            'title' => $attributes['title'],
            'amount' => $attributes['amount'],
            'user_id' => $attributes['user_id'],
            'status' => $attributes['status'],
            'type' => 'expense',
            'payment_date' => $attributes['payment_date'],
            'purchase_date' => $attributes['purchase_date'],
            'due_date' => $attributes['due_date'],
            'category_id' => $attributes['category_id'],
            'source_id' => $attributes['source_id'],
            'origin_type' => $attributes['origin_type'],
            'occurrence_type' => $attributes['occurrence_type'],
            'credit_card_statement_id' => $attributes['statement_id'],
            'installment_group_id' => $attributes['installment_group_id'],
            'installment_number' => $attributes['installment_number'],
            'installment_total' => $attributes['installment_total'],
            'created_at' => $attributes['payment_date'] ?? $attributes['purchase_date'],
            'updated_at' => $attributes['payment_date'] ?? $attributes['purchase_date'],
        ]);
    }
}
