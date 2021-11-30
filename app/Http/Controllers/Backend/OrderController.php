<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
user App\Models\Order;

class OrderController extends Controller
{
    public function ViewOrder(){
        $orders = Order::all();
        $orders-transform(function($order,$key){
            $order->cart=unserialize($order->cart);
            return $order;




        });
        
        return view('backend.view_order')->with('orders',$orders);
    }
}
