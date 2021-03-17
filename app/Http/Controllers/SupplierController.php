<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Models\Supplier;
use DataTables;

class SupplierController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('supplier');
    }

    public function getData(Request $request){
        $supplier = Supplier::get();
        return DataTables::of($supplier)
        ->addColumn('action',function($suppliers){
            return '
            <a href="#" class="btn btn-xs btn-primary edit" id="'.$suppliers->id.'">
               <i class ="fa fa-edit fa-fw"></i> Edit
            </a> &nbsp;
            <a href="#" class="btn btn-xs btn-danger delete" id="'.$suppliers->id.'">
               <i class ="fa fa-remove fa-fw"></i> Delete
            </a>';
        })->make(true);
    }

    public function postData(Request $request){
        $validation = Validator::make($request->all(),[
            'supplier'=>'required',
            'term'=>'required'
        ]);

        $error_array = array();
        $success_output = '';

        if($validation->fails()){
            foreach($validation->messages()->getMessages() as $field_name => $messages){
                $error_array[] = $messages;
            }
        }else{
            if($request->get('button_action')=='insert'){
                
                $supplier = new Supplier([
                    'supplier' =>$request->get('supplier'),
                    'term' =>$request->get('term')
                ]);


                 $supplier->save();
                $success_output='<div class="alert alert-success">New supplier Added</div>';
            }
            if($request->get('button_action') == 'update')
            {
                
                $supplier = Supplier::find($request->get('supplier_id'));
               
                $supplier->supplier = $request->get('supplier');
                $supplier->term = $request->get('term');
                $supplier->save();
                $success_output = '<div class="alert alert-success">Supplier information updated</div>';
            }            

        }
        $output = array(
            'error'     =>$error_array,
            'success'   =>$success_output,
            
        );
        echo json_encode($output);
    }

    public function fetchdata(Request $request){
        $id = $request->id;
        $supplier = Supplier::find($id);
        $output = array(
            'supplier'=>$supplier->supplier,
            'term'=>$supplier->term,
        );
        echo json_encode($output);
    }
    public function removedata(Request $request){
        $supplier = Supplier::find($request->id);
        if($supplier->delete()){
            return 'Supplier deleted';
        }
    }
}
