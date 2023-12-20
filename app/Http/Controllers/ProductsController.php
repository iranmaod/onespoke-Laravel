<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryApp;
use App\Models\Supplier;
use App\Models\Setting;
use Session;
use App\Models\Products;
use App\Models\Bike;
use App\Models\Page;
use App\Models\Credit;
use App\Models\Report;
use App\Models\User;
use Redirect;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function products()
    {
      $settings =Setting::first();
      // $posts = Post::orderBy('id', 'desc')->take(6)->get();
      $products = Products::where('parent_id', '=', 0)->orderBy('id', 'desc')->paginate(9);
      //dd($products);
      return view('app.products')
      ->with('products',$products)
      ->with('categories',(Category::all()))
      ->with('pages',(Products::all()))
      ->with('settings',$settings);
    }
    public function search()
    {
      $query = request()->get('query');
      if (empty($query)) {
            Session::flash('info',__('messages.Query Is Empty'));
          return redirect('/products');
      }
      $min_length = 3;
      if(strlen($query) < $min_length){
      Session::flash('info',__('messages.Minimum Length is').$min_length);
      return redirect('/products');
      }
      $settings =Setting::first();
      // $products = Product::all()->where('parent_id', '=', 0);
      // $products = Product::all()->where('parent_id', '=', 0)->get();
      $products = Products::where('parent_id', '=', 0);
      $products = $products->where('name','like',  '%' . $query . '%')
                           ->orwhere('description','like',  '%' . $query . '%')
                           ->orderBy($settings->search_element, $settings->search_order);
      $products = $products->where('parent_id', '=', 0)->paginate(9);
      return view('search')
      ->with('query',$query)
      ->with('products',$products)
      ->with('categories',(Category::all()))
      ->with('pages',(Page::all()))
      ->with('settings',$settings);
    }

    
    public function product_page($slug, $id)
    {
      $url_path = $slug.'-'.$id;
      //get correct slog
      $slug = substr( $url_path, 0, strrpos( $url_path, '-' ) );
      //get correct id
      $id = trim($url_path,'-');
      $id = explode('-',$id);
      $id = end($id);

      $settings =Setting::first();
      $product = Products::where('title',$slug)->where('id',$id)->first();
      //dd($product);
      if (empty($product)) {
            Session::flash('warning',__('Product was not found'));
          return redirect('/products');
      }
      //// $pro_id = Product::where('id',$id)->first();
      ////////// Product Views Updater //////////
      $product->views_count=$product->views_count+1;
      $product->save();
      ////////// Product Views Updater //////////
      //Compare
      $query = $product->name;
      $compared_products_search = Products::where('parent_id', '=', 0);
      $compared_products_search = $compared_products_search->where('name','like',  '%' . $query . '%')->orderBy('price', 'asc')->get();
      // dd($compared_products_search);

      $compared_products = array();
      $count=0;
      foreach($compared_products_search as $ini_compared_product) {

       if($count == $settings->compared_products) break;
       $count++;
       //checks for similarity
       similar_text($product->name, $ini_compared_product->name, $perc); //12
       //applies percentage filter
       $Compare = $settings->compare_percentage;
             if  ($perc <$Compare){
               continue;
             }
             // removes active product from the table
             if ($product->id == $ini_compared_product->id ){
                continue;
             }
       $compared_products[] = $ini_compared_product;
      }

      // $arr  = $compared_products;
      // $sort = array();
      // foreach($arr as $k=>$v) {
      //     $sort['price'][$k] = $v['price'];
      // }
      //
      // array_multisort($sort['price'], SORT_DESC, $arr);
      //
      // echo "<pre>";
      // print_r($arr);
      // dd();

      // dump(count($compared_products));
      // dd($compared_products);


        // similar_text($product->name, $compared_product->name, $perc); //12
        // $Compare = $settings->compare_percentage;
        //       if  ($perc <$Compare){
        //         continue;
        //       }
        //       if ($compared_product->id = $product->id){
        //           continue;
        //       }

      //get random Products
      $rand_products = Products::where('parent_id', '=', 0)->inRandomOrder()->limit(5)->get();
      return view('app.product_page')
      ->with('product',$product)
      ->with('compared_products',$compared_products)
      ->with('rand_products',$rand_products)
      ->with('categories',(CategoryApp::all()))
      ->with('pages',(Page::all()))
      ->with('settings',$settings);
    }
    public function link()
    {
      // dump(request()->product_id);
      $product = Products::where('id',request()->product_id)->first();
      //checks if the product was found
      if (empty($product)) {
            Session::flash('warning',__('messages.Link Error Check URL'));
          return redirect('/products');
      }  
      
    return redirect("$product->slug-$product->id");
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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




    /////new////
    public function createprod()
    {
      $categories = Category::all();
      //dd($categories);
      return view('app.work.product.create')
      ->with('suppliers',Supplier::all())
      ->with ('categories',$categories)
      ;
    }

    public function storeprod(Request $request)
    {
       
        $settings = Setting::first();

      //   $this->validate($request,[
      //   'title'=>'required',
      //   'variation_type'=>'required',
      //   'supplier_id'=>'required',
      //   'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000', // max 10000kb,
      //   'price'=>'required|numeric|between:0,999999999999999999999999999.99',
      //   'stock'=>'required',
      // ]);
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

    
      //End Extra Images
    

      //calc price_percent_gain
      $percentage_value = ($request->price/100)*$settings->price_percent_gain;//get percentage value
      $new_price = $request->price + $percentage_value;//gets new sale price
      //calc price_percent_gain
      //generating unique ID for instant accessinng of the variant page //Saves pervious resources on queries
      $unique_value = "UNC".time().$randomNum;
      // dd($request->all()); 
      $product = Products::create([
          'name'=>$request->name,
          'description'=>$request->description,
          'category_id'=>$request->category_id,
          'supplier_price'=>$request->price,
          'price'=>$new_price,
          'supplier_id'=>$request->supplier_id,
          'original_url'=>$request->original_url,
          'stock'=>$request->stock,
          'slug'=>$request->title,
          'image'=>'uploads/products/'.$image_new_name,
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
        Session::flash('success','Success');
        return redirect()->route('admin.products');
          

    }

    public function editProd($id)
    {

      {
        $product=Products::where('parent_id', '=', 0)->find($id);
         //if not found
         if (empty($product)){
          Session::flash('error','Product not found');
        return redirect()->route('admin.products');
      }
        //get selected product category
        $product_category =  $product->category_id;
        $categories = Category::all();
        //get merchant list
        //process image
        $product_image_type= substr( $product->image, 0, 4 ) === "http";
        $product_image     = $product_image_type==1 ? $product->image : asset($product->image);
  
  
          return view('admin.edit_product')
          ->with('product',$product)
          ->with ('categories',$categories)
          ->with ('product_image',$product_image)//dual function
          ->with('suppliers',Supplier::all());
  
      ;
      }
    }

    public function updateprod(Request $request, $id)
    {
        
       $product = Products::find($id);
    
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
     
     
   
   //  dd($request->all());
     $product->name           = $request->name;
     $product->description    = $request->description;
     $product->category_id    = $request->category_id;
     $product->price          = $request->price;
     $product->supplier_price = $request->supplier_price;
     $product->stock          = $request->stock;
     $product->supplier_id    = $request->supplier_id;
     $product->original_url   = $request->original_url;
     $product->save();
     Session::flash('success','Successfully Updated');
     return redirect()->route('admin.products');
  
    }

    public  function delProd($id)
    {
      $product = Products::find($id)->delete();
      return redirect()->back();
    }
}
