<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Models\Customer;
use DataTables;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getData(Request $request){
       
        $addby = $request->session()->get('name');
        $customer = Customer::select('id','name')->get();
        return DataTables::of($customer)
        ->addColumn('action',function($customers){
             return '
             <a href="#" class="btn btn-xs btn-primary edit" id="'.$customers->id.'"><i class ="glyphicon glyphicon-edit"></i>Edit</a>&emsp;<a href="#" class="btn btn-xs btn-danger delete" id="'.$customers->id.'"><i class ="glyphicon glyphicon-remove"></i>Delete</a>';
        //     return '
        //     <div class="btn-group dropdown">
        //     <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
        //     <ul class="dropdown-menu">
        //         <li><a href="#" class="dropdown-item edit" id="'.$customers->id.'" data-toggle="modal" data-target="#editOrder_modal">Edit</a></li>
        //          <li><a href="#" class="dropdown-item delete" id="'.$customers->id.'">Delete</a></li> 
             
        //     </ul>
        // </div>';
      
            
        })
        ->make(true);
     
    }
    public function index(){
     
        return view('customer');
    }

    public function postdata(Request $request){
      
        $validation = Validator::make($request->all(),[
            'custname'=>'required',

            // input [name] = required|unique:[tablename,column name]
        ]);
       

        $error_array = array();
        $success_output = '';

        if($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else{
            if($request->get('button_action')=='insert'){
                
                $customer = new Customer([
                    'name' =>$request->get('custname'),
                    'added_by'=>$request->session()->get('name')
                ]);


                 $customer->save();
                $success_output='<div class="alert alert-success">Customer Added</div>';
            }

            if($request->get('button_action') == 'update')
            {
                
                $customer = Customer::find($request->get('cust_id'));
               
                $customer->name = $request->get('custname');
                $customer->save();
                $success_output = '<div class="alert alert-success">Data Updated</div>';
            }
         
        }
        $output = array(
            'error'     =>$error_array,
            'success'   =>$success_output,
            
        );
        echo json_encode($output);
    }

    public function fetchdata(Request $request){
        $id = $request->input('id');
        $customer = Customer::find($id);
        $output = array(
            'custname' => $customer->name,
        );
        echo json_encode($output); 
    }

    public function removedata(Request $request){
        $customer = Customer::find($request->input('id'));
        if($customer->delete()){
            return 'Customer deleted';
        }
    }
}
