<?php

namespace App\Http\Controllers\account\gateway;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Invoice;
use App\Credit;
use App\Setting;
use App\Gateway;
use App\Product;
use Session;
use Mail;
use Cart;
use App\Child_Invoice;
use App\Coupon;
use RealRashid\SweetAlert\Facades\Alert;

class VoguePayController extends Controller
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

  public function success()
  {

    if (!empty(request()->transaction_id)) {
      dump('Processing....');
      $transaction_id = request()->transaction_id;
      $settings = Setting::first();
      $gateway = Gateway::first();
      $user = Auth::user();
      $payment_merchant_name = $gateway->voguepay_merchant_id;

      // dd(request()->all());
      //get the full transaction details as an xml from voguepay
      $xml = file_get_contents('https://voguepay.com/?v_transaction_id=' . $transaction_id . "&type=xml&{$payment_merchant_name}=true");
      //parse our new xml
      $xml_elements = new \SimpleXMLElement($xml);
      //create new array to store our transaction detail
      $transaction = array();
      //loop through the $xml_elements and populate our $transaction array
      foreach ($xml_elements as $key => $value) {
        $transaction[$key] = $value;
      }
      @$email          = $transaction['email'];
      @$merchant_id    = $transaction['merchant_id'];
      @$transaction_id = $transaction['transaction_id'];
      @$total          = $transaction['total'];
      @$total_supplier_price = $transaction['merchant_ref']; //gotten from checkoutpage
      @$memo           = $transaction['memo'];
      // $id              = preg_replace('/\D/', '', $memo);

      @$status         = $transaction['status'];
      @$date           = $transaction['date'];
      @$referrer       = $transaction['referrer'];
      @$method         = $transaction['method'];
      @$cur            = $transaction['cur'];

      if (@$transaction['total'] == 0) die('Invalid total');
      if (@$transaction['status'] != 'Approved') die('Failed transaction');
      if (@$transaction['merchant_id'] != $merchant_id) die('Invalid merchant');

      /*You can do anything you want now with the transaction details or the merchant reference.
	You should query your database with the merchant reference and fetch the records you saved for this transaction.
	Then you should compare the $transaction['total'] with the total from your database.*/
      //flow
      $cart = Cart::instance('default');
      $payment_gateway = "VoguePay";
      //Generate Invoice Number
      //count invoices to get last row
      //////////////////////////////////////////////////////////
      if ($transaction['status'] == 'Approved') {
        gateway_payment($settings, $user, $total_supplier_price, $cart, $payment_gateway);
        return redirect()->route('account.invoices');
      } else {
        Session::flash('error', __('messages.Error Please Contact Admin'));
        return redirect()->route('account.invoices');
      }
      //////////////////////////////////////////////////////////

    } else {
      Session::flash('error', __('messages.Error Please Contact Admin'));
      return redirect()->route('account.invoices');
    }
  }
  ///////////////////////////////////Failed //////////////////////////////////////////
  public function fail()
  {
    if (!empty(request()->transaction_id)) {
      dump('Processing....');
      $transaction_id = request()->transaction_id;
      $settings = Setting::first();
      $gateway = Gateway::first();
      $user = Auth::user();
      $payment_merchant_name = $gateway->voguepay_merchant_id;

      //dd(request()->all());
      //get the full transaction details as an xml from voguepay
      $xml = file_get_contents('https://voguepay.com/?v_transaction_id=' . $transaction_id . "&type=xml&{$payment_merchant_name}=true");
      //parse our new xml
      $xml_elements = new \SimpleXMLElement($xml);
      //create new array to store our transaction detail
      $transaction = array();
      //loop through the $xml_elements and populate our $transaction array
      foreach ($xml_elements as $key => $value) {
        $transaction[$key] = $value;
      }
      @$email                = $transaction['email'];
      @$merchant_id          = $transaction['merchant_id'];
      @$transaction_id       = $transaction['transaction_id'];
      @$total                = $transaction['total'];
      @$total_supplier_price = $transaction['merchant_ref']; ////gotten from checkoutpage
      @$memo                 = $transaction['memo'];
      // $id              = preg_replace('/\D/', '', $memo);

      @$status               = $transaction['status'];
      @$date                 = $transaction['date'];
      @$referrer             = $transaction['referrer'];
      @$method               = $transaction['method'];
      @$cur                  = $transaction['cur'];



      //Email here
      $data = array(
        'name' => $user->name,
        'contact_name' => $user->contact_name,
        'email' => $user->email,
        'subject' => __('messages.Product Payment Failed')." VoguePay",
        'amount' => $total,
        'currency' => $cur,
        'time' => date('Y-m-d H:i:s'),
        'processor' => 'VoguePay',
        'settings' => $settings,

      );
      Mail::send('emails.invoice_failed', $data, function ($message) use ($data, $settings) {
        $message->from($settings->site_email, $settings->site_name);
        $message->to($data['email'], $data['name']); //sends to user
        $message->subject($data['subject']);
        $message->bcc($settings->site_email, 'Admin'); //sends to admin
        // $message->reply_to();
        // $message->cc();
      });
      //
      Session::flash('error', __('messages.Product Payment Failed'));
      alert()->error('Failed', '')->showCloseButton()->autoClose(10000);
      return redirect("/cart");
    } else {
      Session::flash('error',__('messages.Error Please Contact Admin'));
      return redirect()->route('account.invoices');
    }
  }

  public function index()
  {
    //
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
