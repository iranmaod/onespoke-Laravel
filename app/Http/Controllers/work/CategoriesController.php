<?php

namespace App\Http\Controllers\work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Models\Category;
use App\Models\Setting;
use Session;
use DataTables;
use Nestable;
class CategoriesController extends Controller
{
  // public function __construct()
  // {
  //     $this->middleware('auth:admin');
  // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function view_categories()
    {

      return view('app.work.category.categories');
    }
    ////////Get DT //////////////////////////////////
    public function get_categories_data(Request $request){
      //post
      // dump($request->all());
  // print_r($request->all());
  $categories = Category::select([
                        'id',
                        'parent_id',
                        'name',
                        ])->get();

    return Datatables::of($categories)


    ->addColumn('parent_name', function($categories) {
      // dd($categories->parent_id);
      $parent_id_value = $categories->parent_id<=1 ? 1 : $categories->parent_id;
        $cat_parent =Category::where('id',$parent_id_value)->first();
        return "<b>$cat_parent->name</b>";
                })
      ->addColumn('product_count', function($categories) {
      $category_pro_count = count(Category::find($categories->id)->products->where('parent_id', '=', 0));
      return "<b>$category_pro_count</b>";
      })
    ->addColumn('action', function($categories) {
      $delete_confirmation          = '\'Do You Want to Delete: '.$categories->name.' ? \'';
                return '
                 <a href="'.route('work.category.edit',$categories->id).'" class="btn btn-warning btn-xs" title="Edit">Edit</a>
                 <a href="'.route('work.category.delete',$categories->id).'" class="btn btn-danger btn-xs" title="Delete" onclick="return confirm('.$delete_confirmation.');">Delete</a>';

                })
    ->rawColumns(['parent_name','product_count','action'])
    ->make(true);
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // $cat = Category::nested()->get();
        // $cat = Category::renderAsHtml();
        $cat = Category::attr(['name' => 'category_id', 'class' => 'form-control show-tick'])
              ->selected(1)
              ->renderAsDropdown();
        return view('work.category.create')
        ->with('categories',(Category::all()))
        ->with ('cat',$cat)
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
        $this->validate($request,[
        'name'=>'required',
        'description'=>'required',
      ]);
      if (Category::where('name', '=',$request->name)->exists()) {
            Session::flash('warning','Category Already Exists');
          return redirect()->back();
      }
      if (Category::where('slug', '=',str_slug($request->name))->exists()) {
            Session::flash('warning','Category Slug Already Exists');
          return redirect()->back();
      }
      $user = Category::create([
          'name'=>$request->name,
          'description'=>$request->description,
          'parent_id'=>$request->category_id,
          'slug'=>str_slug ($request->name),
        ]);
        Session::flash('success','Success');
        // dd($request->all());
          return redirect()->route('categories');
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
      $category=Category::find($id);
      $category_parent =  $category->parent_id;
      $cat = Category::attr(['name' => 'category_id', 'class' => 'form-control show-tick'])
            ->selected($category_parent)
            ->renderAsDropdown();
    return view('work.category.edit')
    ->with('category',$category)
    ->with ('cat',$cat);
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
      $category=Category::find($id);

      $this->validate($request,[
      'name'=>'required',
      'description'=>'required',
    ]);
    $parent_id_value = $id<=1 ? 0 : $request->category_id;

    $category-> name = $request->name;
    $category-> description = $request->description;
    $category-> parent_id = $parent_id_value;
    $category->save();
    Session::flash('success','Successfully Updated');
    return redirect()->route('categories');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $setting =Setting::first();
      ////////////////demo//////////////
    if($setting->live_production==0){
        Session::flash('info', 'demo');
        return redirect()->back();
      }
      if($id==1){
        Session::flash('error', 'Cant Delete Root Category');
        return redirect()->back();
      }
      $category=Category::find($id);

      //find and deletes products of the category
      $pi=0;
      ///getting main products on the category
      foreach ($category->products->where('parent_id', '=', 0) as $cat_product) {
        // dump(count($category->products->where('parent_id', '=', 0))." Avaliable Main Products");
        // dump($category->products->where('parent_id', '=', 0));
        // dump("Above Array is for Main Products");
        // dump("Below is Getting First Product in the Main Product Array");
        // dump("Name: ".$cat_product->name);
        // dump($cat_product->variants);

        //getting variant of the main product
        foreach ($cat_product->variants as $cat_pro_variant) {
          // dump($cat_product->name.'('.count($cat_product->variants).') '. count($cat_pro_variant).' Varients');
        //deletes varitants of each of the category products
        if (file_exists($cat_pro_variant->image)){
          unlink($cat_pro_variant->image);
        }
        if (file_exists($cat_pro_variant->image_ex1)){
          unlink($cat_pro_variant->image_ex1);
        }
        if (file_exists($cat_pro_variant->image_ex2)){
          unlink($cat_pro_variant->image_ex2);
        }
        if (file_exists($cat_pro_variant->image_ex3)){
          unlink($cat_pro_variant->image_ex3);
        }
        if (file_exists($cat_pro_variant->image_ex4)){
          unlink($cat_pro_variant->image_ex4);
        }
        if (file_exists($cat_pro_variant->image_ex5)){
          unlink($cat_pro_variant->image_ex5);
        }
        $cat_pro_variant->forceDelete();
      }//end delete variants

        //continue to delete main product
        if (file_exists($cat_product->image)){
          unlink($cat_product->image);
        }
        if (file_exists($cat_product->image_ex1)){
          unlink($cat_product->image_ex1);
        }
        if (file_exists($cat_product->image_ex2)){
          unlink($cat_product->image_ex2);
        }
        if (file_exists($cat_product->image_ex3)){
          unlink($cat_product->image_ex3);
        }
        if (file_exists($cat_product->image_ex4)){
          unlink($cat_product->image_ex4);
        }
        if (file_exists($cat_product->image_ex5)){
          unlink($cat_product->image_ex5);
        }
        // dd('edge of deleting');
        $cat_product->forceDelete();//deletes main product
        $pi++;
      }// dd('Has No Varients');
      // end deleting main product

    
    
//make sub categories root->1
    $sub_categories = Category::where('parent_id',$id)->get();
    $ci=0;
    foreach ($sub_categories as $sub_category) {
      $sub_category->parent_id=1;
      $sub_category->save();
      $ci++;
    }
      // Category::destroy($id);
      $cat_name = $category->name;
      $category->delete();
      Session::flash('info',  "Moved $ci Sub-Categories to Root");
      Session::flash('warning', "Deleted $pi Sub-Products");
      Session::flash('success', "Successfully Deleted $cat_name");
      return redirect()->back();

    }
}
