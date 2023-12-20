<?php

namespace App\Http\Controllers\work\crawler;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Goutte\Client;
use Sunra\PhpSimple\HtmlDomParser;
use App\Setting;
use App\Product;
use App\User;
use App\Supplier;
use App\Category;
use App\CrawlerEbay;
use Session;
class EbayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth:admin');
         // $site_settings = Setting::first();
     }
    public function index()
    {
      $crawler_ebay        = CrawlerEbay::first();
      $categories = Category::attr(['name' => 'category_id', 'class' => 'form-control show-tick'])
            ->selected(1)
            ->renderAsDropdown();
       return view('work.crawl.ebay')
       ->with('suppliers',Supplier::all())
       ->with ('categories',$categories)
       ->with ('crawler_ebay',$crawler_ebay);
    }

    public function edit_ebay()
    {
       // $site_settings = Setting::first();
       $crawler_ebay = CrawlerEbay::first();
        return view('work.crawl.ebay_edit')
         ->with ('crawler_ebay',$crawler_ebay);
    }
    public function save_ebay(Request $request)
    {
      $this->validate($request,[
      'product_block_ini'=>'required',
      'product_name_element'=>'required',
      'product_url_element'=>'required',
      'product_image_element'=>'required',
      'product_price_element'=>'required',
    ]);
    $crawler_ebay = CrawlerEbay::first();
    $crawler_ebay-> product_block_ini     = $request->product_block_ini;
    $crawler_ebay-> product_name_element  = $request->product_name_element;
    $crawler_ebay-> product_url_element   = $request->product_url_element;
    $crawler_ebay-> product_image_element = $request->product_image_element;
    $crawler_ebay-> product_price_element = $request->product_price_element;
    $crawler_ebay->save();
    Session::flash('success','Success');
    return redirect()->route('work.crawl.ebay');
    }
    public function ebay_run(Request $request)
    {
      ///------------------------------Session-----------------------------///
      Session::put('i',  1);
      Session::put('total_imported',  0);
      Session::put('count_skipped_exists',  0);
      Session::put('count_skipped_incomplete',  0);
      Session::put('count_skipped_updated_prices',  0);
      Session::put('count_total_run', 0);
      ///------------------------------Session-----------------------------///

      $this->validate($request,[
      'supplier_id'=>'required',
      'category_id'=>'required',
      'keywords'=>'required',
      ]);
    error_reporting(0);
    ini_set('max_execution_time', -1);

    // Declearations
    $product_supplier      = $request->supplier_id;
    $product_category      = $request->category_id;

    $CrawlerEbay           = CrawlerEbay::first();
    $product_block_ini     = $CrawlerEbay->product_block_ini;//'div.sku'
    $product_name_element  = $CrawlerEbay->product_name_element; //span[class="name"]
    $product_url_element   = $CrawlerEbay->product_url_element;
    $product_image_element = $CrawlerEbay->product_image_element;
    $product_price_element = $CrawlerEbay->product_price_element;


    $keywords           	 = $request->keywords;
    $keywords 		         = str_replace(' ', '+', $keywords);
    $depth          	     = $request->depth;//products per page

    $page	            	   = $request->page;//start page
    // dd($page.' Page )-|-( Depth Products per Page '.$depth);
    Session::put('page',  $page);
    $max_page	             = $request->max_page;
    $minimum_price	       = $request->minimum_price;
    // $sort 			           = '?sort=Price%3A+High+to+Low&dir=desc';
    ////////////////demo//////////////
    $settings =Setting::first();
    if($settings->live_production==0 && $request->depth > 5){
      Session::flash('info', 'On demo you can  import only 5 products at a time');
      return redirect()->back();
    }
    ////////////////demo//////////////

    $products = [];

    ////////////////////////////////////////////////////////////////////
    ////// Get product blocks and extract info (also insert to db) /////
    ////////////////////////////////////////////////////////////////////
    // $page = Session::get('page');
    while (Session::get('page') <= $max_page){
      $page = Session::get('page');
    // sleep(rand(1,2)) ;// periodic cool down. helps to avoid ban.

    $client = new Client();
    $client->setHeader("user-agent", "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0");
    $crawler = $client->request('GET', "https://www.ebay.com/sch/i.html?_from=R40&_nkw=$keywords&_pgn=$page");

    $crawler->filter($product_block_ini)->each(function($node)
    use($product_name_element,
        $product_url_element,
        $product_image_element,
        $product_price_element,
        $product_category,
        $product_supplier,
        $keywords,
        $depth,
        $max_page,
        $minimum_price,
        $settings){ //div.s-item__wrapper //globals

    static $i = 1;
    // ///------------Session-----------///
    // $i = Session::get('i');
    // ///------------Session-----------///
      if ($i > $depth) {
      $count_total_run ++;
              // break;
              // alert()->success('Err', "I $i  >  Depth $depth")->showCloseButton()->autoClose(15000);
              // return redirect("account/invoice/view/$invoice_number");
              return false;//skip

      }
    $product_name='';
    $product_price='';
    $product_image='';
    $product_original_url ='';


    //sub elements
    if ($node->filter($product_name_element)->count() > 0 ) {//a.vip
        $product_name = $node->filter($product_name_element)->text();
    }

    if ($node->filter($product_price_element)->count() > 0 ) {//span.bold
      $price = $node->filter($product_price_element)->text();
      $price=substr($price, 0, strrpos($price, ' '));
      $price = strtok($price, 'to');
      // $price = preg_replace('/[^\p{L}\p{N}\s]/u', '', $price); //removes special charaters
      $price = preg_replace("/[^0-9.]/", "", $price);
      $price = str_replace(',', '', $price);
      $product_price = str_replace(' ', '', $price);
    }
    if ($node->filter($product_image_element)->count() > 0 ) { //a.img.imgWr2 .imgWr2
      $product_image = $node->filter($product_image_element)->attr('src');
    }
    if ($node->filter($product_url_element)->count() > 0 ) {
      $product_original_url = $node->filter($product_url_element)->link()->getUri();
    }
    //sub elements

    //



      // get description attribute
      $product_description =  $product_name;
      // get product_url_slug attribute
      $product_url_slug = str_slug($product_name);
      //gain calculation
      $percentage_value = ($product_price/100)*$settings->price_percent_gain;//get percentage value
      $new_price = $product_price + $percentage_value;//gets new sale price

      //check for empty fields and rows
      if (empty($product_name) || empty($product_original_url) || empty($product_image) || empty($product_price)) {

      ///------------Session-----------///
      $count_skipped_incomplete = Session::get('count_skipped_incomplete');
      $count_skipped_incomplete++;
      Session::put('count_skipped_incomplete', $count_skipped_incomplete);
      //-------------------------------//
      $count_total_run = Session::get('count_total_run');
      $count_total_run++;
      Session::put('count_total_run', $count_total_run);
      ///------------Session-----------///
      // continue;
       return true;
      }

     //  dump($product_name);
     // dump($product_price);
     // dump($new_price);
     // dump($product_image);
     // dump($product_original_url);
     // dd("here");

     // $data = array(
     //   'name' => $product_name,
     //   'supplier_price'=>$product_price,
     //   'price'=>$new_price,
     //   'image' => $product_image,
     //   'original_url' => $product_original_url,
     //    );
     //    dump($data);



      if ($product_price >= $minimum_price){

          // push to a list of products
          // $products[] = [
          //   'name'=>$product_name,
          // ];

          //start import
          $product = Product::create([
            'name'=>$product_name,
            'description'=>$product_description,
            'category_id'=>$product_category,
            'supplier_price'=>$product_price,
            'price'=>$new_price,
            'stock'=>$settings->default_quantity,
            'supplier_id'=>$product_supplier,
            'original_url'=>$product_original_url,
            'slug'=>$product_url_slug,
            'image'=>$product_image,
          ]);
          ///------------Session-----------///
          $total_imported = Session::get('total_imported');
          $total_imported++;
          Session::put('total_imported', $total_imported);
          //-------------------------------//
          $count_total_run = Session::get('count_total_run');
          $count_total_run++;
          Session::put('count_total_run', $count_total_run);
          ///------------Session-----------///

      }//end import

    ///------------Session-----------///
    // $i = Session::get('i');
    $i++;
    // Session::put('i', $i);
    //-------------------------------//
    $count_total_run = Session::get('count_total_run');
    $count_total_run++;
    Session::put('count_total_run', $count_total_run);
    ///------------Session-----------///
  });


  $page = Session::get('page');
  $page += 1;
  Session::put('page', $page);




  }
  ///------------Session-----------///
  $i = Session::get('i');
  $total_imported = Session::get('total_imported');
  $count_skipped_exists = Session::get('count_skipped_exists');
  $count_skipped_incomplete = Session::get('count_skipped_incomplete');
  $count_skipped_updated_prices = Session::get('count_skipped_updated_prices');
  $count_total_run = Session::get('count_total_run');
  //-----------UNSET--------------------//
    Session::forget('i');
    Session::forget('total_imported');
    Session::forget('count_skipped_exists');
    Session::forget('count_skipped_incomplete');
    Session::forget('count_skipped_updated_prices');
    Session::forget('count_total_run');
    Session::forget('page');

  ///------------Session-----------///
    // dump($i ." i");
    // dump($total_imported ." total_imported");
    // dump($count_skipped_exists ." count_skipped_exists");
    // dump($count_skipped_incomplete ." count_skipped_incomplete");
    // dump($count_skipped_updated_prices ." count_skipped_updated_prices");
    // dump($count_total_run ." count_total_run");
    // dd("END");
    // $grand_total_imported = count($products);
    return redirect()->back()->with('message',"<div class='text-center'
                              style=' width: auto;
                              padding: 10px;
                              border: 5px solid gray;
                              margin: 0;''>
                              <div style='Color:black'> Keywords: $keywords</div><br />
                              <div style='Color:green'> Imported ($total_imported) Products</div><br />
                              <div style='Color:blue'> Price Updated $count_skipped_exists </div><br />
                              <div style='Color:red'> Skipped $count_skipped_incomplete </div>
                            </div>")
                            ->with('products', $products);
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
