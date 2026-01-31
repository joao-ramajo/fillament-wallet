<?php

namespace App\Http\Controllers\Dashboard;

use App\Action\ImportCsvData;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function __construct(
        protected ImportCsvData $importAction,
    ){}

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'amount' => 'required',
            'type' => 'required',
            'status' => 'required',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        DB::table('expenses')->insert([
            'title' => $request->title,
            'amount' => $request->amount,
            'type' => $request->type,
            'status' => $request->status,
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Transação registrada.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required'
        ]);

        $result = $this->importAction->execute($request->file('file'));

        return back()->with('success', 'Dados importados com sucesso');
    }
}
