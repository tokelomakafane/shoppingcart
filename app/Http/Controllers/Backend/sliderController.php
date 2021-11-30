<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class sliderController extends Controller
{
public function AddSlider(){
    return view('backend.sliders.add_slider');
}
public function ViewSlider(){
    $data['allData']= Slider::all();
    return view('backend.sliders.view_slider',$data);
}
public function Editslider($id){
    $data['editData']= Slider::find($id);
    return view('backend.sliders.edit_slider',$data);
}
public function Storeslider(Request $request){
    $slider = new Slider();
    $slider->description1= $request->description1;
    $slider->description2= $request->description2;
    $slider->status=0;
    if ($request->file('image')) {
        $file = $request->file('image');
        $filename = date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('upload'),$filename);
        $slider['image'] = $filename;
    }
    $slider->save();

    return redirect()->route('view.slider');
}


public function Updateslider(Request $request,$id){
    $slider=Slider::find($id);
    $slider->description1= $request->description1;
    $slider->description2= $request->description2;

    if ($request->file('image')) {
        $file = $request->file('image');
        $filename = date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('upload'),$filename);
        $slider['image'] = $filename;
    }
    $slider->save();

    return redirect()->route('view.slider');
}
public function Deleteslider($id){
    $deletedata = Slider::find($id);
    $deletedata->Delete();
    return redirect()->route('view.slider');






    return view('backend.sliders.view_slider');
}
public function Activateslider($id){
    $changedata = Slider::find($id);
    if($changedata->status==0)
      $changedata->status=1;
      else
      $changedata->status=0;
      $changedata->save();


    return redirect()->route('view.slider');
}

}
