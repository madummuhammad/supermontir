<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class WebController extends Controller
{
    public function index()
    {
        return Inertia::render('Web/Index');
    }
}
