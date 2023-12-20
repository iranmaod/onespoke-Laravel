<?php

namespace App\Http\Controllers\work;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use Auth;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Currency;
use App\Models\Country;
use App\Models\Setting;
use Goutte\Client;
use RealRashid\SweetAlert\Facades\Alert;
use Session;
use DataTables;
use App\Child_Invoice;
use Sunra\PhpSimple\HtmlDomParser;
class SuppliersController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function get_suppliers_data()
  {
      $suppliers = Supplier::all();
      return view('admin.suppliars',compact('suppliers'));
  }

    public function index()
    {
      // dd(Auth::guard());
      // dd(Auth::guard('supplier')->supplier());
      // dd(Auth::guard('supplier')->supplier()->toArray());
      // $supplier = Auth::guard('supplier')->supplier()->toArray();
      //   return view('work.index')
      //   ->with('supplier', $supplier)
      //   ;
    }
    public function view_suppliers()
    {
      // // dd(Auth::guard());
      // $supplier = Auth::guard('admin')->supplier()->toArray();
        return view('app.work.supplier.index');
    }
    public function csv($id)
    {
      $supplier = Supplier::find([$id]); // All suppliers
     $csvExporter = new \Laracsv\Export();
     $csvExporter->build($supplier, ['name',
                                  'email',
                                  'contact_name',
                                  'amount_sold',
                                  'active',
                                  'created_at',
                                  '',
                                  ])->download();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addsupplier')
        ->with('currencies',Currency::all())
        ->with('countries',Country::all())
        ;
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
if ($count_name<3) {
      Session::flash('warning','SupplierName Cannot Be less than 3');
    return redirect()->back();
}
      $this->validate($request,[
      'name'=>'required',
      'contact_name'=>'required|min:3',
      'country_id'=>'required',
      'email'=>'required|email',
    ]);
// dd($request->all());
if (Supplier::where('name', '=',$request->name)->exists()) {
      Session::flash('warning','Supplier SupplierName Already Exists');
    return redirect()->back();
}
if (Supplier::where('email', '=',$request->email)->exists()) {
      Session::flash('warning','Supplier Email Already Exists');
    return redirect()->back();
}


//
      // $image = $request->image;
      // $image_new_name=time().$image->getClientOriginalName();
      // $image->move('uploads/merchants/',$image_new_name);

    $supplier = Supplier::create([
        'name'=>str_slug ($request->name),
        'contact_name'=>$request->contact_name,
        // 'url'=>$request->url,
        'email'=>$request->email,
        // 'image'=>'uploads/merchants/'.$image_new_name,
        'active'=>$request->active,
        'country_id'=>$request->country_id,
      ]);
      Session::flash('success','Supplier has been Created');
      // alert()->success('Success', 'Supplier has been Created');
      // dd($request->all());
        return redirect()->route('work.suppliers');

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

        $supplier=Supplier::find($id);
      return view('work.supplier.edit')
      ->with('supplier',$supplier)
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
      $supplier=Supplier::find($id);
      // dd($request->all());
      $this->validate($request,[
      'name'=>'required|min:3',
      'contact_name'=>'required',
      'country_id'=>'required',
      'email'=>'required|email',
      'amount_sold'=>'required|numeric|between:0,999999999999999999999999999.99',
    ]);


///
  $setting =Setting::first();
  if($setting->live_production==0){
    Session::flash('info', 'demo');
    return redirect()->back();
  }
///

$supplier-> contact_name = $request->contact_name;
$supplier-> phone_number = $request->phone_number;
$supplier-> amount_sold = $request->amount_sold;
$supplier-> url = $request->url;
$supplier-> price_update_element = $request->price_update_element;
$supplier-> stock_update_element = $request->stock_update_element;
$supplier-> description_update_element = $request->description_update_element;
$supplier-> address = $request->address;
$supplier-> country_id = $request->country_id;
$supplier-> active = $request->active;
$supplier->save();
Session::flash('success','Supplier: has been Successfully Updated');
return redirect()->route('work.suppliers');
    }


    public function update_products($id){//product updater
      $settings =Setting::first();
      if($settings->live_production==0){
        Session::flash('info', 'demo');
        return redirect()->back();
      }
// error_reporting(0);
ini_set('max_execution_time', -1);
      $supplier = Supplier::find($id);
      if (empty($supplier->price_update_element)){
        Session::flash('warning', "Price Update Element is Empty");
        return redirect()->back();
      }
      //check if supplier has Products
      $supplier_pro_count = count(Supplier::find($supplier->id)->products);
      if ($supplier_pro_count==0){
        Session::flash('warning', "NO Product was found for this supplier");
        return redirect()->back();
    }

      ///------------------------------Session-----------------------------///
      Session::put('counter', 0);
      ///------------------------------Session-----------------------------///
      foreach ($supplier->products as $product) {
        sleep(rand(1,2)) ;
        //skip if product url is empty
        if (empty($product->original_url)){
          continue;
        }


        $product_url ="$product->original_url";
        $product_price_element = "$supplier->price_update_element";
        $product_stock_element = "$supplier->stock_update_element";
        $product_description_element = "$supplier->description_update_element";

        $client = new Client();
        $client->setHeader("user-agent", "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0");
        $crawler = $client->request('GET', $product_url);
        if (false == ( $crawler = $client->request('GET', $product_url))) {
          // Error
            continue;
        }
        if (empty($crawler)){
          // Error
            continue;
        }

      if ($crawler->filter($product_price_element)->count() > 0 ) {
        $product_description='';
        $product_price='';
        $product_stock ='';
          $price = $crawler->filter($product_price_element)->text();
          $price = strtok($price, 'to');
          // $price = preg_replace('/[^\p{L}\p{N}\s]/u', '', $price); //removes special charaters
          $price = preg_replace("/[^0-9.]/", "", $price);
          $price = str_replace(',', '', $price);
          $product_price = str_replace(' ', '', $price);

        $ebay_product_url = substr( $product->original_url, 0, 20 ) === "https://www.ebay.com";
        $ali_product_url  = substr( $product->original_url, 0, 26 ) === "https://www.aliexpress.com";

        if ($crawler->filter($product_stock_element)->count() > 0 ) {//a.vip
            $product_stock = $crawler->filter($product_stock_element)->text();
            $product_stock = str_replace('Last one', 1, $product_stock);
            $product_stock = str_replace('pieces available', '', $product_stock);
            $product_stock = str_replace(' ', '', $product_stock);
            $product_stock = preg_replace("/[^0-9]/", "", $product_stock);
        }elseif($crawler->filter("#isCartBtn_btn")->count() > 0 && $ebay_product_url=1) {//Wbay specific for products not showing Last one or Quantity
              $product_stock = 1;
        }elseif($crawler->filter("#j-add-cart-btn")->count() > 0 && $ali_product_url=1) {//Ali specific products
              $product_stock = 1;
        }else{
          $product_stock = 0;
        }
        /////////////////////Redundant //////////////////////////////
        if (empty($product_stock)){
          $product_stock = 0;
          // Session::flash('warning',"Retuned Empty - Stock Moved to 0");
        }
        if($crawler->filter("#isCartBtn_btn")->count() > 0 && $ebay_product_url=1) {//Ebay specific for products not showing Last one or Quantity
              // Session::flash('warning',"Stock Moved to (1) beacause CartButton is active, Check Stock Element ");
              $product_stock = 1;
        }
        if($crawler->filter("#j-add-cart-btn")->count() > 0 && $ali_product_url=1) {//Ali specific products
              $product_stock = 1;
              // Session::flash('warning',"Stock Moved to (1) beacause CartButton is active, Check Stock Element ");
        }
      /////////////////////////////////////////////////////////////


        if ($crawler->filter($product_description_element)->count() > 0 ) {//a.vip
            $product_description = $crawler->filter($product_description_element)->html();
        }
        // dump($product_stock." Stock.<hr/>");
        // dump($price." Price.<hr/>");
        // // dd("here");
        // dd($product_description);


        //if the new price is empty
        if (empty($product_price)){
          // return true;//skip
          continue;
        }
        // if description has value
        if (!empty($product_description)){
          $product->description = $product_description;
        }

        // dd('here');
        if (!empty($product_price)){
          //gain calculation
          $percentage_value = ($product_price/100)*$settings->price_percent_gain;//get percentage value
          $new_price = $product_price + $percentage_value;//gets new sale price
          //save
          $product->supplier_price = $product_price;
          $product->price = $new_price;
          $product->stock = $product_stock;
          $product->save();

          ///------------Session-----------///
          $counter = Session::get('counter');
          $counter++;
          Session::put('counter', $counter);
          ///------------Session-----------///
        }


   };

}
///------------Session-----------///
$counter = Session::get('counter');
//-----------UNSET----------------//
  Session::forget('counter');
///------------Session-----------///

    Session::flash('success',"Success: Updated ($counter) Products");
    // return redirect()->route('products');
    return redirect()->back();
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
       

      $supplier = Supplier::find($id);
      ///getting main products on the supplier
      foreach ($supplier->products->where('parent_id', '=', 0) as $supp_product) {
        //getting variant of the main product
        foreach ($supp_product->variants as $supp_pro_variant) {
        if (file_exists($supp_pro_variant->image)){
          unlink($supp_pro_variant->image);
        }
        if (file_exists($supp_pro_variant->image_ex1)){
          unlink($supp_pro_variant->image_ex1);
        }
        if (file_exists($supp_pro_variant->image_ex2)){
          unlink($supp_pro_variant->image_ex2);
        }
        if (file_exists($supp_pro_variant->image_ex3)){
          unlink($supp_pro_variant->image_ex3);
        }
        if (file_exists($supp_pro_variant->image_ex4)){
          unlink($supp_pro_variant->image_ex4);
        }
        if (file_exists($supp_pro_variant->image_ex5)){
          unlink($supp_pro_variant->image_ex5);
        }
        $supp_pro_variant->forceDelete();
      }//end delete variants

        //continue to delete main product
        if (file_exists($supp_product->image)){
          unlink($supp_product->image);
        }
        if (file_exists($supp_product->image_ex1)){
          unlink($supp_product->image_ex1);
        }
        if (file_exists($supp_product->image_ex2)){
          unlink($supp_product->image_ex2);
        }
        if (file_exists($supp_product->image_ex3)){
          unlink($supp_product->image_ex3);
        }
        if (file_exists($supp_product->image_ex4)){
          unlink($supp_product->image_ex4);
        }
        if (file_exists($supp_product->image_ex5)){
          unlink($supp_product->image_ex5);
        }
        // dd('edge of deleting');
        $supp_product->forceDelete();//deletes main product
      }//
      // end deleting main product
      //deletes invoices
      // dd($supplier->invoice.'here');
      // foreach ($supplier->invoice as $invoice) {
      //   // run chile invoices delete
      //   // run chile invoices delete
      //   $invoice->forceDelete();
      // }

      if (file_exists($supplier->image)){
        unlink($supplier->image);
      }
      Supplier::destroy($id);
      Session::flash('info', ' Deleted Successfully');
      return redirect()->back();
    }
    public function profile($id)
    {
      $supplier=Supplier::find($id);
      $settings =Setting::first();
      $supplier_pro_count = count(Supplier::find($supplier->id)->products->where('parent_id', '=', 0));
      //finance
      // $invoice->child
    $invoices_count         = $supplier->sub_invoice->count();
    $amount_spent_with_tax  = collect($supplier->sub_invoice)->sum('price_with_tax');
    $amount_spent           = collect($supplier->sub_invoice)->sum('price_without_tax');
    $total_products_bought  = $invoices_count;
    $total_items_bought     = collect($supplier->sub_invoice)->sum('product_quantity');//sum of individual items sold
    return view('work.supplier.profile')
    ->with('supplier',$supplier)
    ->with('settings',$settings)
    ->with('supplier_pro_count',$supplier_pro_count)
    ->with('total_items_bought', $total_items_bought)
    ->with('total_products_bought', $total_products_bought)
    ->with('amount_spent', $amount_spent)
    ->with('amount_spent_with_tax', $amount_spent_with_tax)
    ->with('invoices_count', $invoices_count);
    }
    public function activate($id)
    {
      $settings =Setting::first();
      if($settings->live_production==0){
        Session::flash('info', 'demo');
        return redirect()->back();
      }
        $supplier = Supplier::find($id);
        $supplier->active=1;
        $supplier->validation_code = 0;
        $supplier->save();
        Session::flash('success','Success: Activated');


       //  $email_data = array(
       //    'name' => $supplier['name'],
       //    'email' => $supplier['email'],
       //    'url' => $supplier['url'],
       //    'contact_name' => $supplier['contact_name'],
       //    'settings' => $settings,
       // );
       //
       //  Mail::send('emails.welcome', $email_data, function($message)use($email_data,$settings)  {
       //      $message->from($settings->site_email,$settings->site_name);
       //      $message->to($email_data['email'], $email_data['name']);
       //      $message->subject('Account Activated');
       //  });


        return redirect()->back();
    }
    public function deactivate($id)
    {
      $settings =Setting::first();
      if($settings->live_production==0){
        Session::flash('info', 'demo');
        return redirect()->back();
      }
        $supplier = Supplier::find($id);
        $supplier->active=0;
        $supplier->save();
        Session::flash('success','Success: Deactivated');

       //  $email_data = array(
       //    'name' => $supplier['name'],
       //    'email' => $supplier['email'],
       //    'url' => $supplier['url'],
       //    'contact_name' => $supplier['contact_name'],
       //    'settings' => $settings,
       // );

        // Mail::send('emails.deactivated', $email_data, function($message)use($email_data,$settings)  {
        //     $message->from($settings->site_email,$settings->site_name);
        //     $message->to($email_data['email'], $email_data['name']);
        //     $message->subject('Account De-activated');
        // });


        return redirect()->back();
    }
    ////delete all products for the supplier
    public function supplier_products_delete($id)
    {
      $setting =Setting::first();
      if($setting->live_production==0){
        Session::flash('info', 'demo');
        return redirect()->back();
      }

      $supplier = Supplier::find($id);
      //find and deletes products of the supplier
      $pi = 0;
      ///getting main products on the supplier
      foreach ($supplier->products->where('parent_id', '=', 0) as $supp_product) {
        //getting variant of the main product
        foreach ($supp_product->variants as $supp_pro_variant) {
        if (file_exists($supp_pro_variant->image)){
          unlink($supp_pro_variant->image);
        }
        if (file_exists($supp_pro_variant->image_ex1)){
          unlink($supp_pro_variant->image_ex1);
        }
        if (file_exists($supp_pro_variant->image_ex2)){
          unlink($supp_pro_variant->image_ex2);
        }
        if (file_exists($supp_pro_variant->image_ex3)){
          unlink($supp_pro_variant->image_ex3);
        }
        if (file_exists($supp_pro_variant->image_ex4)){
          unlink($supp_pro_variant->image_ex4);
        }
        if (file_exists($supp_pro_variant->image_ex5)){
          unlink($supp_pro_variant->image_ex5);
        }
        $supp_pro_variant->forceDelete();
      }//end delete variants

        //continue to delete main product
        if (file_exists($supp_product->image)){
          unlink($supp_product->image);
        }
        if (file_exists($supp_product->image_ex1)){
          unlink($supp_product->image_ex1);
        }
        if (file_exists($supp_product->image_ex2)){
          unlink($supp_product->image_ex2);
        }
        if (file_exists($supp_product->image_ex3)){
          unlink($supp_product->image_ex3);
        }
        if (file_exists($supp_product->image_ex4)){
          unlink($supp_product->image_ex4);
        }
        if (file_exists($supp_product->image_ex5)){
          unlink($supp_product->image_ex5);
        }
        // dd('edge of deleting');
        $supp_product->forceDelete();//deletes main product
        $pi++;
      }//
      // end deleting main product
      Session::flash('info', "Successfully  Deleted ($pi) Products");
      return redirect()->back();
    }
}
