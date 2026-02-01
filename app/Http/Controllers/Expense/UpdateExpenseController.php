<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Http\Requests\Expense\UpdateExpenseRequest;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use DomainException;

class UpdateExpenseController extends Controller
{
    public function __invoke(UpdateExpenseRequest $request, int $id)
    {
        try {
            $data = $request->validated();

            $expense = Expense::findOrFail($id);

            if ($expense->user_id !== Auth::id()) {
                throw new DomainException('Você não pode alterar este registro');
            }

            // if ($data['payment_date'] === null) {
            //     unset($data['payment_date']);
            // }

            // if ($data['due_date'] === null) {
            //     unset($data['due_date']);
            // }

            $expense->update($data);

            return response()
                ->json([
                    'message' => 'Registro atualizado com sucesso',
                ], 200);
        } catch (DomainException $e) {
            return response()
                ->json([
                    'message' => $e->getMessage()
                ], 400);
        }
    }
}
