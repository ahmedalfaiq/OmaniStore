<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    //
    public function orders()
    {
        $orders = Order::all();
        return view('admin.orders',compact('orders'));
    }
    public function delivered(Request $request ,$id){
        $order = Order::find($id);
        $order->delivered = $request->delivered;
        $orders = Order::all();
        return view('admin.orders',compact('orders'));
    }
}
