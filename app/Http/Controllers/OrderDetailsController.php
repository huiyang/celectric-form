<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Orders;
use App\Models\Items;
use App\Models\Customer;

class OrderDetailsController extends Controller
{

    // public function __construct(){
    //     $this->middleware('auth');
    // }
//        public function __construct()
//    {
//        $this->middleware('auth');
//    }
    public function getOrder(Request $request){
           
            $customer = Customer::select('name')->get();
            $sales_person_name =$request->session()->get('name');
            $orders = Orders::where('sales_person',$sales_person_name)->orderBy('created_at','desc')->get();
            return view('order',compact('orders','customer'));
             
        
    }

    public function getItems($id){
    
            $order = Orders::find($id);
            
            return view('itemDetails',compact('order'));
       
            //return view('ordered_items',compact('items','order'));

         
        
        
    }

    public function editItems(Request $request){
       $id =$request->get('item_id');
           $items = Items::find($id);
            
           $items->item_des = $request->item_des;
           $items->model = $request->model;
           $items->po_qty = $request->po_qty;
           $items->order_qty = $request->order_qty;
           $items->sell_price = $request->sell_price;
           $items->cost = $request->cost;
           $items->total_price = $request->total_price;
           $items->total_cost= $request->total_cost;
           $items->supplier= $request->supplier;
           $items->term_2= $request->term_2;
           $items->leadtime= $request->leadtime;
           $items->margin= $request->margin;
           $items->margin_percent= $request->margin_percent;
           $items->invoice_no = $request->invoice_no;
           $items->delivery_stat = $request->delivery_stat;
           $items->remark = $request->remark;
           
            //    return redirect('itemDetails')->with('edited','Item Details Updated');
           
          $items->save();
           $msg =  '<div class="alert alert-success">Data Updated</div>';
           $result = array(
               'success' =>$msg,
           );
      
           echo json_encode($result);
       
             
          
                
            

       
    }

    public function editOrder(Request $request){
            $order = Orders::find($request->get('order_id'));
            $order->cust_name = $request->customer;
            $order->term = $request->term;
            $order->po_number=$request->po_number;
            $order->quotation_number = $request->quotation_number;
            $order->pr_date=$request->pr_date;
            $order->delivery_date = $request->delivery_date;
            $order->save();
            $msg =  '<div class="alert alert-success">Data Updated</div>';
            $result = array(
                'success' =>$msg,
            );
            echo json_encode($result);
    } 

    public function deleteItem(Request $request){
        $item = Items::find($request->id);
        $item->delete();
        $msg = 'The selected item has been removed';
        echo json_encode($msg);
    }

    public function deleteOrder(Request $request){
            $item = Items::where('order_id',$request->id);
            $order = Orders::find($request->id);
                $item->delete();
                $order->delete();
                     $msg = 'The order has been removed';
                echo json_encode($msg);
               
            
    }

    public function findOrderByID(Request $request){
        $id = $request->input('id');
        $order = Orders::find($id);
        $result = array(
            'id'    =>$order->id,
            'customer'=>$order->cust_name,
            'term'=>$order->term,
            'po_number'=>$order->po_number,
            'date'=>$order->pr_date,
            'quotation_number'=>$order->quotation_number,
            'delivery_date'=>$order->delivery_date,
        );
        echo json_encode($result);
    }

    public function findItemByID(Request $request){
        $id = $request->input('id');
        $item = Items::find($id);
        $result = array(
            'id'        =>$item->id,
            'item_des' =>$item->item_des,
            'model'     =>$item->model,
            'po_qty'    =>$item->po_qty,
            'order_qty' =>$item->order_qty,
            'sell_price'  =>$item->sell_price,
            'cost'       =>$item->cost,
            'total_price'=>$item->total_price,
            'total_cost'=>$item->total_cost,
            'supplier'  =>$item->supplier,
            'term_2'    =>$item->term_2,
            'leadtime'  =>$item->leadtime,
            'margin'    =>$item->margin,
            'margin_percent'=>$item->margin_percent,
            'invoice_no'    =>$item->invoice_no,
            'delivery_stat'=>$item->delivery_stat,
            'remark'    =>$item->remark


        );
        echo json_encode($result);
    }

}
