<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use DomainException;

class MarkExpenseAsPaidController extends Controller
{
    public function __invoke(string $id)
    {
        try {
            $expense = Expense::find((int) $id);

            if (!$expense) {
                throw new DomainException('Despesa não encontrada.');
            }

            $expense->update([
                'status' => 'paid',
                'payment_date' => now(),
            ]);

            return response()
                ->json([
                    'message' => 'Despesa marcada como paga com sucesso.'
                ], 200);
        } catch (DomainException $e) {
            return response()
                ->json([
                    'message' => $e->getMessage()
                ], 400);
        }
    }
}
