<?php

namespace App\Http\Controllers\Expense;

use App\Domain\Uuid;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use DomainException;
use Illuminate\Support\Facades\Auth;

class DeleteExpenseController extends Controller
{
    public function __invoke(string $id)
    {
        try {
            $expense = Expense::find((int) $id);

            $userId = Auth::id();

            if ($expense->user_id !== $userId) {
                throw new DomainException('Você não tem permissão para deletar esta despesa.');
            }

            if (!$expense) {
                throw new DomainException('Despesa não encontrada.');
            }

            $expense->delete();

            return response()
                ->json([
                    'message' => 'Despesa deletada com sucesso.'
                ], 200);
        } catch (DomainException $e) {
            return response()
                ->json([
                    'message' => $e->getMessage()
                ], 400);
        }
    }
}
