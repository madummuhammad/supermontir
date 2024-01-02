<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PointController extends Controller
{
    public function index()
    {
        return Inertia::render('Point/Index');
    }

    public function store(Request $request)
    {

    }
}
