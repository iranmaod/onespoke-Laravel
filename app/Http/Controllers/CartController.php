<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Page;
use App\Models\Products;
use App\Models\Bike;
use App\Models\Gateway;
use App\Models\Invoice;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
  public function cart()
  {
    $settings = Setting::first();
    return view('app.cart')
      ->with('categories', (Category::all()))
      ->with('pages', (Page::all()))
      ->with('settings', $settings);
  }
  public function add_to_cart()
  {
    // dd(request());
    $settings = Setting::first();
    $product = Products::find(request()->product_id);
    $cart = Cart::add([
      'id' => $product->id,
      'name' => $product->name,
      'qty' => 1,
      'price' => $product->price,
      'weight' => 0,
    ]);
    Cart::associate($cart->rowId, 'App\Models\Products');
    Cart::setTax($cart->rowId, $settings->tax);
    //validation
    // dd($cart);
    if ($product->stock == '0') {
      Cart::remove($cart->rowId);
      Session::flash('error', __('messages.Stock is : 0'));
      return redirect()->back();
    }
    if ($cart->qty > $product->stock) {
      Cart::update($cart->rowId, $cart->qty - 1);
      Session::flash('warning', __('messages.Max Stock is :')." $product->stock");
      return redirect()->back();
    }

    ////////// Product cart_count Updater //////////
    if ($cart->qty == 1) {
      $product->cart_count = $product->cart_count + 1;
      $product->save();
    }
    ////////// Product cart_count Updater //////////
    ////////////////////////////////////////////////////////////
    $this->validate_active_coupon();
    ////////////////////////////////////////////////////////////

    Session::flash('success', __('messages.Success: Added'));
    return redirect()->route('cart');
  }



  public function delete($id)
  {
    Cart::remove($id);
    ////////////////////////////////////////////////////////////
    $this->validate_active_coupon();
    ////////////////////////////////////////////////////////////
    Session::flash('success', __('messages.Success: Deleted'));
    return redirect()->back();
  }


  public function update(Request $request)
  {
    // dd(
    //   session()->all()
    // );
    // dd(Cart::priceTotal()/Cart::discount());
    // dd(
    //   "Initial ".Cart::initial(),
    //   "Cart Total ".Cart::priceTotal(),
    //   "Discount ".Cart::discount(),
    //   "Tax ".Cart::tax(),
    //   "Grand Total ".Cart::total(),
    //   "--------DISCOUNT--------",
    //   // Cart::setDiscount($request->id, 11.5),
    //   "Active Discount ".Cart::discount(),
    //   "With Active Discount Grand Total ".Cart::total()
    // );
    // dd($request->all());
    $id = $request->id;
    $quantity = $request->quantity;
    Cart::update($id, $quantity);
    ////////////////////////////////////////////////////////////
    $this->validate_active_coupon();
    ////////////////////////////////////////////////////////////
    Session::flash('success',__('messages.Success: Updated'));
    return redirect()->back();
  }


  public function empty_cart()
  {
    Cart::destroy();
    if (session()->exists('coupon_id') || session()->exists('coupon_code') || session()->exists('coupon_percentage_off')) {
      session()->forget(['coupon_id', 'coupon_code', 'coupon_percentage_off']);
    }

    Session::flash('success',__('messages.Success: Emptied'));
    return redirect()->back();
  }
  public function checkout()
  {
    $settings = Setting::first();
    $gateway = Gateway::first();
    if(count(Cart::content())==0){
      Session::flash('warning', __('messages.Cart is empty'));
      return redirect("/");
    };

    return view('app.checkout')
      ->with('categories', (Category::all()))
      ->with('gateway', $gateway)
      ->with('pages', (Page::all()))
      ->with('settings', $settings);
    // Session::flash('success','Success: Emptied');
    // return redirect()->back();
  }




  /////////////////Coupons//////////////
  public function add_coupon()
  {

    // dd($request->all());
    if (!Auth::guard('web')->check()) {
      Session::flash('error', __('messages.You must be logged in to apply coupon'));
      return redirect()->back();
    }
    if (!Cart::content()) {
      Session::flash('error', __('messages.Cart is empty'));
      return redirect()->back();
    }

    $code = request()->get('code');
    if (empty($code)) {
      Session::flash('error', __('messages.Coupon Code is empty'));
      return redirect()->back();
    }

    $coupon = Coupon::where('code', $code)->where('activation_method', 1)->first();

    if (!$coupon) {
      Session::flash('error', __('messages.Coupon')." $code ".__('messages.does not exist!'));
      return redirect()->back();
    } elseif ($coupon) { //found
      // more ifs
      if (Carbon::now() > $coupon->end_date) {
        Session::flash('error', __('messages.Coupon has expired'));
        return redirect()->back();
      }

      if (Carbon::now() < $coupon->start_date) {
        Session::flash('error', __('messages.Coupon is not active'));
        return redirect()->back();
      }

      if (Carbon::now()->subDays($coupon->customer_age) > Auth::user()->created_at) { //days age of customer
        Session::flash('error', __('messages.Ineligible to activate Coupon'));
        return redirect()->back();
      }

      if ($coupon->usage_total < 1) {
        Session::flash('error', __('messages.Coupon limit exceeded'));
        return redirect()->back();
      }

      $used_coupons_count = Invoice::where('coupon_code', $coupon->code)->where('user_id', Auth::user()->id)->count();
      if ($used_coupons_count >= $coupon->usage_per_customer) {
        Session::flash('error', __('messages.Your usage on this coupon has been exceeded'));
        return redirect()->back();
      }

      $initial_amount = str_replace(',', '', Cart::priceTotal());

      if ($initial_amount < $coupon->min_amount) {
        Session::flash('error', __('messages.Minimum Required amount is')." " . $coupon->min_amount);
        return redirect()->back();
      }

      if (Cart::count() < $coupon->min_item) {
        Session::flash('error', __('messages.Minimum Required Items is')." " . $coupon->min_item);
        return redirect()->back();
      }

      if (Cart::content()->count() < $coupon->min_product) {
        Session::flash('error', __('messages.Minimum Required Products is')." " . $coupon->min_product);
        return redirect()->back();
      }
      // already applied
      // another coupon is active 
      // Apply{remove other coupons and apply this globally}
      Cart::setGlobalDiscount($coupon->percentage_off);
      session()->put('coupon_id', $coupon->id);
      session()->put('coupon_code', $coupon->code);
      session()->put('coupon_percentage_off', $coupon->percentage_off);
      Session::flash('success', __('messages.Success: Applied'));
      return redirect()->back();
    } else {
      Session::flash('error', __('messages.Fatal Error'));
      return redirect()->back();
    }
  }


  public function delete_coupon()
  {
    Cart::setGlobalDiscount(0);
    if (session()->exists('coupon_id') || session()->exists('coupon_code') || session()->exists('coupon_percentage_off')) {
      session()->forget(['coupon_id', 'coupon_code', 'coupon_percentage_off']);
    }
    Session::flash('success', __('messages.Success: Emptied'));
    return redirect()->back();
  }


  public function validate_active_coupon()
  {
    ////////////////////////////////////////////////////////////
    if (session()->exists('coupon_code') && Auth::guard('web')->check()) {
      $coupon = Coupon::where('code', session()->get('coupon_code'))->where('activation_method', 1)->first();
      $used_coupons_count = Invoice::where('coupon_code', $coupon->code)->where('user_id', Auth::user()->id)->count();
      $initial_amount = str_replace(',', '', Cart::priceTotal());
      if (
        (!$coupon) ||
        (Carbon::now() > $coupon->end_date) ||
        (Carbon::now() < $coupon->start_date) ||
        (Carbon::now()->subDays($coupon->customer_age) > Auth::user()->created_at) ||
        ($coupon->usage_total < 1) ||
        ($used_coupons_count >= $coupon->usage_per_customer) ||
        ($initial_amount < $coupon->min_amount) ||
        (Cart::count() < $coupon->min_item) ||
        (Cart::content()->count() < $coupon->min_product)
      ) {
        Cart::setGlobalDiscount(0);
        if (session()->exists('coupon_id') || session()->exists('coupon_code') || session()->exists('coupon_percentage_off')) {
          session()->forget(['coupon_id', 'coupon_code', 'coupon_percentage_off']);
        }
      } else {
        Cart::setGlobalDiscount($coupon->percentage_off);
      }
    } //endif coupon exists
    ////////////////////////////////////////////////////////////
  }
}
