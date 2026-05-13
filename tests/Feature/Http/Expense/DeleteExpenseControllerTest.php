<?php

declare(strict_types=1);

use App\Models\CreditCardStatement;
use App\Models\Expense;
use App\Models\Source;
use App\Models\User;

test('usuário pode deletar uma despesa', function (): void {
    $user = User::factory()->create();
    $source = $user->sources()->first();
    $expense = Expense::factory()->create(['user_id' => $user->id, 'source_id' => $source->id]);

    $token = $user->createToken('test')->plainTextToken;

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->deleteJson(route('api.expenses.delete', ['id' => $expense->id]));

    $response->assertStatus(200);

    $this->assertDatabaseMissing('expenses', [
        'id' => $expense->id,
    ]);
});

test('usuário pode deletar uma compra no cartão e a fatura é sincronizada', function (): void {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    $creditCard = Source::factory()->creditCard()->create([
        'user_id' => $user->id,
    ]);
    $statement = CreditCardStatement::factory()->create([
        'source_id' => $creditCard->id,
        'status' => CreditCardStatement::STATUS_OPEN,
        'total_amount' => 10000,
    ]);

    $expense = Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $creditCard->id,
        'amount' => 10000,
        'origin_type' => Expense::ORIGIN_CREDIT_CARD,
        'occurrence_type' => Expense::OCCURRENCE_PURCHASE,
        'credit_card_statement_id' => $statement->id,
    ]);

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->deleteJson(route('api.expenses.delete', ['id' => $expense->id]));

    $response->assertStatus(200);

    $this->assertDatabaseMissing('expenses', [
        'id' => $expense->id,
    ]);

    expect($statement->refresh()->total_amount)->toBe(0);
});

test('usuário não pode deletar um pagamento de fatura', function (): void {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    $source = $user->sources()->first();
    $expense = Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $source->id,
        'occurrence_type' => Expense::OCCURRENCE_INVOICE_PAYMENT,
    ]);

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->deleteJson(route('api.expenses.delete', ['id' => $expense->id]));

    $response->assertStatus(400)
        ->assertJson([
            'message' => 'Registros de cartão devem ser gerenciados pelo fluxo da fatura.',
        ]);

    $this->assertDatabaseHas('expenses', [
        'id' => $expense->id,
    ]);
});
