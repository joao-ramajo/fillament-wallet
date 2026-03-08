<?php

use App\Models\Expense;
use App\Models\Source;
use App\Models\User;
use Illuminate\Http\UploadedFile;

function authTokenFor(User $user): string
{
    return $user->createToken('test')->plainTextToken;
}

test('deve criar despesa na fonte padrao e refletir no resumo geral e nos detalhes da fonte', function () {
    $user = User::factory()->create();
    $token = authTokenFor($user);
    $defaultSource = $user->sources()->where('is_default', true)->firstOrFail();

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->postJson(route('api.expenses.create'), [
            'title' => 'Aluguel',
            'amount' => 120000,
            'type' => 'expense',
            'status' => 'paid',
            'source_id' => $defaultSource->id,
        ]);

    $response->assertStatus(201);

    $summary = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson(route('api.get-summary'));

    $summary->assertStatus(200)
        ->assertJson([
            'total_receive' => 0,
            'total_expense' => 120000,
            'expected_total' => -120000,
        ]);

    $sourceDetails = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson(route('api.sources.details'));

    $source = collect($sourceDetails->json())->firstWhere('id', $defaultSource->id);

    expect($source)->not->toBeNull();
    expect($source['total_income'])->toBe(0);
    expect($source['total_expense'])->toBe(120000);
    expect($source['balance'])->toBe(-120000);
    expect($source['expenses_count'])->toBe(1);
});

test('deve criar nova fonte e operacoes nela nao devem afetar resumo geral da fonte principal', function () {
    $user = User::factory()->create();
    $token = authTokenFor($user);

    $createSource = $this->withHeader('Authorization', "Bearer {$token}")
        ->postJson(route('api.sources.create'), [
            'name' => 'Carteira Viagem',
            'color' => '#22aa99',
            'allow_negative' => true,
        ]);

    $createSource->assertStatus(201);
    $newSourceId = $createSource->json('data.id');

    $this->withHeader('Authorization', "Bearer {$token}")
        ->postJson(route('api.expenses.create'), [
            'title' => 'Hotel',
            'amount' => 50000,
            'type' => 'expense',
            'status' => 'paid',
            'source_id' => $newSourceId,
        ])
        ->assertStatus(201);

    $summary = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson(route('api.get-summary'));

    $summary->assertStatus(200)
        ->assertJson([
            'total_receive' => 0,
            'total_expense' => 0,
            'expected_total' => 0,
        ]);

    $sourceDetails = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson(route('api.sources.details'));

    $createdSource = collect($sourceDetails->json())->firstWhere('id', $newSourceId);

    expect($createdSource)->not->toBeNull();
    expect($createdSource['total_expense'])->toBe(50000);
    expect($createdSource['balance'])->toBe(-50000);
});

test('deve calcular expected_total considerando registros pendentes e pagos', function () {
    $user = User::factory()->create();
    $token = authTokenFor($user);
    $defaultSourceId = $user->sources()->where('is_default', true)->value('id');

    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'amount' => 20000,
        'type' => 'income',
        'status' => 'paid',
    ]);

    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'amount' => 5000,
        'type' => 'expense',
        'status' => 'pending',
    ]);

    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'amount' => 1000,
        'type' => 'income',
        'status' => 'pending',
    ]);

    $summary = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson(route('api.get-summary'));

    $summary->assertStatus(200)
        ->assertJson([
            'total_receive' => 20000,
            'total_expense' => 0,
            'expected_total' => 16000,
        ]);
});

test('deve marcar despesa como paga e manter expected_total consistente', function () {
    $user = User::factory()->create();
    $token = authTokenFor($user);
    $defaultSourceId = $user->sources()->where('is_default', true)->value('id');

    $expense = Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $defaultSourceId,
        'amount' => 7000,
        'type' => 'expense',
        'status' => 'pending',
        'payment_date' => null,
    ]);

    $before = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson(route('api.get-summary'));

    $before->assertJson([
        'total_expense' => 0,
        'expected_total' => -7000,
    ]);

    $this->withHeader('Authorization', "Bearer {$token}")
        ->postJson(route('api.expenses.mark-as-paid', ['id' => $expense->id]))
        ->assertStatus(200);

    $this->assertDatabaseHas('expenses', [
        'id' => $expense->id,
        'status' => 'paid',
    ]);

    expect(Expense::findOrFail($expense->id)->payment_date)->not->toBeNull();

    $after = $this->withHeader('Authorization', "Bearer {$token}")
        ->getJson(route('api.get-summary'));

    $after->assertJson([
        'total_expense' => 7000,
        'expected_total' => -7000,
    ]);
});

test('deve importar csv e criar categoria automaticamente vinculando registros na fonte padrao', function () {
    $user = User::factory()->create();
    $token = authTokenFor($user);
    $defaultSourceId = $user->sources()->where('is_default', true)->value('id');

    $csv = <<<'CSV'
TITLE;AMOUNT;STATUS;TYPE;PAYMENT_DATE;DUE_DATE;CREATED_AT;CATEGORY_NAME;SOURCE_NAME
Mercado;15000;paid;expense;2026-02-01 10:00:00;2026-02-05;2026-02-01 10:00:00;Compras Casa;Cartao Nubank
Salario;300000;paid;income;2026-02-02 10:00:00;-;2026-02-02 10:00:00;-;-
CSV;

    $file = UploadedFile::fake()->createWithContent('import.csv', $csv);

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->postJson(route('api.csv.import'), [
            'file' => $file,
        ]);

    $response->assertStatus(200);

    $this->assertDatabaseCount('expenses', 2);
    $this->assertDatabaseHas('categories', [
        'name' => 'Compras Casa',
        'user_id' => $user->id,
    ]);

    $this->assertDatabaseHas('expenses', [
        'title' => 'Salario',
        'source_id' => $defaultSourceId,
    ]);

    $this->assertDatabaseHas('sources', [
        'name' => 'Cartao Nubank',
        'user_id' => $user->id,
    ]);

    $customSourceId = Source::query()
        ->where('user_id', $user->id)
        ->where('name', 'Cartao Nubank')
        ->value('id');

    $this->assertDatabaseHas('expenses', [
        'title' => 'Mercado',
        'source_id' => $customSourceId,
    ]);
});

test('deve importar csv reutilizando fonte existente pelo nome', function () {
    $user = User::factory()->create();
    $token = authTokenFor($user);

    $existingSource = Source::factory()->create([
        'user_id' => $user->id,
        'name' => 'Inter',
        'is_default' => false,
    ]);

    $csv = <<<'CSV'
TITLE;AMOUNT;STATUS;TYPE;PAYMENT_DATE;DUE_DATE;CREATED_AT;CATEGORY_NAME;SOURCE_NAME
Assinatura;4900;paid;expense;2026-03-01 10:00:00;-;2026-03-01 10:00:00;-;Inter
CSV;

    $file = UploadedFile::fake()->createWithContent('import.csv', $csv);

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->postJson(route('api.csv.import'), [
            'file' => $file,
        ]);

    $response->assertStatus(200);

    $this->assertDatabaseCount('sources', 2);
    $this->assertDatabaseHas('expenses', [
        'title' => 'Assinatura',
        'source_id' => $existingSource->id,
    ]);
});

test('deve importar csv com fonte Principal mapeando para carteira principal do usuario', function () {
    $user = User::factory()->create();
    $token = authTokenFor($user);
    $defaultSourceId = $user->sources()->where('is_default', true)->value('id');

    $csv = <<<'CSV'
TITLE;AMOUNT;STATUS;TYPE;PAYMENT_DATE;DUE_DATE;CREATED_AT;CATEGORY_NAME;SOURCE_NAME
Mercado;9900;paid;expense;2026-03-01 10:00:00;-;2026-03-01 10:00:00;-;Principal
CSV;

    $file = UploadedFile::fake()->createWithContent('import.csv', $csv);

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->postJson(route('api.csv.import'), [
            'file' => $file,
        ]);

    $response->assertStatus(200);

    $this->assertDatabaseHas('expenses', [
        'title' => 'Mercado',
        'source_id' => $defaultSourceId,
    ]);

    $this->assertDatabaseMissing('sources', [
        'user_id' => $user->id,
        'name' => 'Principal',
    ]);
});

test('deve exportar csv com coluna de fonte', function () {
    $user = User::factory()->create();
    $token = authTokenFor($user);

    $source = Source::factory()->create([
        'user_id' => $user->id,
        'name' => 'Conta PJ',
        'is_default' => false,
    ]);

    Expense::factory()->create([
        'user_id' => $user->id,
        'source_id' => $source->id,
        'title' => 'Servico',
        'amount' => 90000,
        'status' => 'paid',
        'type' => 'income',
    ]);

    $response = $this->withHeader('Authorization', "Bearer {$token}")
        ->get(route('api.csv.export'));

    $response->assertOk();

    $content = $response->streamedContent();
    expect($content)->toContain('SOURCE_NAME');
    expect($content)->toContain('Conta PJ');
});
