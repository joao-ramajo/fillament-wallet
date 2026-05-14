<?php

declare(strict_types=1);

use App\Enum\DashboardSummaryCard;
use App\Models\User;

function dashboardAuthTokenFor(User $user): string
{
    return $user->createToken('test')->plainTextToken;
}

test('deve retornar cards padrao quando o usuario ainda nao definiu preferencia', function (): void {
    $user = User::factory()->create();
    $token = dashboardAuthTokenFor($user);

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->getJson('/api/dashboard/summary/cards');

    $response->assertOk()
        ->assertJson([
            'card_ids' => DashboardSummaryCard::defaultSelection(),
        ]);
});

test('deve salvar a selecao de cards do dashboard', function (): void {
    $user = User::factory()->create();
    $token = dashboardAuthTokenFor($user);

    $cardIds = [
        DashboardSummaryCard::TotalReceive30Days->value,
        DashboardSummaryCard::ExpectedTotal->value,
        DashboardSummaryCard::SpentToday->value,
    ];

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->putJson('/api/dashboard/summary/cards', [
            'card_ids' => $cardIds,
        ]);

    $response->assertOk()
        ->assertJsonPath('card_ids.0', $cardIds[0])
        ->assertJsonPath('card_ids.1', $cardIds[1])
        ->assertJsonPath('card_ids.2', $cardIds[2]);

    $user->refresh();

    expect($user->dashboard_summary_cards)->toBe($cardIds);
});

test('deve rejeitar selecao com cards duplicados', function (): void {
    $user = User::factory()->create();
    $token = dashboardAuthTokenFor($user);

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->putJson('/api/dashboard/summary/cards', [
            'card_ids' => [
                DashboardSummaryCard::TotalReceive30Days->value,
                DashboardSummaryCard::TotalReceive30Days->value,
                DashboardSummaryCard::ExpectedTotal->value,
            ],
        ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['card_ids.0', 'card_ids.1']);
});

test('deve rejeitar selecao com quantidade invalida de cards', function (): void {
    $user = User::factory()->create();
    $token = dashboardAuthTokenFor($user);

    $response = $this->withHeader('Authorization', 'Bearer '.$token)
        ->putJson('/api/dashboard/summary/cards', [
            'card_ids' => [
                DashboardSummaryCard::TotalReceive30Days->value,
                DashboardSummaryCard::ExpectedTotal->value,
            ],
        ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['card_ids']);
});
