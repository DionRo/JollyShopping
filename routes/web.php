<?php

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
route::get('/admin/clothing', 'pagesController@clothingOverview');
route::get('/admin/garment/{id}', 'clothingController@adminDetail');
route::get('/admin/accessory/{id}', 'accessoriesController@adminDetail');
route::get('/admin/accessories', 'pagesController@accessoriesOverview');
route::get('/admin/jewerlies/{id}', 'jewerlyController@adminDetail');
route::get('/admin/jewerlies', 'pagesController@jewerliesOverview');
route::get('/sendNewsletter/{id}', 'newsletterController@sendNewsletter');
route::post('/sendmail', 'pagesController@sendEmail');
route::get('/unsubscribe/{email}/{id}', 'userController@unsubscribe');

route::resource('/', 'pagesController');
route::resource('/clothing', 'clothingController');
route::resource('/accessories', 'accessoriesController');
route::resource('/jewerly', 'jewerlyController');
route::resource('/admin/users', 'userController');
route::resource('/admin/categories', 'categoryController');
route::resource('/admin/newsletters', 'newsletterController');
Auth::routes();
