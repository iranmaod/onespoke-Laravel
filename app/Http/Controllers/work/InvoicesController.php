<?php

namespace App\Http\Controllers\work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Credit;
use App\Models\Setting;
use Session;
use DataTables;
use App\Child_Invoice;
use PDF;
use Mail;
use Dompdf\Dompdf;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //  public function __construct()
    //  {
    //      $this->middleware('auth:admin');
    //  }
    public function index()
    {
      return view('app.work.finance.invoices');
    }
    ////////Get DT //////////////////////////////////
    public function get_invoice_data(){

  $invoices = Invoice::select([
                        'id',
                        'user_id',
                        'invoice_number',
                        'payment_method',
                        'total_amount_with_tax',
                        'status',
                        'created_at',
                        ])->get();



    return Datatables::of($invoices)
    ->addColumn('invoice_customer', function($invoices) {
    $user = Invoice::find($invoices->id)->user;
      return "$user->name";
    })
    ->addColumn('invoice_number', function($invoices) {
      return "<b>$invoices->invoice_number</b>";
    })
    ->addColumn('invoice_amount', function($invoices) {
      $settings =Setting::first();
      return $settings->currency->symbol.''.number_format($invoices->total_amount_with_tax,2);
    })
    ->addColumn('invoice_date', function($invoices) {
      // $invoices_date = date('d-m-Y', strtotime($invoices->date));
      $invoices_date = \Carbon\Carbon::parse($invoices->created_at)->format('d-M-y');
      return "$invoices_date";
    })
    ->addColumn('invoice_status', function($invoices) {
            return '<a href="" class="btn btn-success btn-xs disabled" disabled="disabled" title="Invoice Has Been Approved " >Paid</a>';
      })

    ->addColumn('action', function($invoices) {
        $delete_confirmation          = '\'Do You Want to Delete This Invoice ? \'';
                 return '
                 <a href="'.route('work.invoice.csv',$invoices->id).'" class="btn btn-primary btn-xs" title="Download CSV"><i class="fa fa-download" aria-hidden="true"></i></a>
                 <a href="'.route('work.invoice.process',$invoices->id).'" class="btn btn-secondary btn-xs" title="Process This Order"> <i class="fa fa-truck" aria-hidden="true"></i>View/Process Order</a>
                 <a href="'.route('work.invoice.delete',$invoices->id).'" class="btn btn-danger btn-xs" title="Delete" onclick="return confirm('.$delete_confirmation.');" >Delete</a>';
                })
    ->rawColumns(['invoice_customer','invoice_number','invoice_amount','invoice_date','invoice_status','action'])
      // onclick="return confirm('Are you sure you want to Remove?');"
    ->make(true);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('work.finance.create_invoice')
        ->with('users',User::all())
        // ->with('credit',Credit::all());
        ->with('credit',Credit::first());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     $this->validate($request,[
    //     'user_id'=>'required',
    //     'total_amount_with_tax'=>'required',
    //   ]);
    //   //Generate Invoice Number
    //   //count invoices to get last row
    //   $last_count = 1+count(Invoice::all());
    //   $invoice_number = 'INV'.'-'.time().'-'.$last_count;
    //   // dd($invoice_number);
    //   //vat
    //   // $amount_raw = $request->amount;
    //   // $mini_amount_temp = $request->amount/100;
    //   // $mini_amount = $mini_amount_temp*$request->vat;
    //   // $amount=$request->amount+$mini_amount;
    //   //vat
    //   $invoice = Invoice::create([
    //       'package_name'=>$request->package_name,
    //       'description'=>$request->description,
    //       'user_id'=>$request->user_id,
    //       'invoice_number'=>$invoice_number,
    //       'rate_per_click'=>$request->rate_per_click,
    //       'total_amount_with_tax'=>$request->amount,
    //       // 'vat'=>$request->vat,
    //     ]);
    //
    //
    //     Session::flash('success','Success');
    //       return redirect()->route('work.invoices');
    //
    // }
    public function csv($id)
    {
      $invoice = Invoice::find([$id]); // All users
     $csvExporter = new \Laracsv\Export();
     $csvExporter->build($invoice, [
                                  'user_id',
                                  'invoice_number',
                                  'payment_method',
                                  'status',
                                  'tax',
                                  'currency_symbol',
                                  'country',
                                  'address',
                                  'state',
                                  'city',
                                  'phone',
                                  'postal_code',
                                  'total_products',
                                  'total_items',
                                  'total_amount_without_tax',
                                  'tax_amount',
                                  'total_amount_with_tax',
                                  'tracking_code',
                                  'amount_gain',
                                  'supplier_amount',
                                  'created_at',

                                  ])->download();

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

    // public function view($id)
    // {
    //   $value = substr( $id, 0, 3 ) === "INV";
    //   $invoice = $value == 1 ? Invoice::where('invoice_number',$id)->first() :  Invoice::find([$id])->first();
    //   $settings=Setting::first();
    //   $sub_invs = $invoice->child;// getting sub
    //   $invoice_user = Invoice::find($invoice->id)->user;
    // return view('work.finance.invoice_details')
    // ->with('invoice',$invoice)
    // ->with('settings',$settings)
    // ->with('sub_invs',$sub_invs)
    // ->with('invoice_user',$invoice_user);
    // }
    public function process($id)
    {
      $value = substr( $id, 0, 3 ) === "INV";
      $invoice = $value == 1 ? Invoice::where('invoice_number',$id)->first() :  Invoice::find([$id])->first();
      $settings=Setting::first();
      $sub_invs = $invoice->child;// getting sub
      $invoice_user = Invoice::find($invoice->id)->user;
    return view('work.finance.invoice_process')
    ->with('invoice',$invoice)
    ->with('settings',$settings)
    ->with('sub_invs',$sub_invs)
    ->with('invoice_user',$invoice_user);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
     {
       // $site_settings = Setting::first();
      $sub_invoice =  Child_Invoice::find([$id])->first();
        return view('work.finance.delivery')
         ->with ('sub_invoice',$sub_invoice);
     }
    public function save(Request $request)
    {
      $sub_invoice =  Child_Invoice::find([$request->id])->first();
      $sub_invoice->tracking_code = $request->tracking_code;
      $sub_invoice->save();
      Session::flash('success','Success');
      return redirect('work/finance/invoice/process/'.$sub_invoice->invoice_number);
    }
    public function send(Request $request)
    {
      $settings=Setting::first();
      // Email here
     $data = array(
       'name'=>$request->name,
       'product_name'=>$request->product_name,
       'contact_name'=>$request->name,
       'email'=>$request->email,
       'subject'=>__('messages.Tracking Code'),
       'quantity'=>$request->quantity,
       'invoice_number'=>$request->invoice_number,
       'tracking_code'=>$request->tracking_code,
       'settings' => $settings,
    );
    // dd($data);
     Mail::send('emails.send_tracking_code',$data, function($message) use($data,$settings){
       $message->from($settings->site_email,$settings->site_name);
       $message->to($data['email'],$data['name']);//sends to user
       $message->subject($data['subject']);
       // $message->bcc($settings->site_email,'Admin');//sends to admin
       // $message->reply_to();
       // $message->cc();
     });

      Session::flash('success','Email Was Successfully Sent');
      return redirect('work/finance/invoice/process/'.$request->invoice_number);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $settings=Setting::first();

      $invoice = Invoice::find($id);
      foreach ($invoice->child as $invoice_child) {
        $invoice_child->forceDelete();
      }
      Invoice::destroy($id);
      Session::flash('success', 'Deleted Successfully');
      return redirect()->route('work.invoices');
    }
   //  public function approve($id)
   //  {
   //  $settings=Setting::first();
   //      $invoice = Invoice::find($id);
   //      if ($invoice->status==1) {
   //            Session::flash('warning','Already Approved');
   //          return redirect()->back();
   //      }
   //      //credits user
   //      $invoice->$invoices->total_amount_with_tax;
   //      $invoice->user_id;
   //      $user = User::where('id',$invoice->user_id)->first();
   //      $user->credit=$user->credit+$invoice->$invoices->total_amount_with_tax;
   //      $user->save();
   //      //credits user
   //      $invoice->status=1;
   //      $invoice->payment_method='Admin';
   //      $invoice->save();
   //
   //  	//Email here
   //  $data = array(
   //    'name'=>$user->name,
   //    'contact_name'=>$user->contact_name,
   //    'email'=>$user->email,
   //    'subject'=>'Invoice Approved',
   //    'amount'=>$invoice->$invoices->total_amount_with_tax,
   //    'currency'=>$settings->currency_symbol,
   //    'time'=> date('Y-m-d H:i:s'),
   //    'invoice_number'=>$invoice->invoice_number,
   //    'processor'=>'Admin',
   //    'settings' => $settings,
   //
   // );
   //  Mail::send('emails.invoice_approved',$data, function($message) use($data,$settings){
   //    $message->from($settings->site_email,$settings->site_name);
   //    $message->to($data['email'],$data['name']);//sends to user
   //    $message->subject($data['subject']);
   //    $message->bcc($settings->site_email,'Admin');//sends to admin
   //    // $message->reply_to();
   //    // $message->cc();
   //  });
   //
   //      Session::flash('info',  "Credited $invoice->$invoices->total_amount_with_tax to $user->name's Account");
   //      Session::flash('success','Success: Approved');
   //      return redirect()->back();
   //  }
   public function income()
  
   {
     //calc Totals
     $invoice_calc              = Invoice::all();
     // $invoices_count         = $user->invoice->count();
     $amount_initial            = collect($invoice_calc)->sum('initial_amount');
     $amount_coupon             = collect($invoice_calc)->sum('coupon_amount');
     $amount_supplier           = collect($invoice_calc)->sum('supplier_amount');

     $amount_with_tax           = collect($invoice_calc)->sum('total_amount_with_tax');
     $amount_without_tax        = collect($invoice_calc)->sum('total_amount_without_tax');
     $amount_tax                = collect($invoice_calc)->sum('tax_amount');
     $amount_profit             = collect($invoice_calc)->sum('amount_gain');
     //calc Totals
    //  dd(
    //   "Initial Amount: ".$amount_initial_amount,
    //   "Coupon Amount: ".$amount_coupon_amount,
    //   "Supplier Amount: ".$amount_supplier_amount,
    //   "With Tax Amount: ".$amount_with_tax ,
    //   "WithOut Tax Amount: ".$amount_without_tax,
    //   "Tax Amount: ".$amount_tax,
    //   "Profit Amount: ".$amount_profit 
    // );
     //search
     $query = request()->get('query');
     $settings =Setting::first();
     if (!empty($query)) {
       $invoices = Invoice::where('invoice_number','like',  '%' . $query . '%')
                           ->orwhere('total_amount_with_tax','like',  '%' . $query . '%')
                           ->orwhere('total_amount_without_tax','like',  '%' . $query . '%')
                           ->orwhere('tax_amount','like',  '%' . $query . '%')
                           ->orwhere('amount_gain','like',  '%' . $query . '%')
                           ->paginate(10);
     }else{
       $invoices = Invoice::orderBy('id', 'desc')->paginate(10);
     }

     // dd($invoices);
     return view('app.work.finance.income')
     ->with('amount_with_tax',$amount_with_tax)
     ->with('amount_profit',$amount_profit)
     ->with('amount_without_tax',$amount_without_tax)
     ->with('amount_tax',$amount_tax)
     ->with('amount_initial',$amount_initial)
     ->with('amount_coupon',$amount_coupon)
     ->with('amount_supplier',$amount_supplier) 
     ->with('query',$query)
     ->with('invoices',$invoices)
     ->with('settings',$settings);
   }
   public function sub_csv($id)
   {
     $invoice = Child_Invoice::find([$id]); // All users
    $csvExporter = new \Laracsv\Export();
    $csvExporter->build($invoice, [
                                  'product_name',
                                  'product_quantity',
                                  'price_without_tax',
                                  'price_with_tax',
                                  'tax_amount',
                                  'supplier_id',
                                  'user_id',
                                  'invoice_number',
                                  'status',
                                  'currency_symbol',
                                  'tracking_code',
                                  'amount_gain',
                                  'supplier_price',
                                  'link',
                                  'supplier',
                                 'created_at',

                                 ])->download();

   }


}
