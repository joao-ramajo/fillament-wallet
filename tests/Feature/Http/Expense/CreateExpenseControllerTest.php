<?php

use App\Models\User;

test('usuário autenticado cria uma despesa', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->postJson(route('api.expenses.create'), [
            'title' => 'Aluguel',
            'amount' => 120000,
            'type' => 'expense',
            'status' => 'pending',
        ]);

    $response->assertStatus(201);

    $this->assertDatabaseHas('expenses', [
        'title' => 'Aluguel',
        'user_id' => $user->id,
    ]);
});