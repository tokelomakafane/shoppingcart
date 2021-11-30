<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
 public function AddCategory(){
     return view('backend.categories.add_category');
 }
 public function ViewCategory(){
      $data['allData']=Category::all();
    return view('backend.categories.view_category',$data);
 }

 public function StoreCategory(Request $request){
     $data = new Category();
     $data->name=$request->name;
     $data->save();

    return redirect()->route('view.category');


 }
 public function EditCategory($id)
 {

     $editData = Category::find($id);
     return view('backend.categories.edit_category', compact('editData'));

 }

 public function UpdateCategory(Request $request, $id)
 {
     $validateData = $request->validate(
         [
             'name' => 'required',]
     );

     $data = Category::find($id);


     $data->name = $request->name;



     $data->save();

     $notification = array(
         'message' => 'category updated succesfully',
         'alert-type' => 'info',
     );


     return redirect()->route('view.category')->with($notification);


 }

 public function DeleteCategory($id)
 {
     $deletedata = Category::where('id',$id)->first();;
     $deletedata->Delete();
     $notification = array(
         'message' => 'Event deleted succesfully',
         'alert-type' => 'error',
     );


     return redirect()->route('view.category');

 }


}
