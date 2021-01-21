<?php



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
Route::get('/login',function(){
    return view('auth.login');
});
Route::get('/',function(){
    return view('auth.login');
});

//  Route::group(['middleware'=>['preventBackHistory','auth']],function(){
// //     Route::get('/','UserController@index');
// Route::get('/',function(){
//     return view('auth.login');
// });
// });

//Route::get('/','UserController@index');
//Route::post('/checklogin','UserController@checkLogin');
//Route::get('logout','UserController@logout');

Route::get('/page', function () {
    return view('page');
});
Route::get('home',function(){
    return view('home');
});


Route::get('customer','CustomerController@index');
Route::get('customer/getData','CustomerController@getData')->name('customer.getData');
Route::post('customer/postdata','CustomerController@postdata')->name('customer.postdata');
Route::get('customer/fetchdata','CustomerController@fetchdata')->name('customer.fetchdata');
Route::get('customer/removedata', 'CustomerController@removedata')->name('customer.removedata');


Route::get('form','PurchaseRequestController@index');
Route::post('form/orders','PurchaseRequestController@addOrder');

Route::get('logout',function(){
    Auth::logout();
    session()->flush();
    return redirect('/');
});





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
//ordered_items.blade
Route::get('/order/items/{id}','OrderDetailsController@getItems');
Route::POST('items/edit','OrderDetailsController@editItems')->name('item.edit');
Route::get('item/delete','OrderDetailsController@deleteItem')->name('item.delete');
Route::get('items/getItemById','OrderDetailsController@findItemByID')->name('item.findItem');
//order.blade
Route::get('order','OrderDetailsController@getOrder');

Route::post('order/edit','OrderDetailsController@editOrder')->name('order.edit');
Route::get('order/delete','OrderDetailsController@deleteOrder')->name('order.delete');
Route::get('order/getOrderById','OrderDetailsController@findOrderByID')->name('order.findOrder');


//Route::post('customer/edit','testingController@edit');