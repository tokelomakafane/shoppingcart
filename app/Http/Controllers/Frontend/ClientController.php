<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Client;
use App\Models\Order;
use App\Cart;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Mail\SendMail;


class ClientController extends Controller
{
 public function Home(){
     $data['sliders']= Slider::all()->where('status',1);
     $data['products']= Product::all()->where('status',1);

     return view('frontend.home',$data);


 }

 public function Shop(){
    $data['products']= Product::all()->where('status',1);
    $data['categories']= Category::all();

    return view('frontend.shop',$data);
 }
 public function Cart(){
     if(!Session::has('cart')){
         return view('frontend.cart');
     }
     $oldCart = Session::has('cart')? Session::get('cart'):null;
     $cart = new Cart($oldCart);


    return view('frontend.cart',['products'=>$cart->items]);
 }
 public function Checkout(){

     if(!Session::has('frontend')){
         return view('frontend.login');
     }
     if(!Session::has('cart')){
         return view('frontend.cart');
     }
    return view('frontend.checkout');
 }
 public function    Login(){
    return view('frontend.login');
 }
 public function    signup(){
    return view('frontend.register');
 }
public function CreateAccount(Request $request){
  $this->validate($request,
['email'=>'email|required|unique:clients',
  'password'=>'required|min:4'
]

);

$client= new Client();
$client->email= $request->email;
$client->password=bcrypt($request->password);
$client->save();
return back()->with('status','your account has being created succefully');

}

public function accessaccount( Request $request){
    $this->validate($request,
    ['email'=>'email|required',
      'password'=>'required'
    ]

    );

    $client = Client::all()->where('email',$request->email)->first();



    if($client){

        if(Hash::check($request->input('password'),$client->password)){
            Session::put('frontend',$client);


            return redirect()->route('home');

        }else{
            return back()->with('status','bad email or password');

        }

    }else{

        return back()->with('status','with dont have account with this email address');



    }



}

public function Logout(){
 Session::forget('frontend');
 return redirect()->route('shop');

}


 public function    Register(){
    return view('frontend.register');
 }

 public function addtocart($id){

     $product =Product::find($id);
     $oldCart = Session::has('cart')? Session::get('cart'):null;
     $cart = new Cart($oldCart);
     $cart->add($product, $id);
     Session::put('cart', $cart);

    // dd(Session::get('cart'));
     return back();



 }
 public function updatecart(Request $request,$id){
    $oldCart = Session::has('cart')? Session::get('cart'):null;
    $cart = new Cart($oldCart);
    $cart->updateQty($id, $request->quantity);
    Session::put('cart', $cart);

    //dd(Session::get('cart'));
    return back();

 }
 public function removeproduct($id){
    $oldCart = Session::has('cart')? Session::get('cart'):null;
    $cart = new Cart($oldCart);
    $cart->removeItem($id);

    if(count($cart->items) > 0){
        Session::put('cart', $cart);
    }
    else{
        Session::forget('cart');
    }

    //dd(Session::get('cart'));
    return back();



 }

 public function postcheckout(Request $request){
    $oldCart = Session::has('cart')? Session::get('cart'):null;
    $cart = new Cart($oldCart);
    $payer_id=time();
 $order = new Order();
 $order->name = $request->name;
 $order->address = $request->address;
 $order->cart =serialize($cart);
 $order->payer_id=$payer_id;

 $order->save();
 session::forget('cart');

 $orders = Order::where('payer_id',$payer_id)->get();
    $orders->transform(function($order,$key){
        $order->cart=unserialize($order->cart);
        return $order;




    });

 $email=Session::get('frontend')->email;

 Mail::to($email)->send(new SendMail($orders));



 return redirect()->route('cart')->with('status','you order has being placed succefully');




 }
 public function orders(){

    $orders = Order::all();
    $orders->transform(function($order,$key){
        $order->cart=unserialize($order->cart);
        return $order;




    });


return view('backend.orders.view_order')->with('orders',$orders);


 }
}
