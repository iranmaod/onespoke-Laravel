<?php

namespace App\Http\Controllers\work;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Goutte\Client;
use Sunra\PhpSimple\HtmlDomParser;
class RegexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth:admin');
     }
     public function ali()
     {
dump('==================================================== Start ===================================================');
$client = new Client();
$client->setHeader("user-agent", "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0");
$crawler = $client->request('GET', 'https://www.aliexpress.com/af/book.html?site=glo&SearchText=book&page=2&blanktest=0&origin=n&jump=afs');
$crawler->filter('.list-item-180')->each(function($node) { //div.s-item__wrapper
  // dd($node->text());
$name='';
$price='';
$image='';
$link ='';

if ($node->filter('h3 span')->count() > 0 ) {//a.vip
    $name = $node->filter('h3 span')->text();
}
if ($node->filter('span.value')->count() > 0 ) {//span.bold
  $price = $node->filter('span.value')->text();
  $price = str_replace(',', '', $price);
  $price = str_replace('US', '', $price);
  $price = str_replace(' ', '', $price);
  $price = preg_replace("/[^0-9,.]/", "", $price);
  // $price = preg_replace('/[^\p{L}\p{N}\s]/u', '', $price); //removes special charaters
}
if ($node->filter('img.picCore')->count() > 0 ) { //a.img.imgWr2 .imgWr2
  $image = 'https:'.$node->filter('img.picCore')->attr('src');
}
if ($node->filter('h3 a.history-item')->count() > 0 ) {
  $link = $node->filter('h3 a.history-item')->link()->getUri();
}
dump($name);
dump($price);
dump($image);
dump($link);
dump('=== Break ===');

// $data = array(
//   'name' => $name,
//   'price' => $price,
//   'image' => $image,
//   'original_url' => $link,
//    );
//    dump($data);

 });
 //////////////////////////////////////////////////////////////////////////
 dd("==================================================== End ===================================================");

     }
public function ebay(){
dump('==================================================== Start ===================================================');
$client = new Client([
      'timeout' => 240,
      'verify' => false,
  ]);
$client->setHeader("user-agent", "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0");
$crawler = $client->request('GET', 'https://www.ebay.com/sch/i.html?_from=R40&_nkw=iphone&_pgn=1');
$crawler->filter('li.s-item')->each(function($node) { //div.s-item__wrapper
  // dump($node->text());
  
$name='';
$price='';
$image='';
$link ='';
$stock='';

if ($node->filter('h3.s-item__title')->count() > 0 ) {//a.vip
    $name = $node->filter('h3.s-item__title')->text();
}
if ($node->filter('span.s-item__price')->count() > 0 ) {//span.bold
  $price = $node->filter('span.s-item__price')->text();
  $price = str_replace(',', '', $price);
  $price = str_replace(' ', '', $price);
  $price = preg_replace('/[^\p{L}\p{N}\s]/u', '', $price); //removes special charaters
  $price = strtok($price, 'to');
}
if ($node->filter('img.s-item__image-img')->count() > 0 ) { //a.img.imgWr2 .imgWr2
  $image = $node->filter('img.s-item__image-img')->attr('src');
}
if ($node->filter('a.s-item__link')->count() > 0 ) {
  $link = $node->filter('a.s-item__link')->link()->getUri();
}
////////////////////////////////upen url

$client_sub = new Client([
      'timeout' => 240,
      'verify' => false,
  ]);
$client_sub->setHeader("user-agent", "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0");
$crawler_sub = $client_sub->request('GET', "$link");

if (!empty($crawler_sub->filter('span.qtyTxt span span'))) {
  $stock =  $crawler_sub->filter('span.qtyTxt span span')->text();
     $stock = (int) filter_var($stock, FILTER_SANITIZE_NUMBER_INT);
     $stock = str_replace(' ', '', $stock);
     $stock = str_replace(',', '', $stock);
     $stock = preg_replace('/[^\p{L}\p{N}\s]/u', '', $stock); //removes special charaters
}

////////////////////////////////upen url
// dump($name);
// dump($price);
// dump($image);
// dump($link);
// dd($stock);
dump('=== Break ===');

$data = array(
  'name' => $name,
  'price' => $price,
  'image' => $image,
  'stock' => $stock,
  'original_url' => $link,
   );
   dump($data);

 });
  $stock ='';
 //////////////////////////////////////////////////////////////////////////
 dd("==================================================== End ===================================================");

     }

     public function run()
     {
       dump('==================================================== Start ===================================================');
       // $client = new Client();
  // $url = "http://www.reddit.com";
//   $url = "https://www.reddit.com/";
//  $css_selector = ".dZOwqG";
//  $thing_to_scrape = "_text";
//  // $thing_to_scrape = "src";
//  // $thing_to_scrape = "class";
//  // $thing_to_scrape = "href";
//
//  $client = new Client();
//  $crawler = $client->request('GET', $url);
//  $output = $crawler->filter($css_selector)->extract($thing_to_scrape);
//
// dump($output);
// \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

$client = new Client();
$client->setHeader("user-agent", "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0");
$crawler = $client->request('GET', 'https://www.jumia.com.ng/catalog/?q=books');
// // $previewUrl = $node->filter('.blog-preview')->attr('href');
$crawler->filter('.sku.-gallery')->each(function($node) {
$name='';
$price='';
$image='';
$link ='';

if ($node->filter('.name')->count() > 0 ) {
    $name = $node->filter('.name')->text();
}
if ($node->filter('span.price')->count() > 0 ) {
  $price = $node->filter('span.price')->text();
  $price = str_replace(',', '', $price);
  $price = str_replace(' ', '', $price);
  $price = preg_replace('/[^\p{L}\p{N}\s]/u', '', $price); //removes special charaters
}
if ($node->filter('.lazy.image')->count() > 0 ) {
  $image = $node->filter('.lazy.image')->attr('data-src');
}
if ($node->filter('a.link')->count() > 0 ) {
  $link = $node->filter('a.link')->link()->getUri();
}
// dump($name);
// dump($price);
// dump($image);
// dump($link);


// $data = array(
//   'name' => $name,
//   'price' => $price,
//   'image' => $image,
//   'original_url' => $link,
//    );
//    dump($data);
//
// dump('=== Break ===');
  // //div[class="sku -gallery"]
  // //span[class="name"]
  // //a[class="link"]
  // //*[class="lazy image"]
  // //span.price

  // // Hackery to allow HTTPS
  //   $guzzleclient = new \GuzzleHttp\Client([
  //       'timeout' => 60,
  //       'verify' => false,
  //   ]);
 });
 dump($data);
 //////////////////////////////////////////////////////////////////////////
 dd("==================================================== End ===================================================");

     }
    public function index()
    {
      return view('work.settings.regex');

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function run_regex(Request $request)
    {

        error_reporting(0);
        $product_url                    = $request->product_url;
        $product_block                  = $request->product_block;
        $product_block_element          = $request->product_block_element;

        $depth=1;
        //user Agent
      $opts = array(
                  'http'=>array(
                      'method'=>"GET",
                      'header'=>"Accept-language: en\r\n" .
                      "User-Agent:    Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6\r\n".
                      "Cookie: foo=bar\r\n"
                  )
              );
      $context = stream_context_create($opts);
        // stream_context_set_params($context, array('user_agent' => 'UserAgent/1.0'));

        // Create DOM from URL or file
        $url = file_get_contents($product_url);
        $html = HtmlDomParser::str_get_html("$url", 0, $context);
        //Skipps all products with errors
    if (false == ($html = HtmlDomParser::str_get_html("$url", 0, $context))) {
      return redirect()->back()->with('message',"<div class='alert alert-warning text-center'>  Err: Can't Read Url</div>");
    }

        // creating an array of elements
        $products = [];

        // Find top ten products
        $i = 1;               //div.product-block
        foreach ($html->find("$product_block") as $productBlock) {
                if ($i > $depth) {
                        break;
                }

                // Find item link element
            $FindProductPrice = $productBlock->find("$product_block_element", 0);
            //$FindProductPrice = $productBlock->find('div[class="original-price"]', 0);
            // get price attribute
            $str = $FindProductPrice->plaintext;
            $str = str_replace(' ', '', $str);
            $str = substr($str, 7);
            $str = str_replace(',', '', $str);
            $product_price_element =$str;


                // push to a list of products
                $products[] = [

                'product_price'	 	  => $product_price_element,

                ];


                $i++;
        }

        if (empty($product_price_element)){ //echo "Err product_price is Empty";
          return redirect()->back()
          ->with('message',"<div class='alert alert-warning text-center'> Err: Empty</div>");
        }

      //   print_r($products);
      // echo "<p class='bg-success text-center'>Clean :$product_price_element</p>";

      $html->clear();
        unset($html);

        return redirect()->back()->with('message',"<div class='alert alert-success text-center'>  Clean: $product_price_element</div>");

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
