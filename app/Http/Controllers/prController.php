<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class prController extends Controller
{
    //
    function index(){
        $name = DB::table('customers')->get('name');
        return view('form')->with('name',$name);
    }
}
