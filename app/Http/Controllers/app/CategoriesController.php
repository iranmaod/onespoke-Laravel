<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Category;
use App\Models\Setting;
use Session;
use DataTables;
use Nestable;

class CategoriesController extends Controller
{
    public function view_categories()
    {

      return view('app.work.category.categories');
    }

    public function create()
    {

        // $cat = Category::nested()->get();
        // $cat = Category::renderAsHtml();
        $cat = Category::attr(['name' => 'category_id', 'class' => 'form-control show-tick'])
              ->selected(1)
              ->renderAsDropdown();
        return view('app.work.category.create')
        ->with('categories',(Category::all()))
        ->with ('cat',$cat)
        ;
    }

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
}
