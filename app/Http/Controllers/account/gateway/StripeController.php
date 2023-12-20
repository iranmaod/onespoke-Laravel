<?php

namespace App\Http\Controllers\account\gateway;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Credit;
use App\Models\Setting;
use App\Models\Gateway;
use App\Models\Bike;
use Session;
use App\Child_Invoice;
use App\Coupon;
use Stripe\Stripe;
use Stripe\Charge;
use Cart;
use Mail;
use RealRashid\SweetAlert\Facades\Alert;

class StripeController extends Controller
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
  public function payment(Request $request)
  {
    dump('Processing....');
    // dd($request->coupon_code);
    if (!empty($request->stripeToken)) {
      $settings = Setting::first();
      $gateway = Gateway::first();
      $user = Auth::user();
      Stripe::setApiKey($gateway->stripe_secret_key);
      $cart = Cart::instance('default');
      $cart_total = $cart->total();
      $cart_total = str_replace(',', '', $cart_total);
      $total_supplier_price       =  $request->total_supplier_price; //gotten from checkoutpage
      $payment_gateway = "Stripe";
      $charge = Charge::create([
        'amount' => $cart_total * 100,
        'currency' => "usd",
        'description' => 'Product Payment',
        'source' => request()->stripeToken,
      ]);
      //////////////////////////////////////////////////////////
      if($charge->status == "succeeded"){
        gateway_payment($settings,$user,$total_supplier_price,$cart,$payment_gateway);
        return redirect()->route('website.home');
      }else{
        Session::flash('error', __('messages.Error Please Contact Admin'));
        return redirect()->route('website.home');
      }
      //////////////////////////////////////////////////////////

    } else {
      Session::flash('error', __('messages.Error Please Contact Admin'));
      return redirect()->route('account.invoices');
    }
  }
  public function index()
  {
    // return view('account.finance.banks');
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
}
