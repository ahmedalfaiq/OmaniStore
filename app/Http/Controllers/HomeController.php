<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        return view('home', compact('categories'));
    }
    public function show($id)
    {
        $products = Product::all()->where('category_id', '=', $id);
        return view('products.index', compact('products'));
    }
    public function shop()
    {
        return view('shop.index');
    }
    public function detail($id)
    {
        return view('shop.detail');
    }
    public function cart()
    {
        return view('cart.index');
    }

}
