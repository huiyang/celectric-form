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








Route::get('customer','CustomerController@index');
Route::get('customer/getData','CustomerController@getData')->name('customer.getData');
Route::post('customer/postdata','CustomerController@postdata')->name('customer.postdata');
Route::get('customer/fetchdata','CustomerController@fetchdata')->name('customer.fetchdata');
Route::get('customer/removedata', 'CustomerController@removedata')->name('customer.removedata');

//supplier
Route::get('supplier','SupplierController@index');
Route::get('supplier/getData','SupplierController@getData')->name('supplier.getData');
Route::post('supplier/postData','SupplierController@postData')->name('supplier.postData');
Route::get('supplier/fetchdata','SupplierController@fetchdata')->name('supplier.fetchdata');
Route::get('supplier/removedata','SupplierController@removedata')->name('supplier.removedata');


Route::get('/form','PurchaseRequestController@index');
Route::post('form/orders','PurchaseRequestController@addOrder');

Route::get('logout',function(){
    Auth::logout();
    session()->flush();
    return redirect('/');
});


//ordered_items.blade
Route::get('test/{id}','OrderDetailsController@index');
Route::get('/order/items/{id}','OrderDetailsController@getItems')->name('viewItems');
Route::post('items/edit','OrderDetailsController@editItems')->name('item.edit');
Route::get('item/delete','OrderDetailsController@deleteItem')->name('item.delete');
Route::get('items/getItemById','OrderDetailsController@findItemByID')->name('item.findItem');
Route::get('items/{id}','OrderDetailsController@getItems');
Route::post('items/supplier/edit','OrderDetailsController@editSupplierInfo');
Route::get('items/getSupplierPO/','OrderDetailsController@findSupplierPO')->name('item.supplier_po');


//order.blade
Route::get('order','OrderDetailsController@getOrder')->middleware('auth');

Route::post('order/edit','OrderDetailsController@editOrder')->name('order.edit');
Route::get('order/delete','OrderDetailsController@deleteOrder')->name('order.delete');
Route::get('order/getOrderById','OrderDetailsController@findOrderByID')->name('order.findOrder');



Auth::routes();
Route::get('/',function(){
    return view('auth.login');
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('currency', 'CurrencyController')->middleware('auth');