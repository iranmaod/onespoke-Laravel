<?php

namespace App\Http\Controllers\work;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Mail;
use Auth;
use App\Models\User;
use App\Models\Currency;
use App\Models\Country;
use App\Models\Setting;
use Session;
use DataTables;
use Sunra\PhpSimple\HtmlDomParser;
class UsersController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function datatables()
    //  {
    //      return view('work.user.datatables');
    // }
    ///////////////////get DT //////////////////////////
    // public function get_users_data(){
    //get
    //   $users = User::select(
    //                       'name',
    //                       'email',
    //                       'updated_at',
    //                     'created_at');
    //   return Datatables::of($users)->make(true);
    // }
    ////////Get DT //////////////////////////////////
    public function get_users_data(){

  $users = User::where('is_admin','0')->get();
                        



    return Datatables::of($users)
    ->addColumn('country', function($users) {
        return $users->country->name;

      })
      ->addColumn('date', function($users) {
      $users_date =  $users->created_at->toDateString();
        return "$users_date";
        })
      ->addColumn('profile', function($users) {
          return '<a href="'.route('work.user.profile',$users->id).'"  class="btn waves-effect waves-dark btn-info btn-outline-info btn-icon" title="View"><i class="fa fa-eye"></i></a>';
        })
      ->addColumn('active', function($users) {

            if($users->active==1){
              //if activated
                  $confirmation          = '\'Do You Want to Deactivate '.$users->name.' ? \'';
                 return '
                 <a href="'.route('work.user.deactivate',$users->id).'"  class="btn waves-effect waves-dark btn-success btn-outline-success btn-icon" title="User is Activated Click to Deactivate" onclick="return confirm('.$confirmation.');"><i class="fa fa-unlock-alt"></i></a>';
            }elseif($users->active==0){
              //if deactivated
                  $confirmation          = '\'Do You Want to Activate '.$users->name.' ? \'';
                 return '
                 <a href="'.route('work.user.activate',$users->id).'"  class="btn waves-effect waves-dark btn-danger btn-outline-danger btn-icon" title="User is Deactivated Click to Activate" onclick="return confirm('.$confirmation.');"><i class="fa fa-lock"></i></a>';
          }
      })

    ->addColumn('action', function($users) {
        $delete_confirmation          = '\'Do You Want to Delete '.$users->name.' ? \'';
                 return '
                 <a href="'.route('work.user.csv',$users->id).'"  class="btn waves-effect waves-dark btn-primary btn-outline-primary btn-icon" title="Download CSV"><i class="fa fa-download"></i></a>
                 <a href="'.route('work.user.edit',$users->id).'"  class="btn waves-effect waves-dark btn-warning btn-outline-warning btn-icon" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                 <a href="'.route('work.user.delete',$users->id).'"  class="btn waves-effect waves-dark btn-danger btn-outline-danger btn-icon" title="Delete" onclick="return confirm('.$delete_confirmation.');"><i class="fa fa-trash"></i></a>';
                })
    ->rawColumns(['country','date','profile','active','action'])
      // onclick="return confirm('Are you sure you want to Remove?');"
    ->make(true);
	}

    public function index()
    {
      // dd(Auth::guard());
      // dd(Auth::guard('user')->user());
      // dd(Auth::guard('user')->user()->toArray());
      // $user = Auth::guard('user')->user()->toArray();
      //   return view('work.index')
      //   ->with('user', $user)
      //   ;
    }
    public function view_users()
    {
      // dd(Auth::guard());
      $user = User::where('is_admin','0')->get();
      //dd($user);
        return view('app.work.user.index')
        ->with('user', $user);
    }
    public function csv($id)
    {
      $user = User::find([$id]); // All users
     $csvExporter = new \Laracsv\Export();
     $csvExporter->build($user, [
                                 'name',
                                 'email',
                                 'contact_name',
                                 'state',
                                 'city',
                                 'postal_code',
                                 'address',
                                 'phone_number',
                                  ])->download();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('work.user.create')->with('countries',Country::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

///validations//////////////////
$count_name =strlen($request->name);
$count_password =strlen($request->password);
if ($count_name<3) {
      Session::flash('warning','UserName Cannot Be less than 3');
    return redirect()->back();
}
if ($count_password<6) {
      Session::flash('warning','Password Cannot Be less than 6');
    return redirect()->back();
}
      $this->validate($request,[
      'name'=>'required',
      'contact_name'=>'required|min:3',
      'country_id'=>'required',
      'email'=>'required|email',
      'password'=>'required|min:6'
    ]);
// dd($request->all());
if (User::where('name', '=',$request->name)->exists()) {
      Session::flash('warning','User UserName Already Exists');
    return redirect()->back();
}
if (User::where('email', '=',$request->email)->exists()) {
      Session::flash('warning','User Email Already Exists');
    return redirect()->back();
}


    $user = User::create([
        'name'=>str_slug ($request->name),
        'contact_name'=>$request->contact_name,
        'email'=>$request->email,
        'active'=>$request->active,
        'country_id'=>$request->country_id,
        'password'=>bcrypt($request->password)
      ]);
      Session::flash('success','User has been Created');
      // dd($request->all());
        return redirect()->route('users');

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

        $user=User::find($id);
      return view('work.user.edit')
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
    public function update(Request $request, $id)
    {
      $user=User::find($id);
      // dd($request->all());
      $this->validate($request,[
      'name'=>'required|min:3',
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


$user-> country_id = $request->country_id;
$user-> contact_name = $request->contact_name;
$user-> phone_number = $request->phone_number;
$user-> address = $request->address;
$user-> state = $request->state;
$user-> city = $request->city;
$user-> postal_code = $request->postal_code;

$user-> active = $request->active;
$user->save();
Session::flash('success','User: has been Successfully Updated');
return redirect()->route('users');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $setting =Setting::first();
      if($setting->live_production==0){
        Session::flash('info', 'demo');
        return redirect()->back();
      }                                                                                            

      $user = User::find($id);
      
      //deletes invoices
      foreach ($user->invoice as $invoice) {
        ///Note mayb removed
        foreach ($invoice->child as $invoice_child) {
          $invoice_child->forceDelete();
        }
        ///Note mayb removed
        $invoice->forceDelete();
      }

      if (file_exists($user->image)){
        unlink($user->image);
      }
      User::destroy($id);
      Session::flash('info', ' Deleted Successfully');
      return redirect()->back();
    }
    public function profile($id)
    {
      $user=User::find($id);
      $settings =Setting::first();
      $currency=Currency::find($user->currency_id);
      // $user_pro_count = count(User::find($user->id)->products);
      $invoices_count         = $user->invoice->count();
      $amount_spent_with_tax  = collect($user->invoice)->sum('total_amount_with_tax');
      $amount_spent           = collect($user->invoice)->sum('total_amount_without_tax');
      $total_products_bought  = collect($user->invoice)->sum('total_products');
      $total_items_bought     = collect($user->invoice)->sum('total_items');

    return view('work.user.profile')
    ->with('user',$user)
    ->with('currency',$currency)
    ->with('settings',$settings)
    ->with('invoices_count', $invoices_count)
    ->with('total_items_bought', $total_items_bought)
    ->with('total_products_bought', $total_products_bought)
    ->with('amount_spent', $amount_spent)
    ->with('amount_spent_with_tax', $amount_spent_with_tax)
    ->with('countries',Country::all());
    }
    public function activate($id)
    {
      $settings =Setting::first();
      if($settings->live_production==0){
        Session::flash('info', 'demo');
        return redirect()->back();
      }
        $user = User::find($id);
        $user->active=1;
        $user->validation_code = 0;
        $user->save();
        Session::flash('success','Success: Activated');


        $email_data = array(
          'name' => $user['name'],
          'email' => $user['email'],
          'url' => $user['url'],
          'contact_name' => $user['contact_name'],
          'settings' => $settings,
       );

        Mail::send('emails.welcome', $email_data, function($message)use($email_data,$settings)  {
            $message->from($settings->site_email,$settings->site_name);
            $message->to($email_data['email'], $email_data['name']);
            $message->subject( __('messages.Account Activated'));
        });

        return redirect()->back();
    }
    public function deactivate($id)
    {
      $settings =Setting::first();
      if($settings->live_production==0){
        Session::flash('info', 'demo');
        return redirect()->back();
      }
        $user = User::find($id);
        $user->active=0;
        $user->save();
        Session::flash('success','Success: Deactivated');

        $email_data = array(
          'name' => $user['name'],
          'email' => $user['email'],
          'url' => $user['url'],
          'contact_name' => $user['contact_name'],
          'settings' => $settings,
       );

        Mail::send('emails.deactivated', $email_data, function($message)use($email_data,$settings)  {
            $message->from($settings->site_email,$settings->site_name);
            $message->to($email_data['email'], $email_data['name']);
            $message->subject(__('messages.Account De-activated'));
        });


        return redirect()->back();
    }
}
