<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CompteController extends Controller
{
    public function show(Request $request): View
    {
        return view('account.show', [
            'user' => $request->user(),
            'recettes' => $request->user()->recettes()->get(),
        ]);
    }
}