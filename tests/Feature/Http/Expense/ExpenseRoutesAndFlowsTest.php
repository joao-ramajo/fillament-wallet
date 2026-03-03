<?php

use App\Models\Category;
use App\Models\Expense;
use App\Models\Source;
use App\Models\User;
use Carbon\Carbon;

test('quero criar uma despesa com sucesso em uma fonte secundaria', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    $secondarySource = Source::factory()->create([
        'user_id' => $user->id,
        'is_default' => false,
    ]);

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->postJson(route('api.expenses.create'), [
            'title' => 'Internet',
            'amount' => 9900,
            'type' => 'expense',
            'status' => 'pending',
            'source_id' => $secondarySource->id,
        ]);

    $response->assertCreated();

    $this->assertDatabaseHas('expenses', [
        'title' => 'Internet',
        'user_id' => $user->id,
        'source_id' => $secondarySource->id,
    ]);
});

test('quero listar minhas todas as minhas despesas com sucesso', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    $defaultSourceId = $user->sources()->where('is_default', true)->value('id');

    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'status' => 'paid',
    ]);
    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'status' => 'pending',
    ]);
    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'status' => 'overdue',
    ]);

    $otherUser = User::factory()->create();
    $otherSourceId = $otherUser->sources()->where('is_default', true)->value('id');
    Expense::factory()->create([
        'user_id' => $otherUser->id,
        'source_id' => $otherSourceId,
        'status' => 'paid',
    ]);

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson(route('api.get-expenses'));

    $response->assertOk()
        ->assertJsonCount(3);
});

test('quero listar apenas as despesas pagas com sucesso', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    $defaultSourceId = $user->sources()->where('is_default', true)->value('id');

    Expense::factory()->count(2)->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'status' => 'paid',
    ]);
    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'status' => 'pending',
    ]);

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson(route('api.get-expenses', ['status' => 'paid']));

    $response->assertOk()
        ->assertJsonCount(2);

    $statuses = collect($response->json())->pluck('status')->unique()->values()->all();
    expect($statuses)->toBe(['paid']);
});

test('quero lsitar todas as despesas pendentes', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    $defaultSourceId = $user->sources()->where('is_default', true)->value('id');

    Expense::factory()->count(2)->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'status' => 'pending',
    ]);
    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'status' => 'paid',
    ]);

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson(route('api.get-expenses', ['status' => 'pending']));

    $response->assertOk()
        ->assertJsonCount(2);

    $statuses = collect($response->json())->pluck('status')->unique()->values()->all();
    expect($statuses)->toBe(['pending']);
});

test('na listagem de despesas devo conseguir buscar por query ignorando maiusculas minusculas e pontuacao', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    $defaultSourceId = $user->sources()->where('is_default', true)->value('id');

    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'title' => 'Uber - Corrida Centro',
    ]);
    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'title' => 'U.B.E.R* aeroporto',
    ]);
    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'title' => '99 Taxi',
    ]);

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson(route('api.get-expenses', ['query' => 'uber']));

    $response->assertOk()
        ->assertJsonCount(2);
});

test('na listagem de despesas devo conseguir buscar por query ignorando acentos', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    $defaultSourceId = $user->sources()->where('is_default', true)->value('id');

    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'title' => 'Compra de Maçã',
    ]);
    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'title' => 'Pão frances',
    ]);
    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'title' => 'Mercado',
    ]);

    $responseMaca = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson(route('api.get-expenses', ['query' => 'maca']));
    $responseMaca->assertOk()
        ->assertJsonCount(1);

    $responsePao = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson(route('api.get-expenses', ['query' => 'pao']));
    $responsePao->assertOk()
        ->assertJsonCount(1);
});

test('quero editar uma despesa com sucesso', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    $defaultSourceId = $user->sources()->where('is_default', true)->value('id');

    $expense = Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'title' => 'Conta antiga',
        'amount' => 1000,
        'type' => 'expense',
        'status' => 'pending',
    ]);

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->putJson(route('api.expenses.update', ['id' => $expense->id]), [
            'title' => 'Conta atualizada',
            'amount' => 2500,
            'type' => 'expense',
            'status' => 'pending',
            'source_id' => $defaultSourceId,
        ]);

    $response->assertOk();

    $this->assertDatabaseHas('expenses', [
        'id' => $expense->id,
        'title' => 'Conta atualizada',
        'amount' => 2500,
        'type' => 'expense',
    ]);
});

test('quero editar uma despesa para uma entrada com sucesso', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    $defaultSourceId = $user->sources()->where('is_default', true)->value('id');

    $expense = Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'type' => 'expense',
        'status' => 'pending',
    ]);

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->putJson(route('api.expenses.update', ['id' => $expense->id]), [
            'title' => 'Salario freelance',
            'amount' => 450000,
            'type' => 'income',
            'status' => 'paid',
            'source_id' => $defaultSourceId,
        ]);

    $response->assertOk();

    $this->assertDatabaseHas('expenses', [
        'id' => $expense->id,
        'type' => 'income',
        'amount' => 450000,
    ]);
});

test('quero ver meus resumos gerais com o total recebido, total gasto e saldo esperado com sucesso', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    $defaultSourceId = $user->sources()->where('is_default', true)->value('id');
    $secondarySourceId = Source::factory()->create([
        'user_id' => $user->id,
        'is_default' => false,
    ])->id;

    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'type' => 'income',
        'status' => 'paid',
        'amount' => 10000,
    ]);
    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'type' => 'expense',
        'status' => 'paid',
        'amount' => 2500,
    ]);
    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'type' => 'income',
        'status' => 'pending',
        'amount' => 1500,
    ]);
    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'type' => 'expense',
        'status' => 'pending',
        'amount' => 700,
    ]);

    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $secondarySourceId,
        'type' => 'expense',
        'status' => 'paid',
        'amount' => 999999,
    ]);

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson(route('api.get-summary'));

    $response->assertOk()
        ->assertJson([
            'total_receive' => 10000,
            'total_expense' => 2500,
            'expected_total' => 8300,
        ]);
});

test('uma nova despesa na fonte principal deve alterar o valor corretamente para o saldo esperado', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    $defaultSource = $user->sources()->where('is_default', true)->firstOrFail();

    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSource->id,
        'type' => 'income',
        'status' => 'paid',
        'amount' => 8000,
    ]);

    $before = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson(route('api.get-summary'));

    $before->assertOk()
        ->assertJson(['expected_total' => 8000]);

    $this->withHeader('Authorization', "Bearer {$token}")
        ->postJson(route('api.expenses.create'), [
            'title' => 'Conta energia',
            'amount' => 1200,
            'type' => 'expense',
            'status' => 'pending',
            'source_id' => $defaultSource->id,
        ])
        ->assertCreated();

    $after = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson(route('api.get-summary'));

    $after->assertOk()
        ->assertJson(['expected_total' => 6800]);
});

test('adicionar um novo gasto deve alterar o total gasto', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    $defaultSource = $user->sources()->where('is_default', true)->firstOrFail();

    $before = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson(route('api.get-summary'));

    $before->assertOk()
        ->assertJson(['total_expense' => 0]);

    $this->withHeader('Authorization', "Bearer {$token}")
        ->postJson(route('api.expenses.create'), [
            'title' => 'Mercado',
            'amount' => 3200,
            'type' => 'expense',
            'status' => 'paid',
            'source_id' => $defaultSource->id,
        ])
        ->assertCreated();

    $after = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson(route('api.get-summary'));

    $after->assertOk()
        ->assertJson(['total_expense' => 3200]);
});

test('ao adicionar despesas a uma categoria especifica, a contagem de despesas nela deve ser incrementada com sucesso', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    $defaultSourceId = $user->sources()->where('is_default', true)->value('id');
    $category = Category::factory()->create([
        'user_id' => $user->id,
    ]);

    $this->withHeader('Authorization', "Bearer {$token}")
        ->postJson(route('api.expenses.create'), [
            'title' => 'Despesa 1',
            'amount' => 1000,
            'type' => 'expense',
            'status' => 'pending',
            'source_id' => $defaultSourceId,
            'category_id' => $category->id,
        ])
        ->assertCreated();

    $this->withHeader('Authorization', "Bearer {$token}")
        ->postJson(route('api.expenses.create'), [
            'title' => 'Despesa 2',
            'amount' => 2000,
            'type' => 'expense',
            'status' => 'pending',
            'source_id' => $defaultSourceId,
            'category_id' => $category->id,
        ])
        ->assertCreated();

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson(route('api.categories.list'));

    $selected = collect($response->json())->firstWhere('id', $category->id);
    expect($selected)->not->toBeNull();
    expect($selected['expenses_count'])->toBe(2);
});

test('ao apagar uma despesa a categoria deve ser decrementada a quantidade de despesas com sucesso', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    $defaultSourceId = $user->sources()->where('is_default', true)->value('id');
    $category = Category::factory()->create([
        'user_id' => $user->id,
    ]);

    $expense = Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'category_id' => $category->id,
        'type' => 'expense',
    ]);

    $before = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson(route('api.categories.list'));
    $beforeCategory = collect($before->json())->firstWhere('id', $category->id);
    expect($beforeCategory['expenses_count'])->toBe(1);

    $this->withHeader('Authorization', "Bearer {$token}")
        ->deleteJson(route('api.expenses.delete', ['id' => $expense->id]))
        ->assertOk();

    $after = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson(route('api.categories.list'));
    $afterCategory = collect($after->json())->firstWhere('id', $category->id);
    expect($afterCategory['expenses_count'])->toBe(0);
});

test('nas fontes devo conseguir ver corretamente os valores de total recebido, total gasto e saldo final e a quantidade de registros nela', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    $defaultSource = $user->sources()->where('is_default', true)->firstOrFail();
    $secondarySource = Source::factory()->create([
        'user_id' => $user->id,
        'is_default' => false,
    ]);

    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSource->id,
        'type' => 'income',
        'amount' => 10000,
    ]);
    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSource->id,
        'type' => 'expense',
        'amount' => 4000,
    ]);

    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $secondarySource->id,
        'type' => 'income',
        'amount' => 7000,
    ]);
    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $secondarySource->id,
        'type' => 'expense',
        'amount' => 1500,
    ]);
    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $secondarySource->id,
        'type' => 'expense',
        'amount' => 500,
    ]);

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson(route('api.sources.details'));

    $response->assertOk();
    $items = collect($response->json());

    $default = $items->firstWhere('id', $defaultSource->id);
    $secondary = $items->firstWhere('id', $secondarySource->id);

    expect($default)->not->toBeNull();
    expect($default['total_income'])->toBe(10000);
    expect($default['total_expense'])->toBe(4000);
    expect($default['balance'])->toBe(6000);
    expect($default['expenses_count'])->toBe(2);

    expect($secondary)->not->toBeNull();
    expect($secondary['total_income'])->toBe(7000);
    expect($secondary['total_expense'])->toBe(2000);
    expect($secondary['balance'])->toBe(5000);
    expect($secondary['expenses_count'])->toBe(3);
});

test('devo conseguir marcar uma despesa como paga somente se ela estiver pendente ou atrasada', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    $defaultSourceId = $user->sources()->where('is_default', true)->value('id');

    $expense = Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'status' => 'paid',
        'payment_date' => now()->subDay(),
    ]);

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->postJson(route('api.expenses.mark-as-paid', ['id' => $expense->id]));

    $response->assertStatus(400)
        ->assertJson([
            'message' => 'Apenas despesas pendentes ou atrasadas podem ser marcadas como pagas.',
        ]);
});

test('marcar uma despesa como paga deve adicionar a data de pagamento como a data atual no momento em que marquei', function () {
    $now = Carbon::create(2026, 2, 15, 10, 30, 0);
    Carbon::setTestNow($now);

    try {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;
        $defaultSourceId = $user->sources()->where('is_default', true)->value('id');

        $expense = Expense::factory()->create([
            'user_id' => $user->id,
            'source_id' => $defaultSourceId,
            'status' => 'overdue',
            'payment_date' => null,
        ]);

        $this->withHeader('Authorization', "Bearer {$token}")
            ->postJson(route('api.expenses.mark-as-paid', ['id' => $expense->id]))
            ->assertOk();

        $expense->refresh();
        expect($expense->status)->toBe('paid');
        expect($expense->payment_date?->format('Y-m-d H:i:s'))->toBe($now->format('Y-m-d H:i:s'));
    } finally {
        Carbon::setTestNow();
    }
});

test('devo conseguir excluir uma despesa com sucesso', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    $defaultSourceId = $user->sources()->where('is_default', true)->value('id');

    $expense = Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
    ]);

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->deleteJson(route('api.expenses.delete', ['id' => $expense->id]));

    $response->assertOk();

    $this->assertDatabaseMissing('expenses', [
        'id' => $expense->id,
    ]);
});

test('ao criar uma despesa paga devo conseguir informar payment_date somente com data', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    $defaultSourceId = $user->sources()->where('is_default', true)->value('id');
    $paymentDate = '2026-03-02';

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->postJson(route('api.expenses.create'), [
            'title' => 'Parcela cartao',
            'amount' => 15000,
            'type' => 'expense',
            'status' => 'paid',
            'source_id' => $defaultSourceId,
            'payment_date' => $paymentDate,
        ]);

    $response->assertCreated();

    $expense = Expense::query()
        ->where('user_id', $user->id)
        ->where('title', 'Parcela cartao')
        ->firstOrFail();

    expect($expense->payment_date?->format('Y-m-d H:i:s'))->toBe('2026-03-02 00:00:00');
});

test('ao criar uma despesa paga com payment_date invalido deve retornar erro de validacao', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    $defaultSourceId = $user->sources()->where('is_default', true)->value('id');

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->postJson(route('api.expenses.create'), [
            'title' => 'Conta internet',
            'amount' => 12000,
            'type' => 'expense',
            'status' => 'paid',
            'source_id' => $defaultSourceId,
            'payment_date' => '2026-02-30',
        ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['payment_date']);
});

test('ao criar uma despesa paga com payment_date no futuro deve retornar erro de validacao', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;
    $defaultSourceId = $user->sources()->where('is_default', true)->value('id');
    $futureDate = now()->addDay()->format('Y-m-d');

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->postJson(route('api.expenses.create'), [
            'title' => 'Conta energia',
            'amount' => 18000,
            'type' => 'expense',
            'status' => 'paid',
            'source_id' => $defaultSourceId,
            'payment_date' => $futureDate,
        ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['payment_date']);
});
