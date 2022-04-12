<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $products   = Product::orderBy('name', 'asc')->limit(4)->with('media')->get();
        $categories = \App\Models\Category::all();
        $wood       = Product::withCount('orders')
                        ->orderby('orders_count', 'desc')
                        ->first();

        $lastReleased = Product::orderBy('created_at', 'desc')->first();
    
        return view('home', [
            'products'      => $products,
            'categories'    => $categories,
            'woodProduct'   => $wood,
            'lastReleased'  => $lastReleased,
        ]);
    }
}
