<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();
        return view('cart.orders', compact('orders'));
    }
    public function delivered(Request $request, $id)
    {
        $order = Order::find($id);
        $order->delivered = $request->delivered;
        $order->save();
        $orders = Order::where('user_id', Auth::user()->id)->get();
        return view('cart.orders', compact('orders'));
    }
}
