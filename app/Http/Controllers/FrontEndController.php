<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use App\Models\User;
use App\Models\Currency;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Invoice;
use Session;
use App\Models\Products;
use App\Models\Post;
use App\Models\Page;
use App\Models\Slider;

use App;
use Mail;
use URL;
use DataTables;
class FrontEndController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      //homepage
      $settings =Setting::first();
      
      //random products
      $products = Products::where('parent_id', '=', 0)->inRandomOrder()->limit($settings->home_rand_pro)->get();
      //get 4 latest posts
      $posts = Post::orderBy('id', 'desc')->take($settings->home_posts)->get();
      $users = User::where('active', '=',1)->take($settings->home_users)->get();
      // $users = User::orderBy('id', 'desc')->take($settings->home_users)->get();
      return view('app.index')
    ->with('latest_product',Products::where('parent_id', '=', 0)->orderBy('id','desc')->first())
    ->with('most_viewed_product',Products::where('parent_id', '=', 0)->orderBy('views_count','desc')->first())
    ->with('next_to_latest_product',Products::where('parent_id', '=', 0)->orderBy('id','desc')->skip(1)->take(1)->get()->first())
    ->with('categories',(Category::all()))
    ->with('pages',(Page::all()))
    ->with('slides',(Slider::all()))
    ->with('products',$products)
    ->with('posts',$posts)
    ->with('users',$users)
    ->with('settings',$settings);
    }
    public function blogs()
    {
        $settings =Setting::first();
        $posts = Post::orderBy('id', 'desc')->paginate(6);
        return view('app.blogs')
        ->with('posts',$posts)
        ->with('categories',(Category::all()))
        ->with('pages',(Page::all()))
        ->with('settings',$settings);
    }

    public function blog_page($slug)
    {

      $settings =Setting::first();
      $post=Post::where('slug',$slug)->first();
      return view('app.blog_page')
      ->with('post',$post)
      ->with('categories',(Category::all()))
      ->with('pages',(Page::all()))
      ->with('settings',$settings);


    }
    public function single_page($slug)
    {

      $settings =Setting::first();
      $page=Page::where('slug',$slug)->first();
      return view('page')
      ->with('page',$page)
      ->with('categories',(Category::all()))
      ->with('pages',(Page::all()))
      ->with('settings',$settings);


    }
    public function category_page($slug)
    {
      $settings =Setting::first();
      $category_page = Category::where('slug',$slug)->first();
      //get category products
      $products =Products::where('parent_id', '=', 0)->where('category_id',$category_page->id)->paginate(9);
      return view('category_page')
      ->with('category_page',$category_page)
      ->with('products',$products)
      ->with('categories',(Category::all()))
      ->with('pages',(Page::all()))
      ->with('settings',$settings);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function feed()
    {
      
      // create new feed
$feed = App::make("feed");
$settings =Setting::first();

// multiple feeds are supported
// if you are using caching you should set different cache keys for your feeds

// cache the feed for 60 minutes (second parameter is optional)
$feed->setCache(60, 'laravelFeedKey');

// check if there is cached feed and build new only if is not
if (!$feed->isCached())
{
 // creating rss feed with our most recent 20 posts
 $products = \DB::table('products')->where('parent_id', '=', 0)->orderBy('created_at', 'desc')->take(20)->get();

 // set your feed's title, description, link, pubdate and language
 $feed->title = $settings->site_name;
 $feed->description = $settings->site_about;
 $feed->logo = asset($settings->logo);
 $feed->link = url('feed');
 $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
 $feed->pubdate = $products[0]->created_at;
 $feed->lang = 'en';
 $feed->setShortening(true); // true or false
 $feed->setTextLimit(100); // maximum length of description text

 foreach ($products as $product)
 {
   $product_url = $product->slug.'-'.$product->id;
   $product_image = asset($product->image);
   $enclosure = ['url'=>"$product_image",'type'=>'image/jpeg'];
     // set item's title, author, url, pubdate, description, content, enclosure (optional)*
     $feed->add($product->name,$product->supplier_id, URL::to($product_url), $product->created_at, $product->description,$product->description,$enclosure);

     // $feed->addArray([
     // 'title' => $product->name,
     // 'author' => $product->user_id,
     // 'url' => $product_url,
     // 'pubdate' => $someDate,
     // 'description' => $product->description,
     // 'content' => $product->description,
     // 'media:content' => [
     //   'url' => $product_image,
     //   'height' => '768',
     //   'width' => '1024'
     // ],
     // ]);
 }


}

// first param is the feed format
// optional: second param is cache duration (value of 0 turns off caching)
// optional: you can set custom cache key with 3rd param as string
return $feed->render('atom');

// to return your feed as a string set second param to -1
// $xml = $feed->render('atom', -1);
}
public function contact()
{

  $settings =Setting::first();
  return view('app.contact')
  ->with('categories',(Category::all()))
  ->with('pages',(Page::all()))
  ->with('settings',$settings);


}
public function contact_send(Request $request)
{
      // dd($request->all());
      $settings =Setting::first();
      $this->validate($request,[
        'name'=>'required',
        'email'=>'required|email',
        'subject'=>'required',
        'content'=>'required',
		'g-recaptcha-response' => 'required|captcha',
    ]);
    $data = array(
      'name'=>$request->name,
      'email'=>$request->email,
      'subject'=>$request->subject,
      'content'=>$request->content,
      'settings' => $settings,

   );
    Mail::send('emails.contact',$data, function($message) use($data,$settings){
      $message->from($data['email'],'Contact: '.$settings->site_name);
      $message->to($data['email'],$data['name']);//sends to sender
      $message->subject($data['subject']);
      $message->bcc($settings->site_email,'Admin');//sends to admin
      // $message->reply_to();
      // $message->cc();
    });
    Session::flash('success',__('messages.Thank you for Contacting us,We will get back to you shortly'));
    return redirect('/contact');

}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


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
    

    ////new///
    public function showLoginForm(){
      //dd("hello");
      return view('app.auth.admin_login')
      ->with('categories',(Category::all()))
      ->with('settings',Setting::first())
      ->with('pages',Page::all());
    }
    public function login(Request $request){
       
      $this->validate($request, [
        'email' =>'required|email',
        'password'=>'required|min:6',
        // 'g-recaptcha-response' => 'required|captcha',
      ]);
      return redirect()->intended(url('/work') );
      // if (Auth::guard ('admin')->attempt(['email'=>$request->email,'password'=>$request->password], $request->remember)){
      //   //destroy existing session 
      //   Auth::guard('web')->logout(); 
      //   return redirect()->intended(url('/work') );
      // }
     
      // return redirect()->back()->withInput($request->only('email','remember'));
    }
    public function adminindex()
    {
      $admin    = Auth::user();
      $settings = Setting::first();
      $products = Products::all();
      $invoices = Invoice::all();
      $products_count = Products::all()->count();
      $products_impressions = collect($products)->sum('views_count');
      // $products_clicks = collect($products)->sum('cart_count');
      $users = User::all();
      $users_count = User::all()->count();
      $users_credits = collect($users)->sum('credit');
      $inactive_users =User::where('active', '=',0)->count();

      //fin
      $invoices_count         = $invoices->count();
      $amount_spent           = collect($invoices)->sum('total_amount_with_tax');
      $total_products_bought  = collect($invoices)->sum('total_products');
      $total_items_bought     = collect($invoices)->sum('total_items');

        return view('app.work.index')
        ->with('admin', $admin)
        ->with('settings', $settings)
        ->with('products_count', $products_count)
        ->with('products_impressions', $products_impressions)
        ->with('inactive_users', $inactive_users)
        ->with('users_count', $users_count)
        ->with('users_credits', $users_credits)
        ->with('total_items_bought', $total_items_bought)
        ->with('total_products_bought', $total_products_bought)
        ->with('amount_spent', $amount_spent)
        ->with('invoices_count', $invoices_count)
        ->with('users',User::all())
        ->with('invoices',Invoice::take(10)->get())
        // ->with('invoices',Invoice::take(10)->orderBy('id', 'desc')->get())

        ;
    }
}
