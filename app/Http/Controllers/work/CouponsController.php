<?php

namespace App\Http\Controllers\work;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Coupon;
use App\Setting;
use Session;
use DataTables;

class CouponsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('work.coupon.index');
    }
    public function get_coupons_data()
    {
        $coupon = Coupon::select([
            'id',
            'code',
            'per_off',
            'percentage_off',
            'customer_age',
            'usage_total',
            'usage_per_customer',
            'min_product',
            'min_item',
            'min_amount',
            'start_date',
            'end_date',
            'activation_method',
            'status',
            'created_at',
        ])->get();

        
        return Datatables::of($coupon)
            ->addColumn('action', function ($coupon) {
                $delete_confirmation          = '\'Do You Want to Delete this Coupon ? \'';

                return '
                     <a href="' . route('work.coupon.edit', $coupon->id) . '" class="btn btn-warning btn-xs" title="Edit">Edit</a>
                     <a href="' . route('work.coupon.delete', $coupon->id) . '" class="btn btn-danger btn-xs" title="Delete" onclick="return confirm(' . $delete_confirmation . ');"><i class="material-icons">delete</i></a>';
            })
            ->addColumn('status', function($coupon) {
                if($coupon->status==1){
                  return 'Enabled';
                }elseif($coupon->status==0){
                  return 'Disabled';
              }
          })
            ->rawColumns(['action','status'])
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
        return view('work.coupon.create');
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
        $this->validate($request, [
            'code' => 'required',
            "percentage_off" => 'required',
            "customer_age" => 'required',
            "usage_total" => 'required',
            "usage_per_customer" => 'required',
            "min_product" => 'required',
            "min_item" => 'required',
            "min_amount" => 'required',
            "start_date" => 'required',
            "end_date" => 'required',
        ]);

        if (Coupon::where('code', '=',$request->code)->exists()) {
            Session::flash('warning','Code Already Exists');
              return redirect()->back();
      }
        $coupon = Coupon::create([
            "code" => $request->code,
            "percentage_off" => $request->percentage_off,
            "customer_age" => $request->customer_age,
            "usage_total" => $request->usage_total,
            "usage_per_customer" => $request->usage_per_customer,
            "min_product" => $request->min_product,
            "min_item" => $request->min_item,
            "min_amount" => $request->min_amount,
            "start_date" => $request->start_date.' '.$request->start_date_time,
            "end_date" => $request->end_date.' '.$request->end_date_time,
            "status" => "1"
        ]);
        // dd($coupon);
        Session::flash('success', 'Success');
        return redirect()->route('work.coupons');
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
        $coupon = Coupon::find($id);
        return view('work.coupon.edit')->with('coupon', $coupon);
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
        $coupon = Coupon::find($id);

        $this->validate($request, [
            "percentage_off" => 'required',
            "customer_age" => 'required',
            "usage_total" => 'required',
            "usage_per_customer" => 'required',
            "min_product" => 'required',
            "min_item" => 'required',
            "min_amount" => 'required',
            "start_date" => 'required',
            "end_date" => 'required',
        ]);


        $coupon->percentage_off     = $request->percentage_off;
        $coupon->customer_age       = $request->customer_age;
        $coupon->usage_total        = $request->usage_total;
        $coupon->usage_per_customer = $request->usage_per_customer;
        $coupon->min_product        = $request->min_product;
        $coupon->min_item           = $request->min_item;
        $coupon->min_amount         = $request->min_amount;
        $coupon->start_date         = $request->start_date.' '.$request->start_date_time;
        $coupon->end_date           = $request->end_date.' '.$request->end_date_time;
        $coupon->status             = $request->status;
        $coupon->save();
        Session::flash('success', 'Successfully Updated');
        return redirect()->route('work.coupons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $setting = Setting::first();
        ////////////////demo//////////////
        if ($setting->live_production == 0) {
            Session::flash('info', 'demo');
            return redirect()->back();
        }
        $coupon = Coupon::find($id);
        Coupon::destroy($id);
        Session::flash('info', ' Deleted Successfully');
        return redirect()->back();
    }
}
