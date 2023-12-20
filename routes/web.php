<?php

use App\Http\Controllers\Admin\BikeController as AdminBikeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManufacturerController;
use App\Http\Controllers\Admin\SuppliarsController;
use App\Http\Controllers\Admin\GenderController;
use App\Http\Controllers\Admin\ConditionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\WheelSizeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Website\AboutController;
use App\Http\Controllers\Website\BikeController;
use App\Http\Controllers\Website\BikeRegisterController;
use App\Http\Controllers\Website\BuyController;
use App\Http\Controllers\Website\ContactController;
use App\Http\Controllers\Website\FavouriteController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\ListingController;
use App\Http\Controllers\Website\OrderController;
use App\Http\Controllers\Website\MessageController;
use App\Http\Controllers\Website\PricingController;
use App\Http\Controllers\Website\PrivacyPolicyController;
use App\Http\Controllers\Website\ProfileController;
use App\Http\Controllers\Website\SellController;
use App\Http\Controllers\Website\TermsController;
use App\Http\Controllers\Website\TipController;
use App\Http\Controllers\Website\UserProfileController;
use App\Http\Controllers\Website\VeloeyeController;

//new//
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\account\AccountController;
use App\Http\Controllers\account\InvoicesController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\app\CategoriesController;
use App\Http\Controllers\app\AdminsController;
use App\Http\Controllers\app\VariantController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Website Routes
 */

Route::get('/', HomeController::class)->name('website.home');

///new//
Route::get('/app', [FrontEndController::class,'index'])->name('app.home');
Route::get('/blogs', [FrontEndController::class,'blogs'])->name('blogs');
Route::get('/products', [ProductsController::class,'products'])->name('front.products');
Route::get('/link', [ProductsController::class,'link'])->name('link');
Route::get('/page/{slug}', [FrontEndController::class,'single_page'])->name('single_page');
Route::get('/feed', [FrontEndController::class,'feed'])->name('feed');
 Route::get('/appcontact', [FrontEndController::class,'contact'])->name('contact');

Route::post('/contact/send', [
    'uses' => 'FrontEndController@contact_send',
    'as' => 'contact.send'
]);
Auth::routes();

Route::get('/work/login', [FrontEndController::class,'showLoginForm'])->name('work.login');
Route::post('/work/login/submit', [FrontEndController::class,'login'])->name('work.login.submit');
Route::get('/work', [FrontEndController::class,'adminindex'])->name('work.index');
Route::get('/account', [AccountController::class,'index']);
Route::get('/account/profile', [AccountController::class,'profile'])->name('account.user.profile');
Route::get('/account/invoices/', [InvoicesController::class,'index'])->name('account.invoices');
Route::get('/cart', [CartController::class,'cart'])->name('cart');
Route::get('/account/user/edit/', [AccountController::class,'edit'])->name('account.user.edit');
Route::post('/account/user/update/', [AccountController::class,'update'])->name('account.user.update');
Route::get('/account/get_invoice_data', [InvoicesController::class,'get_invoice_data'])->name('account.get_invoice_data');
Route::get('/work/profile', [AdminsController::class,'admin_profile'])->name('work.admin.profile');
Route::get('/work/product/create', [ProductsController::class,'createprod'])->name('work.product.create');
Route::get('/product/edit/{id}', [ProductsController::class,'editProd'])->name('product.edit');
Route::get('/product/delete/{id}', [ProductsController::class,'delProd'])->name('product.delete');
Route::post('/work/product/store', [ProductsController::class,'storeprod'])->name('work.product.store');
Route::post('/product/update/{id}', [ProductsController::class,'updateprod'])->name('product.update');
Route::get('/work/categories', [App\Http\Controllers\work\CategoriesController::class,'view_categories'])->name('categories');
Route::get('/work/category/create', [App\Http\Controllers\work\CategoriesController::class,'create'])->name('work.category.create');
Route::get('/work/admin/edit/{id}', [VariantController::class,'edit'])->name('work.admin.edit');
Route::get('/work/products', [
    'uses' => 'App\Http\Controllers\work\ProductsController@index',
    'as' => 'products'
]);

Route::get('/product/{id}', [
    'uses' => 'App\Http\Controllers\work\ProductsController@prodDetail',
    'as' => 'products.detail'
]);

Route::get('/work/product/delete_all', [
    'uses' => 'App\Http\Controllers\work\ProductsController@delete_all',
    'as' => 'work.product.delete_all'
]);

Route::get('/work/product/update_product/{id}', [
    'uses' => 'App\Http\Controllers\work\ProductsController@update_product',
    'as' => 'work.product.update_product'
]);

Route::get('/work/product/edit/{id}', [
    'uses' => 'App\Http\Controllers\work\ProductsController@edit',
    'as' => 'work.product.edit'
]);

Route::post('/work/product/update/{id}', [
    'uses' => 'App\Http\Controllers\work\ProductsController@update',
    'as' => 'work.product.update'
]);

Route::get('/work/product/delete/{id}', [
    'uses' => 'App\Http\Controllers\work\ProductsController@destroy',
    'as' => 'work.product.delete'
]);

Route::get('/work/product/{id}/variants/', [
    'uses' => 'App\Http\Controllers\work\ProductVariantController@variants',
    'as' => 'work.product.variants'
]);

Route::get('/work/variations', [
    'uses' => 'App\Http\Controllers\work\VariantController@index',
    'as' => 'variations'
]);

Route::get('/work/variation/create', [
    'uses' => 'App\Http\Controllers\work\VariantController@create',
    'as' => 'work.variation.create'
]);

Route::get('/work/get_variations_data', [
    'uses' => 'App\Http\Controllers\work\VariantController@get_variations_data',
    'as' => 'work.get_variations_data'
]);

Route::post('/cart/add', [
    'uses' => 'App\Http\Controllers\CartController@add_to_cart',
    'as' => 'cart.add'
]);

Route::get('/cart/empty', [
    'uses' => 'App\Http\Controllers\CartController@empty_cart',
    'as' => 'cart.empty'
]);

Route::post('/cart/update', [
    'uses' => 'App\Http\Controllers\CartController@update',
    'as' => 'cart.update'
]);

Route::get('/cart/delete/{id}', [
    'uses' => 'App\Http\Controllers\CartController@delete',
    'as' => 'cart.delete'
]);

Route::get('/cart/checkout', [
    'uses' => 'App\Http\Controllers\CartController@checkout',
    'as' => 'cart.checkout'
]);

Route::get('/work/get_categories_data', [
    'uses' => 'App\Http\Controllers\work\CategoriesController@get_categories_data',
    'as' => 'work.get_categories_data'
]);


Route::get('/{slug}-{id}', [
    'uses' => 'App\Http\Controllers\ProductsController@product_page',
    'as' => 'product_page'
]);

Route::get('/work/product/import', [
    'uses' => 'App\Http\Controllers\work\ProductsController@import',
    'as' => 'work.product.import'
]);

Route::post('/work/product/csv_upload', [
    'uses' => 'App\Http\Controllers\work\ProductsController@csv_upload',
    'as' => 'work.product.csv_upload'
]);

Route::post('/work/product/csv_import', [
    'uses' => 'App\Http\Controllers\work\ProductsController@csv_import',
    'as' => 'work.product.csv_import'
]);

Route::get('work\crawl\ebay', [
    'uses' => 'App\Http\Controllers\work\crawler\EbayController@index',
    'as' => 'work.crawl.ebay'
]);

Route::get('/work/users', [
    'uses' => 'App\Http\Controllers\work\UsersController@view_users',
    'as' => 'users'
]);

Route::get('/work/get_users_data', [
    'uses' => 'App\Http\Controllers\work\UsersController@get_users_data',
    'as' => 'work.get_users_data'
]);

Route::get('/work/admins', [
    'uses' => 'App\Http\Controllers\work\AdminsController@view_admins',
    'as' => 'admins'
]);
Route::get('/work/admin/create', [
    'uses' => 'App\Http\Controllers\work\AdminsController@create',
    'as' => 'work.admin.create'
]);
Route::post('/work/get_admins_data', [
    'uses' => 'App\Http\Controllers\work\AdminsController@get_admins_data',
    'as' => 'work.get_admins_data'
]);

Route::get('/work/admin/csv/{id}', [
    'uses' => 'App\Http\Controllers\work\AdminsController@csv',
    'as' => 'work.admin.csv'
]);

Route::get('/work/admin/delete/{id}', [
    'uses' => 'App\Http\Controllers\work\AdminsController@destroy',
    'as' => 'work.admin.delete'
]);

Route::get('/work/user/create', [
    'uses' => 'App\Http\Controllers\work\UsersController@create',
    'as' => 'work.user.create'
]);

Route::get('/work/coupons', [
    'uses' => 'App\Http\Controllers\work\CouponsController@index',
    'as' => 'work.coupons'
]);

Route::get('/work/coupon/create', [
    'uses' => 'App\Http\Controllers\work\CouponsController@create',
    'as' => 'work.coupon.create'
]);
Route::post('/work/coupon/store', [
    'uses' => 'App\Http\Controllers\work\CouponsController@store',
    'as' => 'work.coupon.store'
]);
Route::get('/work/coupons', [
    'uses' => 'App\Http\Controllers\work\CouponsController@index',
    'as' => 'work.coupons'
]);
Route::get('/work/coupon/edit/{id}', [
    'uses' => 'App\Http\Controllers\work\CouponsController@edit',
    'as' => 'work.coupon.edit'
]);
Route::get('/work/coupon/delete/{id}', [
    'uses' => 'App\Http\Controllers\work\CouponsController@destroy',
    'as' => 'work.coupon.delete'
]);
Route::post('/work/coupon/update/{id}', [
    'uses' => 'App\Http\Controllers\work\CouponsController@update',
    'as' => 'work.coupon.update'
]);

Route::get('/work/suppliers', [
    'uses' => 'App\Http\Controllers\work\SuppliersController@view_suppliers',
    'as' => 'work.suppliers'
]);

Route::get('/work/supplier/create', [
    'uses' => 'App\Http\Controllers\work\SuppliersController@create',
    'as' => 'work.supplier.create'
]);

Route::post('/work/supplier/store', [
    'uses' => 'App\Http\Controllers\work\SuppliersController@store',
    'as' => 'work.supplier.store'
]);

Route::get('/work/get_suppliers_data', [
    'uses' => 'App\Http\Controllers\work\SuppliersController@get_suppliers_data',
    'as' => 'work.get_suppliers_data'
]);

Route::get('/work/finance/invoices', [
    'uses' => 'App\Http\Controllers\work\InvoicesController@index',
    'as' => 'work.invoices'
]);

Route::get('/work/get_invoice_data', [
    'uses' => 'App\Http\Controllers\work\InvoicesController@get_invoice_data',
    'as' => 'work.get_invoice_data'
]);

Route::get('/work/finance/income', [
    'uses' => 'App\Http\Controllers\work\InvoicesController@income',
    'as' => 'work.income'
]);

Route::get('/work/posts', [
    'uses' => 'App\Http\Controllers\work\PostsController@index',
    'as' => 'work.posts'
]);

Route::get('/work/post/create', [
    'uses' => 'App\Http\Controllers\work\PostsController@create',
    'as' => 'work.post.create'
]);

Route::get('/work/get_posts_data', [
    'uses' => 'App\Http\Controllers\work\PostsController@get_posts_data',
    'as' => 'work.get_posts_data'
]);

Route::post('/work/post/store', [
    'uses' => 'App\Http\Controllers\work\PostsController@store',
    'as' => 'work.post.store'
]);

Route::get('/post/{slug}', [
    'uses' => 'App\Http\Controllers\FrontEndController@blog_page',
    'as' => 'post_page'
]);

Route::get('/work/post/edit/{id}', [
    'uses' => 'App\Http\Controllers\work\PostsController@edit',
    'as' => 'work.post.edit'
]);

Route::get('/work/post/delete/{id}', [
    'uses' => 'App\Http\Controllers\work\PostsController@destroy',
    'as' => 'work.post.delete'
]);

Route::get('/work/pages', [
    'uses' => 'App\Http\Controllers\work\PagesController@index',
    'as' => 'work.pages'
]);

Route::get('/work/page/create', [
    'uses' => 'App\Http\Controllers\work\PagesController@create',
    'as' => 'work.page.create'
]);

Route::get('all/orders', [
    'uses' => 'App\Http\Controllers\work\AdminsController@allOrders',
    'as' => 'admin.order'
]);


Route::get('/work/get_pages_data', [
    'uses' => 'App\Http\Controllers\work\PagesController@get_pages_data',
    'as' => 'work.get_pages_data'
]);

Route::get('/work/slides', [
    'uses' => 'App\Http\Controllers\work\SliderController@index',
    'as' => 'work.slides'
]);

Route::get('/work/regex', [
    'uses' => 'App\Http\Controllers\work\RegexController@index',
    'as' => 'work.regex'
]);

Route::get('/work/settings', [
    'uses' => 'App\Http\Controllers\work\SettingsController@index',
    'as' => 'work.settings'
]);

Route::get('/category/{slug}', [
    'uses' => 'App\Http\Controllers\FrontEndController@category_page',
    'as' => 'category_page'
]);

Route::post('/account/gateway/stripe', [
    'uses' => 'App\Http\Controllers\account\gateway\StripeController@payment',
    'as' => 'account.gateway.stripe'
]);

Route::post('/account/gateway/paypal', [
    'uses' => 'App\Http\Controllers\account\gateway\PayPalController@payment',
    'as' => 'account.gateway.paypal'
]);

Route::get('/account/gateway/paypal_status', [
    'uses' => 'App\Http\Controllers\account\gateway\PayPalController@paypal_status',
    'as' => 'account.gateway.paypal_status'
]);

Route::post('/account/gateway/voguepay_success', [
    'uses' => 'App\Http\Controllers\account\gateway\VoguePayController@success',
    'as' => 'account.gateway.voguepay_success'
]);

Route::post('/account/gateway/voguepay_fail', [
    'uses' => 'App\Http\Controllers\account\gateway\VoguePayController@fail',
    'as' => 'account.gateway.voguepay_fail'
]);

//////////Suppliers/////////////
Route::get('/work/get_suppliers_data', [
    'uses' => 'App\Http\Controllers\work\SuppliersController@get_suppliers_data',
    'as' => 'work.get_suppliers_data'
]);

Route::get('supplier/create', [
    'uses' => 'App\Http\Controllers\work\SuppliersController@create',
    'as' => 'work.supplier.create'
]);
Route::post('/work/supplier/store', [
    'uses' => 'App\Http\Controllers\work\SuppliersController@store',
    'as' => 'work.supplier.store'
]);
Route::get('/work/suppliers', [
    'uses' => 'App\Http\Controllers\work\SuppliersController@view_suppliers',
    'as' => 'work.suppliers'
]);
Route::get('/work/supplier/edit/{id}', [
    'uses' => 'App\Http\Controllers\work\SuppliersController@edit',
    'as' => 'work.supplier.edit'
]);
Route::get('/work/supplier/delete/{id}', [
    'uses' => 'App\Http\Controllers\work\SuppliersController@destroy',
    'as' => 'work.supplier.delete'
]);
Route::get('/work/supplier/{id}/delete_products', [
    'uses' => 'App\Http\Controllers\work\SuppliersController@supplier_products_delete',
    'as' => 'work.supplier.products_delete'
]);
Route::post('/work/supplier/update/{id}', [
    'uses' => 'App\Http\Controllers\work\SuppliersController@update',
    'as' => 'work.supplier.update'
]);
Route::get('/work/supplier/csv/{id}', [
    'uses' => 'App\Http\Controllers\work\SuppliersController@csv',
    'as' => 'work.supplier.csv'
]);
Route::get('/work/supplier/profile/{id}', [
    'uses' => 'App\Http\Controllers\work\SuppliersController@profile',
    'as' => 'work.supplier.profile'
]);
Route::get('/work/supplier/profile/update/{id}', [
    'uses' => 'App\Http\Controllers\work\SuppliersController@profile_update',
    'as' => 'work.supplier.profile_update'
]);
Route::get('/work/supplier/activate/{id}', [
    'uses' => 'App\Http\Controllers\work\SuppliersController@activate',
    'as' => 'work.supplier.activate'
]);
Route::get('/work/supplier/deactivate/{id}', [
    'uses' => 'App\Http\Controllers\work\SuppliersController@deactivate',
    'as' => 'work.supplier.deactivate'
]);
Route::get('/work/supplier/update_products/{id}', [
    'uses' => 'App\Http\Controllers\work\SuppliersController@update_products',
    'as' => 'work.supplier.update_products'
]);





Route::get('buy', BuyController::class)->name('website.buy');
Route::get('pricing', PricingController::class)->name('website.pricing');

Route::get('buying-tips', TipController::class)->name('website.buying-tips');
Route::get('bike-register', BikeRegisterController::class)->name('website.bike-register');
Route::get('veloeye', VeloeyeController::class)->name('website.veloeye');
Route::get('contact', ContactController::class)->name('website.contact');
Route::get('about', AboutController::class)->name('website.about');
Route::get('terms-and-conditions', TermsController::class)->name('website.terms-and-conditions');
Route::get('privacy-policy', PrivacyPolicyController::class)->name('website.privacy-policy');

Route::get('bike/{bike}/{slug?}', [BikeController::class, 'show'])->name('bike.show');

/**
 * Guest Only Routes
 */
Route::middleware(['guest'])->group(function () {

});

/**
 * Auth Routes
 */
Route::middleware(['auth'])->group(function () {
    Route::get('sell', SellController::class)->name('website.sell');
    Route::get('profile', ProfileController::class)->name('website.account.profile');
    Route::get('listings', ListingController::class)->name('website.account.listings');
    ///order page//
    Route::get('orders', OrderController::class,'index')->name('website.account.orders');
    ///
    Route::get('favourites', FavouriteController::class)->name('website.account.favourites');
    Route::get('messages', MessageController::class)->name('website.account.messages');

    Route::get('user/{user}/{slug?}', UserProfileController::class)->name('user.profile');

    Route::get('bike/{bike}/{slug?}/edit', [BikeController::class, 'edit'])->name('bike.edit');
});

/**
 * Admin Routes
 */
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('dashboard', DashboardController::class)->name('admin.dashboard');
///new
Route::get('/bikes/add', [App\Http\Controllers\Admin\AddBikeController::class,'add'])->name('admin.bikes.add');
Route::get('/products', [App\Http\Controllers\Admin\AddBikeController::class,'viewprod'])->name('admin.products');
Route::post('/bikes/create', [App\Http\Controllers\Admin\AddBikeController::class,'create'])->name('admin.bikes.create');
/////    
    Route::get('bikes', AdminBikeController::class)->name('admin.bikes');
    Route::get('manufacturers', ManufacturerController::class)->name('admin.manufacturers');
    Route::get('suppliars', SuppliarsController::class)->name('admin.suppliars');
    Route::get('genders', GenderController::class)->name('admin.genders');
    Route::get('conditions', ConditionController::class)->name('admin.conditions');
    Route::get('categories', CategoryController::class)->name('admin.categories');
    Route::get('types', TypeController::class)->name('admin.types');
    Route::get('sizes', SizeController::class)->name('admin.sizes');
    Route::get('wheel-sizes', WheelSizeController::class)->name('admin.wheel-sizes');
    Route::get('users', UserController::class)->name('admin.users');
});

require __DIR__.'/auth.php';
