<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessagesController;
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

Route::get('/', function () {
    return view('home');
});

Route::get('/page', function () {
    return view('page');
});
Route::get('/invoice', function () {
    return view('invoice');
});

Route::get('customer','AjaxdataController@index');
Route::get('customer/getData','AjaxdataController@getData')->name('customer.getData');
Route::post('customer/postdata','AjaxdataController@postdata')->name('customer.postdata');
Route::get('customer/fetchdata','AjaxdataController@fetchdata')->name('customer.fetchdata');
Route::get('customer/removedata', 'AjaxdataController@removedata')->name('customer.removedata');


//Route::resource('/customer','AjaxdataController');

   


Route::get('/contact',function(){
    return view('contact');
});

Route::get('/form','prController@index');


//dd('test');
//Route::post('/contact/submit',[MessagesController::class,'submit']);
Route::post('/contact/submit','MessagesController@submit');
//Route::get('customer','Customer')