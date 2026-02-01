<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class getCategoryListController extends Controller
{
    public function __invoke()
    {
        return Category::where('user_id', Auth::id())->withCount(['expenses'])->orWhereNull('user_id')->orderBy('name', 'asc')->get();
    }
}
