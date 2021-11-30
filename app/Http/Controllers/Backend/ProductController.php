<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function AddProduct(){
        $data['categories']= Category::all();
        return view('backend.products.add_product',$data);
    }

    public function ViewProduct(){
        $data['allData']= Product::all();
        return view('backend.products.view_product')->with($data);
    }

    public function StoreProduct(Request $request){

        $product= new Product();
        $product->name=$request->name;
        $product->category_id=$request->category_id;
        $product->price=$request->price;
        $product->status=0;



        if ($request->file('image')) {
    		$file = $request->file('image');
    		$filename = date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('upload'),$filename);
    		$product['image'] = $filename;
    	}
 	    $product->save();
         return redirect()->route('view.product');

    }



    public function DeleteProduct($id)
 {
     $deletedata = Product::find($id);
     $deletedata->Delete();



     return redirect()->route('view.product');

 }
 public function Activateproduct($id){
    $changedata = Product::find($id);
    if($changedata->status==0)
      $changedata->status=1;
      else
      $changedata->status=0;
      $changedata->save();


    return redirect()->route('view.product');
}
public function editProduct(Request $request,$id){
    $product   = Product::find($id);
    $product->name=$request->name;
    $product->category_id=$request->category_id;
    $product->price=$request->price;




    if ($request->file('image')) {
        $file = $request->file('image');
        $filename = date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('upload'),$filename);
        $product['image'] = $filename;
    }
     $product->save();
     return redirect()->route('view.product');

}
public function ViewProductbyname($category_id){


    $data['categories']= Category::all();
    $data['products']  = Product::all()->where('category_id',$category_id)->where('status',1);
    return view('frontend.shop',$data);

}



}
