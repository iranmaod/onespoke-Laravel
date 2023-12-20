<?php

namespace App\Http\Controllers\account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Product;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Setting;
use App\Models\Currency;
use App\Models\Country;
use Auth;
use Session;
use DataTables;
class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');
     }
    public function index()
    {
      //get session user
      $user = Auth::user();
      $settings =Setting::first();
      $invoices_count         = $user->invoice->count();
      $amount_spent           = collect($user->invoice)->sum('total_amount_with_tax');
      $total_products_bought  = collect($user->invoice)->sum('total_products');
      $total_items_bought     = collect($user->invoice)->sum('total_items');

      return view('app.account.index')
      ->with('settings', $settings)
      ->with('total_items_bought', $total_items_bought)
      ->with('total_products_bought', $total_products_bought)
      ->with('amount_spent', $amount_spent)
      ->with('invoices_count', $invoices_count)
      ->with('user',$user)//pass user to view
      ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
    public function edit()
    {
        $user = Auth::user();
      return view('app.account.user.edit')
      ->with('user',$user)
      ->with('currencies',Currency::all())
      ->with('countries',Country::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $user = Auth::user();
      // dd($request->all());
      $this->validate($request,[
      'name'=>'required',
      'contact_name'=>'required',
      'country_id'=>'required',
      'email'=>'required|email',
    ]);


if (!empty($request->password)){
  $setting =Setting::first();
  if($setting->live_production==0){
    Session::flash('info', 'demo');
    return redirect()->back();
  }
  $password = $request->password;
  $user-> password = bcrypt($password);
}

if ($request->hasFile('image')){
    if (file_exists($user->image)){
      unlink($user->image);
    }
    $image = $request->image;
    $image_new_name = time().$image->getClientOriginalName();
    $image->move('uploads/merchants/',$image_new_name);
    $user->image = 'uploads/merchants/'.$image_new_name;
    // $user->save();
}
$user-> contact_name = $request->contact_name;
$user-> phone_number = $request->phone_number;
$user-> address = $request->address;
$user-> state = $request->state;
$user-> city = $request->city;
$user-> postal_code = $request->postal_code;
$user-> country_id = $request->country_id;
$user-> active = $request->active;
$user->save();
Session::flash('success',  __('messages.Success'));
alert()->success('Success', __('messages.Updated') )->showCloseButton()->autoClose(5000);
return redirect()->route('account.user.profile');
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
    public function profile()
    {
      $user = Auth::user();
      $settings =Setting::first();
      // $curr = User::find($user->id)->currency;
      // dd($curr->symbol);

    // $user_pro_count = count(User::find($user->id)->products);
    return view('app.account.user.profile')
    ->with('user',$user)
    ->with('settings',$settings)
    ->with('countries',Country::all());
    }
}
