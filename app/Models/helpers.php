<?php

////////////////////////////

use App\Coupon;
use App\Product;
use Illuminate\Support\Facades\Mail;
use App\Invoice;
use App\Credit;
use App\Child_Invoice;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

function gateway_payment($settings, $user, $total_supplier_price, $cart, $payment_gateway)
{
    //Generate Invoice Number
    //count invoices to get last row
    $last_count = 1 + count(Invoice::all());
    $invoice_number = 'INV' . '-' . time() . '-' . $last_count;
    $amount_gain =  str_replace(',', '', $cart->subtotal()) - $total_supplier_price; 
    $total_products = str_replace(',', '', $cart->content()->count());
    $total_amount_without_tax = str_replace(',', '', $cart->subtotal());
    $total_items = str_replace(',', '', $cart->count());
    $total_amount_with_tax = str_replace(',', '', $cart->total());
    $tax_amount = str_replace(',', '', $cart->tax());
    //
    $discount_amount = str_replace(',', '', $cart->discount());
    $initial_amount = str_replace(',', '', $cart->priceTotal());
    $coupon_code = (session()->exists('coupon_code')) ? 1 : 0;
    $coupon_code_value = (session()->exists('coupon_code')) ? session()->get('coupon_code') : 0;
    $coupon_percentage_off = (session()->exists('coupon_percentage_off')) ? session()->get('coupon_percentage_off') : 0;

    // dump($coupon_code);

    // Create Invoice
      $invoice = Invoice::create([
        'amount' => $total_amount_with_tax,
        'user_id' => $user->id,
        'invoice_number' => $invoice_number,
        'payment_method' => $payment_gateway,
        'status' => 1,
        'tax' => $settings->tax,
        'currency_symbol' => $settings->currency->symbol,
        'country' => $user->country->name,
        'address' => $user->address,
        'state' => $user->state,
        'city' => $user->city,
        'phone' => $user->phone_number,
        'postal_code' => $user->postal_code,
        'total_products' => $total_products,
        'total_items' => $total_items,
        'total_amount_without_tax' => $total_amount_without_tax,
        'tax_amount' => $tax_amount,
        'total_amount_with_tax' => $total_amount_with_tax,
        'amount_gain' => $amount_gain,
        'supplier_amount' => $total_supplier_price, //addition of all supposed product supplier prices
        'tracking_code' => '',
        'initial_amount' => $initial_amount, //amt before tax and coupons // actual amount
        'coupon_code' => $coupon_code_value,
        'coupon_amount' => $discount_amount,
        'coupon_percentage_off' => $coupon_percentage_off,
    ]);

    foreach ($cart->content() as $product) {
        //with tax
        $price_without_tax  = str_replace(',', '', $product->subtotal());
        //without tax
        $price_with_tax = str_replace(',', '', $product->total());

        $supplier_price = $product->model->supplier_price*$product->qty;
        //gain calc
        $amount_gain = $price_without_tax - $supplier_price;

        $tax_amount = str_replace(',', '', $product->tax());


        $c_invoice = Child_Invoice::create([
            'product_id'                 => $product->id,
            'product_name'               => $product->model->name,
            'product_quantity'           => $product->qty,
            'price_without_tax'          => $price_without_tax,
            'price_with_tax'             => $price_with_tax,
            'tax_amount'                 => $tax_amount,
            'supplier'                   => $product->model->supplier->name,
            'link'                       => $product->model->original_url,
            'supplier_id'                => $product->model->supplier_id,
            'user_id'                    => $user->id,
            'invoice_number'             => $invoice_number,
            'status'                     => 1,
            'currency_symbol'            => $settings->currency->symbol,
            'tracking_code'              => '',
            'amount_gain'                => $amount_gain,
            'supplier_price'             => $supplier_price*$product->qty,
            'initial_amount'             => $product->model->price*$product->qty, //amt before tax and coupons // actual amount
            'coupon_code'                => $coupon_code_value,
            'coupon_amount'              => $product->discount,
            'coupon_percentage_off'      => $coupon_percentage_off
        ]);



        // subtract qty from Stock // /reduce stock
        $pro = Product::where('id', $product->id)->first();
        $pro->stock = $pro->stock - $product->qty;
        $pro->save();
        if ($coupon_code == 1) {
            // dump('coupon');
            $coupon_value = session()->get('coupon_code');
            $coupon = Coupon::where('code', $coupon_value)->first();
            \Log::info('Coupon Step1 ' . $coupon->usage_total . " $invoice_number");
            $coupon->decrement('usage_total', 1); //Update Coupon
            \Log::info('Coupon Step2 ' . $coupon->usage_total . " $invoice_number");
        }
        // subtract qty from Stock  // /reduce stock
        

    }
    // clear cart
    $cart->destroy();
    $cart->setGlobalDiscount(0);
    if (session()->exists('coupon_id') || session()->exists('coupon_code') || session()->exists('coupon_percentage_off')) {
        // dd('Clear Session');
        session()->forget(['coupon_id', 'coupon_code', 'coupon_percentage_off']);
    }
    // clear cart

    // dd('<->');

    //Email here
    $data = array(
        'name' => $user->name,
        'contact_name' => $user->contact_name,
        'email' => $user->email,
        'subject' => __('messages.Product Invoice Approved')." $payment_gateway",
        'amount' => $total_amount_with_tax,
        'currency' => $settings->currency->symbol,
        'time' => date('Y-m-d H:i:s'),
        'invoice_number' => $invoice_number,
        'processor' => $payment_gateway,
        'settings' => $settings,
        'total_products' => $total_products,
        'tax' => $settings->tax, //%Percentage%
        'tax_amount' => $tax_amount,
        'total_amount_with_tax' => $total_amount_with_tax,
    );
    Mail::send('emails.invoice_approved', $data, function ($message) use ($data, $settings) {
        $message->from($settings->site_email, $settings->site_name);
        $message->to($data['email'], $data['name']); //sends to user
        $message->subject($data['subject']);
        $message->bcc($settings->site_email, 'Admin'); //sends to admin
        // $message->reply_to();
        // $message->cc();
    });
    Session::flash('info',  __('messages.Prepping Product(s) for Shipment'));
    // Session::flash('success', 'Thank You!. Payment was successful.');
    alert()->success('Success', __('messages.Thank You!. Payment was Successful.'))->showCloseButton()->autoClose(15000);
}
