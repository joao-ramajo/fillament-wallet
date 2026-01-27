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

class UpdateExpenseController extends Controller
{
    public function __invoke(UpdateExpenseRequest $request, string $id)
    {
        $id = Crypt::decrypt($id);

        $data = $request->validated();

        $expense = Expense::findOrFail($id);

        if ($expense->user_id !== Auth::id()) {
            return back()
                ->withInput()
                ->with('error', 'Vocẽ não pode atualizar esta despesa');
        }

        if($data['payment_date'] === null){
            unset($data['payment_date']);
        }

        if($data['due_date'] === null){
            unset($data['due_date']);
        }

        $expense->update($data);

        return redirect()
            ->route('web.expense.details', ['id' => Crypt::encrypt($expense->id)]);
    }
}
