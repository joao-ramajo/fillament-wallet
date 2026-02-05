<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetSourceListController extends Controller
{
    public function __invoke(Request $request)
    {
        $sources = Source::where('user_id', Auth::id())->get()->toArray();

        return response()
            ->json(
                $sources,
                200
            );
    }
}
