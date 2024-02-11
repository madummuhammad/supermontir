<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class WebController extends Controller
{
    public function index()
    {
        // $source = storage_path('app/public'); // Lokasi file atau direktori yang akan di-link
        // $destination = public_path('storage'); // Lokasi tujuan symlink

        // if (!file_exists($destination)) {
        //     symlink($source, $destination);

        // }

        return Inertia::render('Web/Index');
    }

    public function contact()
    {
        return Inertia::render('Web/Contact');
    }
}
