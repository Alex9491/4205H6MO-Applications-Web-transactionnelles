<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;

class AdministrationController extends Controller
{
    public function index(): View
    {
        return view('admin.index', [
            'utilisateurs' => User::all(),
        ]);
    }
}
