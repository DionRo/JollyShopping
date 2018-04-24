<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Cart;
use Illuminate\Support\Facades\DB;
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

route::get('/products', 'pagesController@products');
route::get('/about', 'pagesController@about');
route::get('/contact', 'pagesController@contact');
route::get('/filter', 'pagesController@filterProducts');
route::get('/admin', 'pagesController@admin');
//route::get('/admin/clothing', 'pagesController@clothingOverview');
//route::get('/admin/garment/{id}', 'clothingController@adminDetail');
route::get('/admin/accessory/{id}', 'accessoriesController@adminDetail');
route::get('/admin/accessories', 'pagesController@accessoriesOverview');
route::get('/admin/jewerlies/{id}', 'jewerlyController@adminDetail');
route::get('/admin/jewerlies', 'pagesController@jewerliesOverview');
route::get('/sendNewsletter/{id}', 'newsletterController@sendNewsletter');
route::get('/unsubscribe/{email}/{securityToken}', 'userController@unsubscribe');
route::get('/admin/orders', 'pagesController@orderOverview');
route::get('/admin/orders/{id}', 'pagesController@adminDetail');
route::post('/subscribe', 'userController@subscribe');
route::post('/sendmail', 'pagesController@sendEmail');

// cart routes
route::get('/add-to-cart/{id}' , 'pagesController@getAddToCart');
route::get('/add-to-cart-main/{id}' , 'pagesController@getAddToCartMain');
route::get('/add-to-cart-detail/{id}' , 'pagesController@getAddToCartDetail');
route::get('/shopping-cart', 'pagesController@getCart')->name('getCart');
route::get('/shopping-cart/addUp/{id}' , 'pagesController@addUpProduct');
route::get('/shopping-cart/removeSingle/{id}' , 'pagesController@removeSingle');
route::get('/shopping-cart/removeProduct/{id}' , 'pagesController@removeProduct');
route::post('/checkout', 'pagesController@checkOut');



// wrong route
Route::get('/sales/{id}', function ($id){;
    $product = \App\Product::find($id);
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);

    $cart->add($product, $product->id);
    session()->put('cart', $cart);

});

route::resource('/', 'pagesController');
//route::resource('/clothing', 'clothingController');
route::resource('/accessories', 'accessoriesController');
route::resource('/jewerly', 'jewerlyController');
route::resource('/admin/users', 'userController');
route::resource('/admin/categories', 'categoryController');
route::resource('/admin/newsletters', 'newsletterController');
Auth::routes();
