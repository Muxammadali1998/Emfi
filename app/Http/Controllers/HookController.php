<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HookController extends Controller
{
    public function index(Request $request): bool
    {
        info($request);
        return true;
    }
}
