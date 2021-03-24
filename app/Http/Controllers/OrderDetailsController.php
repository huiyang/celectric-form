<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use App\Models\Orders;
use App\Models\Items;
use App\Models\Customer;
use App\Models\Supplier;




class OrderDetailsController extends Controller
{

    

 
       public function __construct()
   {
       $this->middleware('auth');
   }
    public function getOrder(Request $request){
            $user = Auth::user();
            Session::put('name', $user->name);
            $customer = Customer::select('name', 'id')->get();
            $sales_person_name =$request->session()->get('name');
            $orders = Orders::latest()
                // ->where('sales_person',$sales_person_name)
                ->orderBy('created_at','desc')->get();
            
            
            return view('order',compact('orders','customer'));
             
        
    }

    public function getItems($id){
    
            $order = Orders::find($id);
            $supplier = Supplier::get();

           $item = Items::select('item_des','supplier','supplier_po_num','expected_delivery_date')->where('order_id',$id)->get();

           $suppliers = Items::select('order_id','supplier')->where('order_id',$id)->distinct()->get();

           $s_details = Items::select('supplier_po_num','supplier','expected_delivery_date')->where('order_id',$id)->distinct()->get(); 
      
           $items = $item->collect([
              [
                  'item_des'=>'item_des',
                  'supplier'=>['supplier'],
                  'supplier_po_num'=>'supplier_po_num',
                  'expected_delivery_date'=>'expected_delivery_date'

                 
              
              ]
         ]);

         $supplier_info = $s_details->collect([
            'supplier'=>'supplier',
            'supplier_po_num'=>'supplier_po_num',
            'expected_delivery_date'=>'expected_delivery_date',
         ]);
           
      
        
            return view('itemDetails',compact('order','supplier','suppliers','items','supplier_info'));
       
            

         
        
        
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
           $items->supplier_id= $request->supplier ?: null;
           $items->supplier= null != Supplier::find($request->supplier) ? Supplier::find($request->supplier)->name : null;
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
            $order->customer_id = $request->customer;
            $order->cust_name = Customer::find($request->customer)->name;
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
    
    public function editSupplierInfo(Request $request){

            if(count($request->supplier)>0){
                  $order_id = $request->order_id;
                foreach($request->supplier as $key=>$v){
                  
                    $supplier = $request->supplier[$key];
                    $supplier_po = $request->supplier_po[$key];
                    $expectedDate = $request->expectedDate[$key];    
                    $update = Items::where('order_id',$order_id)->where('supplier',$supplier)->update(['supplier_po_num'=>$supplier_po,'expected_delivery_date'=>$expectedDate]);
                }

                if($update){
                   return back()->with('success','Update Successful');
                }
                
                
                
            }
            
           
         

        
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

    
    public function findSupplierPO(Request $request){
         $id = $request->orderid;
         $supplier = $request->supplier;

       $query = Items::select('supplier_po_num','expected_delivery_date')->where('order_id',$id)->where('supplier',$supplier)->distinct()->get();

      //$query=Items::findorFail('order_id',$id);
         $result = array(
             'po_num' => $query->supplier_po_num,
             'date'=>$query->expected_delivery_date,
         );
        
         return response()->json($result);

      
        
    }

    public function findItemByID(Request $request){
        $id = $request->input('id');
        $item = Items::find($id);
        $supplier = Supplier::whereNotIn('supplier',[$item->supplier])->get('supplier');
        $supplierArray = array($supplier);
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
            'supplier'  =>$item->supplierModel->id ?? null,
            'supplier_name'  =>$item->supplierModel->name ?? null,
            'term_2'    =>$item->term_2,
            'leadtime'  =>$item->leadtime,
            'margin'    =>$item->margin,
            'margin_percent'=>$item->margin_percent,
            'invoice_no'    =>$item->invoice_no,
            'delivery_stat'=>$item->delivery_stat,
            'remark'    =>$item->remark,
            'allSupplier'=>$supplierArray


        );
        echo json_encode($result);
    }

}
