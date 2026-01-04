<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'amount' => 'required',
            'type' => 'required',
        ]);

        DB::table('expenses')->insert([
            'title' => $request->title,
            'amount' => $request->amount,  // já em centavos
            'type' => $request->type,
            'user_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Transação registrada.');
    }
}
