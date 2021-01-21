@extends('layouts.default')
@section('content')
<head>
    <title>Multiple data send</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"> -->

  <link rel="stylesheet" href="assets/css/form.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet"
        type="text/css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    


</script>
</head>
<body>
<div class="form-container">
    <div class="main-content-inner">
    <!-- message alert -->
    @if(Session::has('success'))
        <div class="alert alert-success">
        {{Session::get('success')}}
        </div>
    @endif

 @if(count($errors)>0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">{{$error}}</div>
    @endforeach
 @endif

 
        <form action="form/orders" method="POST" id="prform">
        {{ csrf_field() }}
            <section>
                <div class="panel panel-header">

                <div class="form-group row">
                <label for="sales_person" class="col-sm-4 col-form-label">Sales Person</label>
                <div class="col-sm-8">
               
                <select class="form-control" id="sales_person"  name="sales_person" > 
                    @if(Session::has('name'))
                    <option value="{{Session::get('name')}}">{{Session::get('name')}}</option>
                    @endif
                    @foreach($sales_person as $salesP)
                        <option value="{{$salesP['name']}}">{{$salesP['name']}}</option>
                    @endforeach
                    
                </select>
                
                    
                    <!-- <select name="sales_person" id="sales_person" class="form-control">
                        
                        <option value="Steve">Steve</option>
                    </select> -->
                </div>
            </div>


            <div class="form-group row">
                <label for="custname" class="col-sm-4 col-form-label">Name</label>
                    <div class="col-sm-8">
                       <select name="cust_name" id="cust_name" class="form-control" required="required">
                        <option > </option>
                      @foreach($name as $custName)
                      <option value="{{$custName['name']}}">{{$custName['name']}}</option>
                      @endforeach
                       </select>
                     </div>
            </div>

            <div class="form-group row">
                <label for="term" class="col-sm-4 col-form-label">Term</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="term" name="term" placeholder="" required="required">
                     </div>
                          
            </div>

            <div class="form-group row">
                <label for="ponum" class="col-sm-4 col-form-label">PO Number</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="po_number" name="po_number" placeholder="" required="required">
                     </div>
                          
            </div>

            <div class="form-group row">
                <label for="prDate" class="col-sm-4 col-form-label">Date</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control datepick" id="pr_date" name="pr_date" placeholder="">
                     </div>
                          
            </div>

            <div class="form-group row">
                <label for="qtnum" class="col-sm-4 col-form-label">Quotation Number</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="quotation_number" name="quotation_number" placeholder="" required="required">
                     </div>
                          
            </div>

            <div class="form-group row">
                <label for="deliDate" class="col-sm-4 col-form-label">Expected Delivery</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control datepick" id="deliery_date" name="delivery_date" placeholder="Expected Delivery Date" required="required">
                        <!-- <button class="btn btn-info">Submit</button> -->
                     </div>
                          
            </div>
            <!-- end of orders table -->
            <hr class="hrbar">
            <br>

                    <div class="row">
                        <!-- <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="customer_name" class="form-control" placeholder="Please enter your name">
                    </div></div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" name="customer_address" class="form-control" placeholder="Please enter your Address">
                    </div></div>

                </div></div> -->
                <div class="panel panel-footer" >
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>Item Description</th>
                                <th>Model</th>
                                <th>PO Quantity</th>
                                <th>Order Quantity</th>
                                <th>Selling Price (RM)</th>
                                <th>Cost (RM)</th>
                                <th>Total Price (RM)</th>
                                <th>Total Cost (RM)</th>
                                <th>Supplier</th>
                                <th>Term</th>
                                <th>Lead Time(Week)</th>
                                <th><a href="#" class="addRow"><i class="material-icons" onclick="return false;">add</i></a></th>
                            </tr>
                        </thead>
                        <tbody>
            <tr>
            
            <td><input type="text" name="item_des[]" id="item_des" class="form-control" required="required"></td>

            <td><input type="text" name="model[]" id="model" class="form-control" required="required"></td>

            <td><input type="text" name="po_qty[]" id="po_qty" class="form-control" required="required"  onkeypress="return onlyNumberKey(event)"></td>

            <td><input type="text" name="order_qty[]" id="order_qty" class="form-control" required="required"  onkeypress="return onlyNumberKey(event)"></td>

            <td><input type="text" name="sell_price[]" id="sell_price" class="form-control decimal" required="required"></td>

            <td><input type="text" name="cost[]" id="cost" class="form-control decimal" required="required"></td>

            <td><input type="text" name="total_price[]" id="total_price" class="form-control"></td>

            <td><input type="text" name="total_cost[]" id="total_cost" class="form-control"></td>
            
            <td><input type="text" name="supplier[]" id="supplier" class="form-control" required="required"></td>

            <td><input type="text" name="term_2[]" id="term_2" class="form-control"></td>

            <td><input type="text" name="leadtime[]" id="leadtime" class="form-control" required="required" ></td>

            <td class="collapse"><input type="hidden" name="margin[]" id="margin"></td>

            <td class="collapse"><input type="hidden" name="margin_percent[]" id="margin_percent"></td>

            <td><a href="" onclick="return false;" class="deleteRow btn btn-danger" ><i class="material-icons">delete</i></a></td>

            </tr>
                            </tr>
                        </tbody>
                        <!-- <tfoot>
                            <tr>
                                <td type="hidden" style="border: none" ></td>
                                <td style="border: none" class="collapse"></td>
                                <td>Total</td>
                                <td><b class="total"></b> </td>
                                <td><input type="submit" name="" value="Submit" class="btn btn-success"></td>
                            </tr>
                        </tfoot> -->
                    </table>
                    <div class="row">
                        <div class="col-lg-10"></div>
                        <div class="col">
                        <input type="submit" name="" id="submitbtn" value="Submit" class="btn btn-success">
                        </div>
                    </div>
                </div>
            </section>
        </form>
     </div>
</div>



<script type="text/javascript">
//only number


$(document).delegate('.decimal','keyup',function(){
    var val = $(this).val();
    if(isNaN(val)){
         val = val.replace(/[^0-9\.]/g,'');
         if(val.split('.').length>2) 
             val =val.replace(/\.+$/,"");
    }
    $(this).val(val); 
})

function onlyNumberKey(evt) { 
          
          // Only ASCII charactar in that range allowed 
          var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
          if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
              return false; 
          return true; 
      }

//date validation
$(document).ready(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var today = dtToday.getFullYear()+"-"+(month)+"-"+(day) ;
    
    var maxDate = year + '-' + month + '-' + day;
    
   // alert(maxDate);
   $('#pr_date').val(today);
   var deli = $('#delivery_date').val();
  
    $('.datepick').attr('min', maxDate);
   
});
//
    $('tbody').delegate('.quantity,.budget','keyup',function(){
        var tr=$(this).parent().parent();
        var quantity=tr.find('.quantity').val();
        var budget=tr.find('.budget').val();
        var amount=(quantity*budget);
        tr.find('.amount').val(amount);
        total();
    });
    function total(){
        var total=0;
        $('.amount').each(function(i,e){
            var amount=$(this).val()-0;
        total +=amount;
    });
    $('.total').html(total+".00 tk");   
    }
    $('.addRow').on('click',function(){
        addRow();
    });
    function addRow()
    {
    
        var newRow = '<tr>+ <td><input type="text" name="item_des[]" id="item_des" class="form-control" required="required"></td>'+

'<td><input type="text" name="model[]" id="model" class="form-control" required="required"></td>'+

'<td><input type="text" name="po_qty[]" id="po_qty" class="form-control" required="required"  onkeypress="return onlyNumberKey(event)"></td>'+

'<td><input type="text" name="order_qty[]" id="order_qty" class="form-control" required="required"  onkeypress="return onlyNumberKey(event)"></td>'+

'<td><input type="text" name="sell_price[]" id="sell_price" class="form-control decimal" ></td>'+

'<td><input type="text" name="cost[]" id="cost" class="form-control decimal"></td>'+

'<td><input type="text" name="total_price[]" id="total_price" class="form-control"></td>'+

'<td><input type="text" name="total_cost[]" id="total_cost" class="form-control"></td>'+

'<td><input type="text" name="supplier[]" id="supplier" class="form-control"></td>'+

'<td><input type="text" name="term_2[]" id="term_2" class="form-control"></td>'+

'<td><input type="text" name="leadtime[]" id="leadtime" class="form-control" ></td>'+

'<td class="collapse"><input type="hidden" name="margin[]" id="margin"></td>'+

'<td class="collapse"><input type="hidden" name="margin_percent[]" id="margin_percent"></td>'+

'<td><a href="" onclick="return false;" class="deleteRow btn btn-danger" ><i class="material-icons">delete</i></a></td>'+
        
        '</tr>';
        $('tbody').append(newRow);
    };
    //delete row
    $('.table tbody').on('click','.deleteRow',function(){
        var length=$('tbody tr').length;
        if(length==1){
            alert("Last row cant' be removed !");
        }else{
             $(this).closest('tr').remove();
        }
       
    });

    //calculate total for each row
    $('tbody').delegate('#po_qty,#sell_price,#order_qty,#cost','keyup',function(){
        var tr = $(this).parent().parent();
        var poqty = tr.find('#po_qty').val();
        var sellprc = tr.find('#sell_price').val();
        var ordqty = tr.find('#order_qty').val();
        var cost = tr.find('#cost').val();
        //calculation
        var totalcost = (ordqty*cost).toFixed(2);
        var totalprc = (poqty*sellprc).toFixed(2);
        var margin = (totalprc-totalcost);
        var marginCal = margin/totalprc;
        var marginPercent = marginCal.toFixed(2);
//set value
        tr.find('#total_cost').val(totalcost);
        tr.find('#total_price').val(totalprc);
        tr.find('#margin').val(margin);
        tr.find('#margin_percent').val(marginPercent);
        //total();
    });

    //

    //confirm before submit
  /* $(function(){
       $('#submitbtn').click(function(){
           if(!$('#cust_name').val()==""){
               if(confirm("Confirm submit form ?")){
                   
               // $('form#prform').submit();
               }
              
           }else{
               alert("Please Select a customer");
           }
       })
   })*/

    //

</script>
</body>
@endsection
