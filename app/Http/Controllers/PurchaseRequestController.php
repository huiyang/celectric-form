<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Orders;
use App\Models\Items;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;

class PurchaseRequestController extends Controller
{   
    
    // public function __construct(){
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
     
    public function index()
    {
       
            $user = Auth::user();
            Session::put('name', $user->name);
            $user_name = session()->get('name');
            $sales_person = User::whereNotIn('name',[$user_name])->get('name');
             $name = Customer::get('name')->toArray();
            $supplier = Supplier::select('supplier')->get();

            $currency = Currency::select('name', 'code')->get();

            $info = array(
                'name'         => $name,
                'sales_person' => $sales_person,
                'supplier'     => $supplier,
                'currency'     => $currency
            );
            //  return view('form',['name'=>$name],['sales_person'=>$sales_person],['supplier'=>$supplier]);
            return view('form',$info);
             
             
        
       
    }


    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   /* public function store(Request $request)
    {   
     //return $request->all();
        

        $this->validate($request,[
            'cust_name' =>'required',
            'term' => 'required',
        ]);
       
   
        $data = $request->all();
        $order = new Orders();
      
        $order->sales_person = $request->sales_person;
        $order->cust_name    = $request->cust_name;
        $order->term         = $request->term;
        $order->po_number    = $request->po_number;
        $order->pr_date      = $request->pr_date;
        $order->quotation_number = $request->quotation_number;
        $order->delivery_date   = $request->delivery_date;
        $order->grand_total_price = $request->grand_total_price;
        $order->grand_total_cost = $request->grand_total_cost;
        if($order->save()){
            $id = Orders::create($data)->id;
            //$order_id = $order->id;
            //  $orders = Orders::find($order_id);
            if(count($request->item_des)>0){

                foreach($request->item_des as $item=>$v){
                     $items->order_id = $id;
                        $items->item_des = $request->item_des[$item];
                        $items->model = $request->model[$item];
                        $items->po_qty = $request->po_qty[$item];
                        $items->order_qty = $request->order_qty[$item];
                        $items->sell_price = $request->sell_price[$item];
                        $items->cost = $request->cost[$item];
                        $items->currency_price = $request->currency_price[$item];
                        $items->currency_cost = $request->currency_cost[$item];
                        $items->total_price = $request->total_price[$item];
                        $items->total_cost = $request->total_cost[$item];
                        $items->supplier = $request->supplier[$item];
                        $items->term_2 = $request->term_2[$item];
                        $items->leadtime = $request->leadtime[$item];
                        $items->margin = $request->margin[$item];
                        $items->margin_percent = $request->margin_percent[$item];
                        $items->remark = '';
                        $items->invoice_no = '';
                        $items->delivery_stat = '';
                        now();
                        now();
                   $items->save();
                }
            }
        }
        Session::flash('success','You have successfully create goods receive.');
        return redirect('/form');

      
                       
           
        }*/
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addOrder(Request $request){
        $data = $request->all();
        $order = Orders::create($data);
        $id = $order->id;
        if(count($request->item_des)>0){
            foreach($request->item_des as $item=>$v){
                $items = array(
                    'order_id'  => $id,
                        'item_des' => $request->item_des[$item],
                        'model'    => $request->model[$item],
                        'po_qty'   => $request->po_qty[$item],
                        'order_qty' => $request->order_qty[$item],
                        'sell_price'     =>$request->sell_price[$item],
                        'cost'          =>$request->cost[$item],
                        'currency_price'=>$request->currency_price[$item],
                        'currency_cost'=>$request->currency_cost[$item],
                        'total_price'    =>$request->total_price[$item],
                        'total_cost'    =>$request->total_cost[$item],
                        'supplier'       =>$request->supplier[$item],
                        'term_2'         =>$request->term_2[$item],
                        'leadtime'       =>$request->leadtime[$item],
                        'margin'       =>$request->margin[$item],
                        'margin_percent'      =>$request->margin_percent[$item],
                        'invoice_no'        =>'',
                        'delivery_stat'     =>'',
                        'remark'            =>'',
                        'created_at' => now(),
                        'updated_at' => now(),
                );
                Items::insert($items);
            }
        }
        
        $order->recalculateTotal()->save();

        Session::flash('success','Order request received.');
        return redirect('/form');
    }
}
