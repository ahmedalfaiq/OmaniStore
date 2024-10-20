<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $total = 0;
        $products = [];
        $productsInSession = $request->session()->get("products");
        if ($productsInSession) {
            $products = Product::findMany(array_keys($productsInSession));
            $total = Product::sumPricesByQuantities($products, $productsInSession);
        }
        return view('cart.index', compact('total', 'products'));
    }
    public function add(Request $request, $id)
    {
        $products = $request->session()->get("products");
        $products[$id] = [$request->input('quantity'), $request->input('size')];
        $request->session()->put('products', $products);
        return redirect()->route('cart.index');
    }
    public function delete(Request $request)
    {
        $request->session()->forget('products');
        return back();
    }

    public function purchase(Request $request)
    {
        $productsInSession = $request->session()->get("products");
        if ($productsInSession) {
            $userId = Auth::user()->id;
            $order = new Order();
            $order->user_id = $userId;
            $order->total = 0;
            $order->save();
            $total = 0;
            $productsInCart = Product::findMany(array_keys($productsInSession));
            // dd($productsInCart);
            foreach ($productsInCart as $product) {
                $quantity = $productsInSession[$product->id][0];
                $item = new Items();
                $item->quantity = $quantity;
                $item->price = $product->price;
                $item->size = $productsInSession[$product->id][1];
                $item->product_id = $product->id;
                $item->order_id = $order->id;
                $item->save();
                $total = $total + ($product->price * $quantity);
            }
            $order->total = ($total);
            $order->save();
            $newBalance = Auth::user()->balance - $total;
            Auth::user()->balance = $newBalance;
            Auth::user()->save;
            $request->session()->forget('products');
            // $viewData = [];
            // $viewData["title"] = "Purchase - Online Store";
            // $viewData["subtitle"] = "Purchase Status";
            // $order = $order;
            return view('cart.purchase', compact('order'));
        } else {
            return redirect()->route('cart.index');
        }
    }
}
