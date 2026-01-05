<?php

use App\Models\User;

test('cria uma transação com sucesso', function () {
    $user = User::factory()->create();

    $data = [
        'title' => 'Compra de mercado',
        'amount' => 1000,
        'type' => 'expense',
        'status' => 'paid',
    ];

    $response = $this
        ->actingAs($user)
        ->withoutMiddleware()
        ->post(route('web.expense.store'), $data);


    $response->assertRedirect();

    $this->assertDatabaseHas('expenses', $data);
});
