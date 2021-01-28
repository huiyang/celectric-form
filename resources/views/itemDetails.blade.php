@extends('layouts.default')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
 <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script> 

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="{{asset('assets/css/form.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/css/default-css.css')}}">

 <!-- Start datatable js -->
 <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

      <!-- Start datatable css -->
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css"> 
    <style>
        table{
            white-space:nowrap;
            
        }
    </style>


<div class="container-fluid">
    <div class="main-content-inner"> 
        <h4 style="font-weight: bold">Reference</h4>
        <div class="row">
       
                    <br>
                    <table class="ordertable table table-bordered table-hovered">
                    @foreach($order as $key=>$orders)
                        <tr>
                        <th >Customer </th>
                        <td >{{$orders->cust_name}}</td>
                        </tr>

                        <tr>
                        <th width="40%">Term</th>
                        <td width="60%">{{$orders->term}}</td>
                        </tr>

                        <tr>
                        <th width="40%">PO Number</th>
                        <td width="60%">{{$orders->po_number}}</td>
                        </tr>

                        <tr>
                        <th width="40%">Quotation Number</th>
                        <td>{{$orders->quotation_number}}</td>
                        </tr>

                        <tr>
                        <th>PR Date</th>
                        <td>{{$orders->pr_date}}</td>
                        </tr>

                        <tr>
                        <th>Delivery Date</th>
                        <td>{{$orders->delivery_date}}</td>
                        </tr>
                    @endforeach
                    </table>
        </div>
        <br>
        <div class="row">
             <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
         
                 <div  id="msg"></div>
           
                <div class="card">
                            <div class="card-header">
                           <h4 align="center">Item</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="item_table" class="table table-striped table-bordered second" style="width:100%">
                                    <thead class="thead-dark">
                                <tr>
                                    <th>No.</th>
                                    <th >Item Description</th>
                                    <th>Model</th>
                                    <th>PO Quantity</th>
                                    <th>Order Quantity</th>
                                    <th>Sell Price (RM)</th>
                                    <th>Cost (RM)</th>
                                    <th>Total Price (RM)</th>
                                    <th>Total Cost (RM)</th>
                                    <th>Supplier</th>
                                    <th>Term 2</th>
                                    <th>Lead Time (Week)</th>
                                    <th>Total Margin</th>
                                    <th>%</th>
                                    <th>Invoice No.</th>
                                    <th>Delivery Status</th>
                                    <th>Remark</th>
                                    <th width="20%">Action</th>

                                </tr>
                        </thead>
                        <tbody>
                        @if(count($items)>0)
                        @foreach($items as $key=>$data)
                            
                            <tr>
                             
                                <td>{{++$key}} </td>
                                <td name="Itemdes" id="itemdes" class="item_des dt-nowrap" >{{$data->item_des}} </td>
                                <td id="model">{{$data->model}}</td>
                                <td>{{$data->po_qty}}</td>
                                <td>{{$data->order_qty}}</td>
                                <td>{{$data->sell_price}}</td>
                                <td>{{$data->cost}}</td>
                                <td>{{$data->total_price}}</td>
                                <td>{{$data->total_cost}}</td>
                                <td>{{$data->supplier}}</td>
                                <td>{{$data->term_2}}</td>
                                <td>{{$data->leadtime}}</td>
                                <td>{{$data->margin}}</td>
                                <td>{{$data->margin_percent * 100}}%</td>
                                <td id = "invoice">{{$data->invoice_no}}</td>

                                @if($data->delivery_stat == "Delivered")
                                <td id="status"><button class="badge-md badge-pill badge-success">{{$data->delivery_stat}}</button></td>
                                @else
                                <td id="status"><button class="badge-md badge-pill badge-warning">{{$data->delivery_stat}}</button></td>
                                @endif


                                <!-- <td id="status">{{$data->delivery_stat}}</td> -->

                                <td  id="remarks">{{$data->remark}}</td>
                              
                            <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" class="dropdown-item editbtn" id="{{$data->id}}" data-toggle="modal" data-target="#item_Modal">Edit</a></li>
                                     <li><a href="#" class="dropdown-item deletebtn" id="{{$data->id}}">Delete</a></li> 
                                 
                                
                                </ul>
                            </div>
                          
                            
                        
                            </td>
                            </tr>

                            @endforeach
                            @else
                            <tr >
                            <td colspan="18"><p align ="center"> No item details showable</p></td>
                         
                            </tr>
                            @endif
                        </tbody>
                    </table>



                                        
                </div>
            </div>

                <div id="item_Modal" class="modal fade" role="dialog">
            <div class="modal-dialog" id="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="itemEdit_form" class="itemEdit_form" action="{{url('items/edit')}}">
                        <div class="modal-header" id="modal-header"> 
                            <h4 class="modal-title">Edit Item</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        
                        </div>
                        <div class="modal-body">
                            {{csrf_field()}}
                            <span id="form_output"></span>

                            <div class="form-group row">
                                <div class="col-4">                        <label for="item_des">Item Description</label>
                            </div>
                                <input type="text" name="item_des" id= "item_des" class="form-control" style="width:300px;" align="left" required="required"/>
                            </div>

                            <div class="form-group row">
                                <div class="col-4">  <label for="model">Model</label></div>
                            
                                <input type="text" name="model" id="model_" class="form-control" style="width:300px;" align="left" required="required"/>
                            </div>

                            <div class="form-group row">
                                <div class="col-4"> <label for="po_qty">PO Quantity</label></div>
                            
                                <input type="text" name="po_qty" id= "po_qty"class="form-control" style="width:300px;" align="left" onkeypress="return onlyNumberKey(event)" required="required"/>
                            </div>

                            <div class="form-group row">
                                <div class="col-4">  <label for="order_qty">Order Quantity</label></div>
                            
                                <input type="text" name="order_qty" id= "order_qty" class="form-control" style="width:300px;" align="left" onkeypress="return onlyNumberKey(event)" required="required"/>
                            </div>

                            <div class="form-group row">
                                <div class="col-4">  <label for="sell_price">Sell Price (RM)</label></div>
                            
                                <input type="text" name="sell_price" id="sell_price" class="form-control decimal" style="width:300px;" align="left" required="required" />
                            
                            </div>

                            <div class="form-group row">
                                <div class="col-4">                        <label for="cost">Cost (RM)</label>
                                </div>
                                <input type="text" name="cost" id= "cost" class="form-control decimal" style="width:300px;" align="left" required="required"/>
                            </div>

                            <div class="form-group  row">
                                <div class="col-4">
                                    <label for="total_price">Total Price (RM)</label>
                                </div>
                            
                                <input type="text" name="total_price" id= "total_price" class="form-control" style="width:300px;" align="left" readonly />
                            </div>

                            <div class="form-group row">
                                <div class="col-4">  <label for="total_cost">Total Cost (RM)</label></div>
                            
                                <input type="text" name="total_cost" id="total_cost" class="form-control" style="width:300px;" align="left" readonly/>
                            </div>

                            <div class="form-group row">
                                <div class="col-4">

                                <label for="supplier">Supplier</label>
                                </div>
                            
                                <input type="text" name="supplier" id= "supplier"class="form-control" style="width:300px;" align="left" required="required"/>
                            </div>

                            <div class="form-group row">
                                <div class="col-4"><label for="term_2">Term 2</label></div>
                                
                                <input type="text" name="term_2" id= "term_2"class="form-control" style="width:300px;" align="left" required="required"/>
                            </div>



                            <div class="form-group row">
                                <div class="col-4">                        <label for="leadtime">Lead Time (Week)</label>
                            </div>
                                <input type="text" name="leadtime" id= "leadtime"class="form-control" style="width:300px;" align="left" required="required"/>
                            </div>

                            
                            
                                <input type="hidden" name="margin" id= "margin" class="form-control" style="width:300px;" align="left"/>
                        

                        
                                <input type="hidden" name="margin_percent" id= "margin_percent" class="form-control" style="width:300px;" align="left"/>
                            




                            <div class="form-group row">
                                <div class="col-4">                        <label for="invoice_no">Invoice No.</label>
                            </div>
                                <input type="text" name="invoice_no" id="invoice_no" class="form-control" style="width:300px;" align="left"/>
                            </div>

                            <div class="form-group row">
                                <div class="col-4">
                            <label for="delivery_stat">Delivery Status</label>
                                </div>
                                
                                    <select name="delivery_stat" id="delivery_stat" class="form-control" style="width:300px;" align="left">
                                    <option value="Processing">Processing</option>
                                    <option value="Delivered">Delivered</option>
                                </select>
                            
                            
                            
                                <!-- <input type="text" name="delivery_stat" id="delivery_stat" class="form-control" style="width:300px;" align="left"/> -->
                            </div>

                            <div class="form-group row">
                                <div class="col-4">
                                                            <label for="remark">Remark</label>

                                </div>
                                <input type="text" name="remark" id="remark" class="form-control" style="width:300px;" align="center"/>
                            </div>
                        
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="item_id" id="item_id" value=""/>
                            <input type="hidden" name="button_action" id="button_action" value="update" />
                           
                        <input type="submit" name="submit" id="updatebtn" value="Update" class="btn btn-info" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>


    </div>
</div>
<script>
    $(document).ready(function(){
        $('#item_table').DataTable({
            
        "scrollX":true,
        });

        //end datatable
        $(document).on('click','.editbtn',function(){
           
           var id = $(this).attr('id');
           $('.form_output').html('');

          
           $.ajax({
               url:"{{route('item.findItem')}}",
               method:'get',
               data:{id,id},
               dataType:'json',
               success:function(data){
                   $('#item_id').val(data.id);
                   $('#item_des').val(data.item_des);
                   $('#model_').val(data.model);
                   $('#po_qty').val(data.po_qty);
                   $('#order_qty').val(data.order_qty);
                   $('#sell_price').val(data.sell_price);
                   $('#cost').val(data.cost);
                   $('#total_price').val(data.total_price);
                   $('#total_cost').val(data.total_cost);
                   $('#supplier').val(data.supplier);
                   $('#term_2').val(data.term_2);
                   $('#leadtime').val(data.leadtime);
                   $('#margin').val(data.margin);
                   $('#margin_percent').val(data.margin_percent);
                   $('#invoice_no').val(data.invoice_no);
                   $('#delivery_stat').val(data.delivery_stat);
                   $('#remark').val(data.remark);

                   //$('#item_Modal').modal('show');
                   $('#item_Modal.modal').modal('show');
               }
           })
            
            
        });

        

        

        $('form').delegate('#po_qty,#sell_price,#order_qty,#cost','keyup',function(){
   var tr = $(this).parent().parent();
   var poqty = tr.find('#po_qty').val();
   var sellprc = tr.find('#sell_price').val();
   var ordqty = tr.find('#order_qty').val();
   var cost = tr.find('#cost').val();
   //calculation
   var totalcost = (ordqty*cost);
   var totalprc = (poqty*sellprc).toFixed(2);
   var margin = (totalprc-totalcost);
   var marginCal = margin/totalprc;
   var marginPercent = marginCal.toFixed(2);
//set value
    tr.find('#total_cost').val(totalcost);
    tr.find('#total_price').val(totalprc);
    tr.find('#margin').val(margin);
    tr.find('#margin_percent').val(marginPercent);
    
   $('#totalprc').html(totalprc);
   //total();
});

$(document).delegate('.decimal','keyup',function(){
   var val = $(this).val();
   if(isNaN(val)){
       val = val.replace(/[^0-9\.]/g,'');
       if(val.split('.').length>2) 
           val =val.replace(/\.+$/,"");
   }
   $(this).val(val); 
})

$('.itemEdit_form').on('submit',function(event){
   event.preventDefault();
   var form = $(this).serialize();
  
   $.ajax({
       url:'{{route("item.edit")}}',
           method:'POST',
           data:form,
           dataType:'json',
           success:function(data){
               if(data.success.length > 0){
                
                $('#form_output').html('<div class="alert alert-success">'+data.success+'</div>');
                $('#msg').html('<div class="alert alert-success">'+data.success+'</div>');
                $(".modal").animate(
                    {
                        scrollTop: $("#modal-dialog").offset().top
                    },
                    300 //speed
                    );
                 
                   setTimeout(() => {
                       window.location.reload();
                   }, 500);

               }
           }
   })
})

   $(document).on('click','.deletebtn',function(){
            var id = $(this).attr('id');
            var item = $(this).closest('tr').children('td.item_des').text();

            
            if(confirm("Confirm to delete this item [ "+item+" ] ? Item cannot be restore after delete !")){
                 $.ajax({
                   url:"{{route('item.delete')}}",
                   method:"get",
                   data:{id,id},
                   success:function(data){
                       setTimeout(() => {
                       window.location.reload();
                   }, 500);
                       $('#msg').html(data.success);
                   }

                })
            }
           
        });
        
    })

    function onlyNumberKey(evt) { 
          
          // Only ASCII charactar in that range allowed 
          var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
          if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
              return false; 
          return true; 
      }

     


</script>
@endsection