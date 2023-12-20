<?php

namespace App\Http\Controllers\Admin;
use App\Models\Bike;
use App\Models\Products;
use App\Models\Category;
use App\Models\Setting;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddBikeController extends Controller
{
    public function add()
    {
        $categories = Category::all();
        return view('admin.addbikes',compact('categories'));
    }

    public function create(Request $request)
    {
        // dd($request->all());
        $settings = Setting::first();

        $this->validate($request,[
        'title'=>'required',
        'variation_type'=>'required',
        'supplier_id'=>'required',
        'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000', // max 10000kb,
        'price'=>'required|numeric|between:0,999999999999999999999999999.99',
        'stock'=>'required',
      ]);
      //checks for duplicate slug
      // if (Product::where('slug', '=',str_slug($request->name))->exists()) {
      //       Session::flash('warning','Product Slug Already Exists');
      //     return redirect()->back();
      // }

      //uploads main image
      $randomNum=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 8);
      $image = $request->image;
      $image_new_name=time().$randomNum.$image->getClientOriginalName();
      $image->move('uploads/products/',$image_new_name);

    //   if ($image = $request->file('image')) {
    //     $destinationPath = 'uploads/products/';
    //     $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
    //     $image->move($destinationPath, $profileImage);
    //     $input['image'] = "$profileImage";
    // }
      //uploads Extra Images if Selected
      //ExtraImage1
      if ($request->hasFile('image_ex1')){
        $image_ex1 = $request->image_ex1;
        $image_ex1_new_name ='1'.time().$randomNum.$image_ex1->getClientOriginalName();
        $image_ex1->move('uploads/products/',$image_ex1_new_name);
      }
      //ExtraImage2
      if ($request->hasFile('image_ex2')){
        $image_ex2 = $request->image_ex2;
        $image_ex2_new_name = '2'.time().$randomNum.$image_ex2->getClientOriginalName();
        $image_ex2->move('uploads/products/',$image_ex2_new_name);
      }
      //ExtraImage3
      if ($request->hasFile('image_ex3')){
        $image_ex3 = $request->image_ex3;
        $image_ex3_new_name = '3'.time().$randomNum.$image_ex3->getClientOriginalName();
        $image_ex3->move('uploads/products/',$image_ex3_new_name);
      }
      //ExtraImage4
      if ($request->hasFile('image_ex4')){
        $image_ex4 = $request->image_ex4;
        $image_ex4_new_name = '4'.time().$randomNum.$image_ex4->getClientOriginalName();
        $image_ex4->move('uploads/products/',$image_ex4_new_name);
      }
      //ExtraImage5
      if ($request->hasFile('image_ex5')){
        $image_ex5 = $request->image_ex5;
        $image_ex5_new_name = '5'.time().$randomNum.$image_ex5->getClientOriginalName();
        $image_ex5->move('uploads/products/',$image_ex5_new_name);
      }
      // below tenary operation is for if 
      $image_ex1 = $request->hasFile('image_ex1')?'uploads/products/'.$image_ex1_new_name:'';
      $image_ex2 = $request->hasFile('image_ex2')?'uploads/products/'.$image_ex2_new_name:'';
      $image_ex3 = $request->hasFile('image_ex3')?'uploads/products/'.$image_ex3_new_name:'';
      $image_ex4 = $request->hasFile('image_ex4')?'uploads/products/'.$image_ex4_new_name:'';
      $image_ex5 = $request->hasFile('image_ex5')?'uploads/products/'.$image_ex5_new_name:'';
      //End Extra Images
      

      //calc price_percent_gain
      $percentage_value = ($request->price/100)*$settings->price_percent_gain;//get percentage value
      $new_price = $request->price + $percentage_value;//gets new sale price
      //calc price_percent_gain
      //generating unique ID for instant accessinng of the variant page //Saves pervious resources on queries
      $unique_value = "UNC".time().$randomNum;

      $product = Products::create([
          'title'=>$request->title,
          'description'=>$request->description,
          'category_id'=>$request->category_id,
          'supplier_price'=>$request->price,
          'price'=>$new_price,
          'supplier_id'=>$request->supplier_id,
          'original_url'=>$request->original_url,
          'stock'=>$request->stock,
          'slug'=>$request->title,
          'image'=>'uploads/products/'.$image_new_name,
          'image_ex1' => $image_ex1,
          'image_ex2' => $image_ex2,
          'image_ex3' => $image_ex3,
          'image_ex4' => $image_ex4,
          'image_ex5' => $image_ex5,
          'unique_value'=> $unique_value,
          // 'active'=>$request->active,
        ]);
        if ($request->variation_type==1){
          //if single product
          Session::flash('success','Success');
          return redirect()->route('admin.products');
        }elseif($request->variation_type==2){
          // if varied product
          Session::flash('success','Success');
          Session::flash('Add Variations Here','Success');
          return redirect("work/product/$unique_value/variants/");

        }
          

    }

    public function viewprod()
    {
        return view('admin.view_products');
    }
}
