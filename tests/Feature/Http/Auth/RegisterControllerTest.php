<?php

test('cria uma conta de usuário com sucesso e retorna seu nome e token', function () {
    $response = $this->postJson(route('api.register', [
        'name' => 'John Doe',
        'email' => 'john.doe@gmail.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'terms' => true,
    ]));

    $response->dump();

    $response->assertJsonStructure([
        'message',
        'user' => ['name'],
        'token',
    ]);

    $this->assertDatabaseHas('users', [
        'email' => 'john.doe@gmail.com'
    ]);

    $response->assertStatus(201);
});
