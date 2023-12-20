<?php

namespace App\Http\Controllers\work;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Goutte\Client;
use Auth;
use App\Category;
use App\Product;
use App\User;
use App\Supplier;
use App\Currency;
use App\Setting;
use App\Variant;
use Session;
use DataTables;
use Sunra\PhpSimple\HtmlDomParser;
class ProductVariantController extends Controller
{
    public function __construct()
  {
      $this->middleware('auth:admin');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function variants($id)
    {
        $value = substr( $id, 0, 3 ) === "UNC";
        $product = $value == 1 ? Product::where('unique_value',$id)->first() :  Product::find([$id])->first();
        //if not found
        if (empty($product)){
            Session::flash('error','Product not found');
          return redirect()->route('products');
        }
        $variants = $product->variants()->orderBy('id', 'desc')->paginate(10);// getting variant
        $settings=Setting::first();
        return view('work.product.variants')
        ->with('product',$product)
        ->with('variants',$variants)
        ->with('settings',$settings);
      
    }
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $product = Product::find([$id])->first();//getting parent
        //if not found
        if (empty($product)){
            Session::flash('error','Product not found');
          return redirect()->route('products');
        }
        
  return view('work.product.add_variant')
  ->with('variant_types',Variant::all())
  ->with ('product',$product)
  ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $settings = Setting::first();

        $this->validate($request,[
        'name'=>'required',
        'variant_name'=>'required',
        'variant_id'=>'required',
        'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000', // max 10000kb,
        'price'=>'required|numeric|between:0,999999999999999999999999999.99',
        'stock'=>'required',
      ]);

      //uploads main image
      $randomNum=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 8);
      $image = $request->image;
      $image_new_name=time().$randomNum.$image->getClientOriginalName();
      $image->move('uploads/products/',$image_new_name);
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

      $product = Product::create([
          'name'=>$request->name,
          'description'=>$request->description,
          'category_id'=>$request->category_id,
          'supplier_price'=>$request->price,
          'price'=>$new_price,
          'supplier_id'=>$request->supplier_id,
          'original_url'=>$request->original_url,
          'stock'=>$request->stock,
          'slug'=>str_slug ($request->name),
          'image'=>'uploads/products/'.$image_new_name,
          'image_ex1' => $image_ex1,
          'image_ex2' => $image_ex2,
          'image_ex3' => $image_ex3,
          'image_ex4' => $image_ex4,
          'image_ex5' => $image_ex5,
          'variant_name'=>$request->variant_name,
          'variant_id'=>$request->variant_id,
          'parent_id'=>$request->parent_id,
          'unique_value'=> $unique_value,
          // 'active'=>$request->active,
        ]);
        
          Session::flash('success','Success');
          return redirect("work/product/$request->parent_id/variants/");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $product=Product::where('parent_id', '>', 0)->find($id);
       //if not found
       if (empty($product)){
        Session::flash('error','Product not found');
      return redirect()->route('products');
    }
      $product_image_type= substr( $product->image, 0, 4 ) === "http";
      $product_image     = $product_image_type==1 ? $product->image : asset($product->image);

        return view('work.product.edit_variant')
        ->with('variant_types',Variant::all())
        ->with('product',$product)
        ->with ('product_image',$product_image)//dual function
        ;
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $product = Product::find($id);
        $this->validate($request,[
        'name'=>'required',
        'variant_name'=>'required',
        'variant_id'=>'required',
        'supplier_id'=>'required',
        'stock'=>'required',
        'price'=>'required|numeric|between:0,999999999999999999999999999.99',
        'supplier_price'=>'required|numeric|between:0,999999999999999999999999999.99',
      ]);
      //images
      $randomNum=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 6);
      //Main Image 
      if ($request->hasFile('image')){
          if (file_exists($product->image)){
            unlink($product->image);
          }
          $image = $request->image;
          $image_new_name = $randomNum.time().$image->getClientOriginalName();
          $image->move('uploads/products/',$image_new_name);
          $product->image = 'uploads/products/'.$image_new_name;
          // $product->save();
      }
      //Extra Images
      if ($request->hasFile('image_ex1')){
        if (file_exists($product->image_ex1)){
          unlink($product->image_ex1);
        }
        $image_ex1 = $request->image_ex1;
        $image_ex1_new_name = '1'.$randomNum.time().$image_ex1->getClientOriginalName();
        $image_ex1->move('uploads/products/',$image_ex1_new_name);
        $product->image_ex1 = 'uploads/products/'.$image_ex1_new_name;
      }
      if ($request->hasFile('image_ex2')){
        if (file_exists($product->image_ex2)){
          unlink($product->image_ex2);
        }
        $image_ex2 = $request->image_ex2;
        $image_ex2_new_name = '2'.$randomNum.time().$image_ex2->getClientOriginalName();
        $image_ex2->move('uploads/products/',$image_ex2_new_name);
        $product->image_ex2 = 'uploads/products/'.$image_ex2_new_name;
      }
      if ($request->hasFile('image_ex3')){
        if (file_exists($product->image_ex3)){
          unlink($product->image_ex3);
        }
        $image_ex3 = $request->image_ex3;
        $image_ex3_new_name = '3'.$randomNum.time().$image_ex3->getClientOriginalName();
        $image_ex3->move('uploads/products/',$image_ex3_new_name);
        $product->image_ex3 = 'uploads/products/'.$image_ex3_new_name;
      }
      if ($request->hasFile('image_ex4')){
        if (file_exists($product->image_ex4)){
          unlink($product->image_ex4);
        }
        $image_ex4 = $request->image_ex4;
        $image_ex4_new_name = '4'.$randomNum.time().$image_ex4->getClientOriginalName();
        $image_ex4->move('uploads/products/',$image_ex4_new_name);
        $product->image_ex4 = 'uploads/products/'.$image_ex4_new_name;
      }
      if ($request->hasFile('image_ex5')){
        if (file_exists($product->image_ex5)){
          unlink($product->image_ex5);
        }
        $image_ex5 = $request->image_ex5;
        $image_ex5_new_name = '5'.$randomNum.time().$image_ex5->getClientOriginalName();
        $image_ex5->move('uploads/products/',$image_ex5_new_name);
        $product->image_ex5 = 'uploads/products/'.$image_ex5_new_name;
      }
      //
      $product->name    = $request->name;
      $product->variant_name    = $request->variant_name;
      $product->variant_id    = $request->variant_id;
      $product->description    = $request->description;
      $product->category_id    = $request->category_id;
      $product->price          = $request->price;
      $product->supplier_price = $request->supplier_price;
      $product->stock          = $request->stock;
      $product->supplier_id    = $request->supplier_id;
      $product->original_url   = $request->original_url;
      $product->save();
      Session::flash('success','Successfully Updated');
      return redirect("work/product/$product->parent_id/variants/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
