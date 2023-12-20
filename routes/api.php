<?php

use App\Http\Controllers\Api\AlsoViewedController;
use App\Http\Controllers\Api\BikeController;
use App\Http\Controllers\Api\ContactFormController;
use App\Http\Controllers\Api\ConversationController;
use App\Http\Controllers\Api\FavouriteController;
use App\Http\Controllers\Api\FeaturedController;
use App\Http\Controllers\Api\ListingController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\UserListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('bikes/index', [BikeController::class, 'index'])->name('bike.index');

/* Also Viewed */
Route::get('also-viewed/{bike}', [AlsoViewedController::class, 'index'])->name('also-viewed.index');

/* Featured */
Route::get('featured/index', [FeaturedController::class, 'index'])->name('featured.index');

/* Contact Form */
Route::post('/contact', [ContactFormController::class, 'send'])->name('contact-form.send');

Route::middleware(['auth:sanctum'])->group(function () {

    /* New Bike Listing */
    Route::post('bikes/sell', [BikeController::class, 'store'])->name('bike.store');
    Route::put('bikes/{bike}', [BikeController::class, 'update'])->name('bike.update');

    /* Account */
    Route::post('account/profile', [ProfileController::class, 'update'])->name('account.profile.update');
    Route::post('account/avatar', [ProfileController::class, 'avatar'])->name('account.avatar.update');
    Route::post('account/cropped-avatar', [ProfileController::class, 'croppedAvatar'])->name('account.cropped-avatar.update');
    Route::post('account/banner', [ProfileController::class, 'banner'])->name('account.banner.update');
    Route::post('account/cropped-banner', [ProfileController::class, 'croppedBanner'])->name('account.cropped-banner.update');

    /* Listings */
    Route::get('listings/index', [ListingController::class, 'index'])->name('listings.index');

    /* Listing */
    Route::put('listings/{bike}/sold', [ListingController::class, 'sold'])->name('listing.sold');
    Route::put('listings/{bike}/publish', [ListingController::class, 'publish'])->name('listing.publish');
    Route::put('listings/{bike}/unpublish', [ListingController::class, 'unpublish'])->name('listing.unpublish');
    Route::put('listings/{bike}/pause', [ListingController::class, 'pause'])->name('listing.pause');
    Route::put('listings/{bike}/unpause', [ListingController::class, 'unpause'])->name('listing.unpause');
    Route::delete('listings/{bike}', [ListingController::class, 'delete'])->name('listing.delete');

    /* Favourites */
    Route::get('favourites/index', [FavouriteController::class, 'index'])->name('favourites.index');

    /* Favourite */
    Route::post('favourites/{bike}/favourite', [FavouriteController::class, 'favourite'])->name('favourites.favourite');
    Route::delete('favourites/{bike}', [FavouriteController::class, 'unfavourite'])->name('favourites.unfavourite');

    /* User Listings */
    Route::get('user/{user}/{slug?}/listings', [UserListingController::class, 'index'])->name('user-listings.index');

    /* User Messages */
    Route::get('unread-messages', [MessageController::class, 'unread'])->name('user.unread-message');
    Route::post('user/{user}/{slug?}/message', [MessageController::class, 'store'])->name('user.message');

    /* User Conversations */
    Route::get('/conversations/{conversation}', [ConversationController::class, 'show'])->name('conversations.show');
    Route::get('/conversations', [ConversationController::class, 'index'])->name('conversations.index');
});
