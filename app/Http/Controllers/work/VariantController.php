<?php

namespace App\Http\Controllers\work;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Variant;
use App\Setting;
use Session;
use DataTables;
use Nestable;
class VariantController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        return view('app.work.variation.index');
    }
    public function get_variations_data(Request $request){
    $variations = Variant::select([
                          'id',
                          'name',
                          ])->get();
  
      return Datatables::of($variations)
  
  
        ->addColumn('product_count', function($variations) {
        // $variation_pro_count = count(Variant::find($variations->id)->products);
        $variation_pro_count = count($variations->products);//shorter approach
        return "<b>$variation_pro_count</b>";
        })
      ->addColumn('action', function($variations) {
        $delete_confirmation          = '\'Do You Want to Delete: '.$variations->name.' ? \'';
                  return '
                   <a href="'.route('work.variation.edit',$variations->id).'" class="btn btn-warning btn-xs" title="Edit">Edit</a>
                   <a href="'.route('work.variation.delete',$variations->id).'" class="btn btn-danger btn-xs" title="Delete" onclick="return confirm('.$delete_confirmation.');">Delete</a>';
                  })
      ->rawColumns(['product_count','action'])
      ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('work.variation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
          ]);
          if (Variant::where('name', '=',$request->name)->exists()) {
                Session::flash('warning','Already Exists');
              return redirect()->back();
          }
          $v = Variant::create([
              'name'=>$request->name,
            ]);
            Session::flash('success','Success');
              return redirect()->route('variations');
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
    $variation=Variant::find($id);
    return view('work.Variation.edit')
    ->with('variation',$variation);
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
    $variation=Variant::find($id);
     $this->validate($request,[
     'name'=>'required',
   ]);

   $variation-> name = $request->name;
   $variation->save();
   Session::flash('success','Successfully Updated');
   return redirect()->route('variations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $settings =Setting::first();
      ////////////////demo//////////////
    if($settings->live_production==0){
        Session::flash('info', 'demo');
        return redirect()->back();
      }
      $variation=Variant::find($id);
      $variation->delete();
      Session::flash('success', "Successfully Deleted");
      return redirect()->back();
    }
}
