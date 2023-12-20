<?php

namespace App\Http\Controllers\account\gateway;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/** All Paypal Details class **/

use Auth;
use Validator;
use URL;
use Redirect;
use Input;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Credit;
use App\Models\Setting;
use App\Models\Gateway;
use Session;
use Mail;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Cart;
use App\Models\Child_Invoice;
use App\Models\Coupon;
use App\Models\Bike;
use RealRashid\SweetAlert\Facades\Alert;

class PayPalController extends Controller
{
    private $_api_context;
    private $total_supplier_price;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->total_supplier_price = 0;
        //setting//
        $paypal_Settings  = array(
            /**
            * Available option 'sandbox' or 'live'
            */
            'mode' => 'sandbox',
            // 'mode' => 'live',
            /**
            * Specify the max request time in seconds
            */
            'http.ConnectionTimeOut' => 1000,
            /**
            * Whether want to log to a file
            */
            'log.LogEnabled' => true,
            /**
            * Specify the file that want to write on
            */
            'log.FileName' => storage_path() . '/logs/paypal.log',
            /**
            * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
            *
            * Logging is most verbose in the 'FINE' level and decreases as you
            * proceed towards ERROR
            */
            'log.LogLevel' => 'ERROR'
        );
        $gataway = Gateway::first();
        // parent::__construct();
        /** setup PayPal api context **/
        // $paypal_conf = \Config::get('paypal');

        $this->_api_context = new ApiContext(new OAuthTokenCredential($gataway->paypal_client_id, $gataway->paypal_client_secret));
        $this->_api_context->setConfig($paypal_Settings);
    }
    public function payment(Request $request)
    {
        // dd($request->all());
        Session::put('total_supplier_price', $request->item_number);

        /** set your paypal credential **/
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName($request->item_name)
            /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount'));
        /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription($request->item_name);

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('account.gateway.paypal_status'))
            /** Specify return URL **/
            ->setCancelUrl(URL::route('account.gateway.paypal_status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        //  dd($payment->create($this->_api_context));exit;
        // dd($payment);
        try {
            $payment->create($this->_api_context);
           
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', __('messages.Connection timeout'));
                return Redirect::route('website.home');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                \Session::put('error', __('messages.Error Please Contact Admin'));
                return Redirect::route('website.home');
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }
        

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }

        \Session::put('error', __('messages.Unknown error occurred'));
        return Redirect::route('website.home');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paypal_status()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(request()->PayerID) || empty(request()->token)) {
            \Session::put('error', __('messages.Payment failed'));
            return Redirect::route('website.home');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId(request()->PayerID);
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') {

            //update account here
            $total_supplier_price = Session::get('total_supplier_price');
            /** clear the session payment ID **/
            Session::forget('total_supplier_price');
            $user = Auth::user();
            $settings = Setting::first();

            //Generate Invoice Number
            //count invoices to get last row
            $cart = Cart::instance('default');
            $payment_gateway = "PayPal";      

            //////////////////////////////////////////////////////////
            // dd(request()->all());
            if (!empty(request()->paymentId)) {
                gateway_payment($settings, $user, $total_supplier_price, $cart, $payment_gateway);
                return redirect()->route('website.home');
            } else {
                Session::flash('error', __('messages.Error Please Contact Admin'));
                return redirect()->route('website.home');
            }
            //////////////////////////////////////////////////////////
        }
        Session::flash('error', __('messages.Error Please Contact Admin'));
        return redirect()->route('website.home');
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
