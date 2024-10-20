<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $id = $product->id;
            $rating = Rate::all()->where('product_id', '=', $id);
            $p = Product::find($id);
            $p->rate = Product::getProductRate($rating);
            $p->save();
        }
        // $products = Product::all();
        // return view('shop.index', compact('products'));


        $type = 'Men';
        $categories = Category::all()->where('type', $type);

        return view('shop.index', compact('categories', 'type'));

    }
    public function show($id)
    {
        $product = Product::find($id);
        return view('shop.detail', compact('product'));
    }

    public function select(Request $request)
    {
        $type = $request->type;
        $categories = Category::all()->where('type', $type);
        $products = Product::query()
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*')
            ->where('categories.type', $type)
            ->get();

        return view('admin.product', compact('products', 'categories', 'type'));

    }

    public function accessory()
    {
        $type = 'Accessory';
        $categories = Category::all()->where('type', $type);
        return view('shop.index', compact('categories', 'type'));
    }
    public function women()
    {
        $type = 'Women';
        $categories = Category::all()->where('type', $type);
        return view('shop.index', compact('categories', 'type'));

    }
    public function detail($id)
    {
        $product = Product::find($id);
        return view('shop.detail', compact('product'));
    }


    public function search(Request $request)
    {

        $products = Product::where('name', 'like', '%' . $request->search . '%')->get();
        return view('shop.index', compact('products'));

    }
    public function rate(Request $request)
    {
        // dd($request->all());

        $data = $request->all();
        // $data['user_id'] = $request->user_id;
        // $data['product_id'] = $request->product_id;
        // $data['rating'] = $request->rating;
        // $data['comment'] = $request->comment;
        Rate::create([
            'user_id' => $data['user_id'],
            'product_id' => $data['product_id'],
            'rating' => $data['rating'],
            'comment' => $data['comment'],
        ]);


        // $user = Auth::user();
        // $post = Product::find($request->product_id);

        // $rating = $post->rating([
        //     'rating' => $request->rating,
        // ], $user);

        // dd($rating);
        return back();

    }
}
