@extends('layouts.front')
@section('content')
<title>Item Details</title>
<!-- Yajra table -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>       
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!--------->
<link rel="stylesheet" href="assets/css/form.css"/>
<link rel="stylesheet" href="assets/css/default-css.css">



 
<div id="preloader">
        <div class="loader"></div>
    </div>

<div class="container-fluid">
    <div class="main-content-inner">
        
            <h4 align="center"></h4>
            <br/>
            <br/>
            
             
            @if(Session::has('edited'))
                <div class="alert alert-success">
                {{Session::get('edited')}}
                </div>
            @endif
           <br>
           <div class="row">
                        <h3 style="font-weight: bold">Reference</h3>
                    
                        <table class="ordertable table-bordered table-stripped">
                        @foreach($order as $key=>$orders)
                            <tr>
                            <th>Customer </th>
                            <td>{{$orders->cust_name}}</td>
                            </tr>

                            <tr>
                            <th>Term</th>
                            <td>{{$orders->term}}</td>
                            </tr>

                            <tr>
                            <th>PO Number</th>
                            <td>{{$orders->po_number}}</td>
                            </tr>

                            <tr>
                            <th>Quotation Number</th>
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
             
          
              
           
            
           <div class="msg"></div>
            <h3 align="center">Item Details</h4>
            <br>
          
                <table class="table table-bordered " id="itemsTable" >
                <div class="msg">
                   
                </div>
                        <thead class="thead-dark">
                            <tr>
                                <th>No.</th>
                                <th>Item Description</th>
                                <th>Model</th>
                                <th>PO Quantity</th>
                                <th>Order Quantity</th>
                                <th>Sell Price (RM)</th>
                                <th>Cost (RM)</th>
                                <th>Total Price (RM)</th>
                                <th>Total Cost (RM)</th>
                                <th>Supplier</th>
                                <th>Term</th>
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
                                <td name="Itemdes" id="itemdes" class="item_des">{{$data->item_des}} </td>
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

                                <td id="status">{{$data->delivery_stat}}</td>
                                <td  id="remarks">{{$data->remark}}</td>
                              
                            <td>
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" class="editbtn" id="{{$data->id}}">Edit</a></li>
                                    <li><a href="#" class="deletebtn" id="{{$data->id}}">Delete</a></li>
                                
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

               
            
         
                
            <!---Edit Modal-->
            <div id="item_Modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="itemEdit_form" class="itemEdit_form" action="{{url('items/edit')}}">
                <div class="modal-header"> 
                    <h4 class="modal-title">Edit Details</h4>
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                  
                </div>
                <div class="modal-body">
                    {{csrf_field()}}
                    <span id="form_output"></span>

                    <div class="form-group">
                        <label for="item_des">Item Description</label>
                        <input type="text" name="item_des" id= "item_des" class="form-control" style="width:300px;" align="left"/>
                    </div>

                    <div class="form-group">
                        <label for="model">Model</label>
                        <input type="text" name="model" id="model_" class="form-control" style="width:300px;" align="left"/>
                    </div>

                    <div class="form-group">
                        <label for="po_qty">PO Quantity</label>
                        <input type="text" name="po_qty" id= "po_qty"class="form-control" style="width:300px;" align="left" onkeypress="return onlyNumberKey(event)"/>
                    </div>

                    <div class="form-group">
                        <label for="order_qty">Order Quantity</label>
                        <input type="text" name="order_qty" id= "order_qty" class="form-control" style="width:300px;" align="left" onkeypress="return onlyNumberKey(event)"/>
                    </div>

                    <div class="form-group">
                        <label for="sell_price">Sell Price (RM)</label>
                        <input type="text" name="sell_price" id="sell_price" class="form-control decimal" style="width:300px;" align="left" />
                     
                    </div>

                    <div class="form-group">
                        <label for="cost">Cost (RM)</label>
                        <input type="text" name="cost" id= "cost" class="form-control decimal" style="width:300px;" align="left"/>
                    </div>

                    <div class="form-group ">
                        <label for="total_price">Total Price (RM)</label>
                        <input type="text" name="total_price" id= "total_price" class="form-control" style="width:300px;" align="left" readonly />
                    </div>

                    <div class="form-group ">
                        <label for="total_cost">Total Cost (RM)</label>
                        <input type="text" name="total_cost" id="total_cost" class="form-control" style="width:300px;" align="left" readonly/>
                    </div>

                    <div class="form-group">
                        <label for="supplier">Supplier</label>
                        <input type="text" name="supplier" id= "supplier"class="form-control" style="width:300px;" align="left"/>
                    </div>

                    <div class="form-group">
                        <label for="term_2">Term</label>
                        <input type="text" name="term_2" id= "term_2"class="form-control" style="width:300px;" align="left"/>
                    </div>



                    <div class="form-group">
                        <label for="leadtime">Lead Time (Week)</label>
                        <input type="text" name="leadtime" id= "leadtime"class="form-control" style="width:300px;" align="left"/>
                    </div>

                    
                       
                        <input type="hidden" name="margin" id= "margin" class="form-control" style="width:300px;" align="left"/>
                  

                  
                        <input type="hidden" name="margin_percent" id= "margin_percent" class="form-control" style="width:300px;" align="left"/>
                    




                    <div class="form-group">
                        <label for="invoice_no">Invoice No.</label>
                        <input type="text" name="invoice_no" id="invoice_no" class="form-control" style="width:300px;" align="left"/>
                    </div>

                    <div class="form-group">
                        <label for="delivery_stat">Delivery Status</label>
                        <input type="text" name="delivery_stat" id="delivery_stat" class="form-control" style="width:300px;" align="left"/>
                    </div>

                    <div class="form-group">
                        <label for="remark">Remark</label>
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

            <!---End---->
           
   
    </div> 
</div>
<script>
   
    $(document).ready(function(){
         $('#itemsTable').DataTable({
            "dom": '<"top"i>rt<"bottom"flp><"clear">',
             "scrollX":true,
     });
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

                        $('#item_Modal').modal('show');
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
                        $('#form_output').html(data.success);
                        $('.itemEdit_form').modal('hide');
                         //$('.itemEdit_form')[0].reset();
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
                            $('.msg').html(data.success);
                        }

                     })
                 }
                
             });

    


          


    });
    function onlyNumberKey(evt) { 
          
          // Only ASCII charactar in that range allowed 
          var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
          if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
              return false; 
          return true; 
      }
</script>
@endsection




