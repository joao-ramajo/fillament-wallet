<?php

use App\Models\Source;
use App\Models\User;

test('usuário autenticado cria uma despesa', function () {
    $user = User::factory()->create();

    $source = Source::factory()->create([
        'user_id' => $user->id
    ]);
    $token = $user->createToken('test')->plainTextToken;

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->postJson(route('api.expenses.create'), [
            'title' => 'Aluguel',
            'amount' => 120000,
            'type' => 'expense',
            'status' => 'pending',
            'source_id' => $source->id
        ]);


    $response->assertStatus(201);

    $this->assertDatabaseHas('expenses', [
        'title' => 'Aluguel',
        'user_id' => $user->id,
    ]);
});
