<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::get();
        $category = Category::get();
        $keyword = request('keyword');
        return Inertia::render('Product/Index', [
            'product' => $product,
            'category' => $category,
            'keyword' => $keyword,
        ]);
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->first();
        return Inertia::render('Product/Show', [
            'product' => $product,
        ]);
    }
}
