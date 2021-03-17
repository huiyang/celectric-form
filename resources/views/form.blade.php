@extends('layouts.default')

@section('title', 'New Purchase Request')

@section('content')

  {{-- <link rel="stylesheet" href="assets/css/form.css"/> --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
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

<div class="row">

                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
 
        <form action="form/orders" method="POST" id="prform">
        {{ csrf_field() }}
            <section>
                <div>

                <div class="row">
                <div class="col-lg-6 col-12">

                <div class="form-group row">
                <label for="sales_person" class="col-sm-4 col-form-label">Requestor</label>
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
                <label for="custname" class="col-sm-4 col-form-label">Customer Name</label>
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
                        <!-- <input type="text" class="form-control" id="term" name="term" placeholder="" required="required"> -->

                        <select name="term" id="term" class="form-control">
                            <option value="With Term">With Term</option>
                            <option value="Without Term">Without Term</option>
                        </select>
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
                    <div class="col-sm-2">
                            <!-- <input type="number" class="form-control" id="week" name="week" min="1" value="1"/> -->
                            <select name="week" id="week" class="form-control" required="required">
                                <option value=""></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            &nbsp;&nbsp;<label for="week">Week(s)</label>
                    </div>
                    <div class="col-sm-5">
                        <input type="date" class="form-control datepick" id="delivery_date" name="delivery_date" placeholder="Expected Delivery Date" required="required" readonly>
                        <!-- <button class="btn btn-info">Submit</button> -->
                     </div>

                
                          
            </div>
            </div>
            </div>
            <!-- end of orders table -->
            <hr class="hrbar">
            <br>
             <div class="row">
                <div class="col-3">
                    <h6>Choose currency for : </h6>
                </div>

                <div class="col">
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="currency_option" id="currency_option" value="1">All Items
                        </label>
                    </div>

                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="currency_option" id="currency_option" value="2" >Each Item
                        </label>
                     </div>

                </div>

             </div>
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
                                <th width="25%">Item Details</th>
                                <!-- <th>Model</th> -->
                                <th>PO Quantity</th>
                                <th>Order Quantity</th>
                                <th width="15%">Selling Price 
                                  <div id="selling_price_header"></div>
                                </th> 
                                <th width="15%">Cost
                                <div id="cost_header"></div>
                                <!-- <select name="" id="currency" class="form-control" id="cost_header">
                <option value="SINGAPORE">SG</option>
                <option value="USA">US</option>
            </select> -->
                                </th>
                             
                                <th width="15%">Supplier</th>
                                <th width="15%">Term</th>
                                <th>Lead Time(Week)</th>
                                <th><a href="#" class="addRow"><i class="fa fa-plus" onclick="return false;"></i></a></th>
                            </tr>
                        </thead>
                        <tbody>
          <!--  <tr>
            
            <td><input type="text" name="item_des[]" id="item_des" class="form-control" required="required" placeholder="Item Description">
            <br>
            <input type="text" name="model[]" id="model" class="form-control" required="required" placeholder="Part Number">
            </td>

            

            <td><input type="text" name="po_qty[]" id="po_qty" class="form-control" required="required"  onkeypress="return onlyNumberKey(event)"></td>

            <td><input type="text" name="order_qty[]" id="order_qty" class="form-control" required="required"  onkeypress="return onlyNumberKey(event)"></td>

            <td>
                <div id="selling_price_row">

                </div>
            
                <input type="text" name="sell_price[]" id="sell_price" class="form-control decimal" required="required" >
            <br>
           
            <span id="thisprice"></span>
            </td>

            <td>
                <div id="cost_row">

                </div>
            <input type="text" name="cost[]" id="cost" class="form-control decimal" required="required" >
            <br>
            <span id="thiscost"></span>

            </td>

            <td class="collapse"><input type="text" name="total_price[]" id="total_price" class="form-control">
            
            </td>

            <td class="collapse"><input type="text" name="total_cost[]" id="total_cost" class="form-control"></td>
            
         
            <td>
                <select name="supplier[]" id="supplier" class="form-control" required="required">
                    <option value=""></option>
                    @foreach($supplier as $s)
                        <option value="{{$s['supplier']}}" clas="form-control">{{$s['supplier']}}</option>
                    @endforeach
                </select>
            </td>

            <td class="">
            
            <select name="term_2[]" id="term_2" class="form-control">
                <option value="With Term">With Term</option>
                <option value="Without Term">Without Term</option>
            </select>
            </td>

            <td><input type="text" name="leadtime[]" id="leadtime" class="form-control" required="required" ></td>

            <td class="collapse"><input type="hidden" name="margin[]" id="margin"></td>

            <td class="collapse"><input type="hidden" name="margin_percent[]" id="margin_percent"></td>

            <td><a href="" onclick="return false;" class="deleteRow btn btn-danger" ><i class="fa fa-remove"></i></a></td>

            </tr>
                            </tr>-->
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td><h6>Total</h6></td>
                                <td><input type="text" class="totalp form-control" name="grand_total_price" readOnly></b></td>
                                <td><input type="text" class="totalc form-control" name="grand_total_cost" readOnly></b></td>
                                <!-- <td><input type="submit" name="" value="Submit" class="btn btn-success"></td> -->
                            </tr>
                        </tfoot>
                    </table>
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="submit" name="" id="submitbtn" value="Submit" class="float-right btn btn-primary">
                            
                            <!-- <button class="btn btn-primary float-right" id="prsubmit">Submit</button> -->
                        </div>
                    </div>
                </div>
                </div>
                </div>
            </section>
        </form>
     </div>
</div>
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
    $('.datepick').attr('min', maxDate);
    $('#pr_date').val(today);

  // set deliverydate
   var prdate = new Date($('#pr_date').val());
   prdate.setDate(prdate.getDate()+7);
   var deliveryday = prdate.getDate();
   var deliverydate = dtToday.getFullYear()+"-"+(month)+"-"+(deliveryday) ;
   $('#delivery_date').val(deliverydate);
  
   
    
   
});

//auto add 7days after picked 

    $(document).on('change','#pr_date',function(){
        var prdate = $('#pr_date').val();
        var date = new Date(prdate)
        var week = $('#week').val();
        var weekToDay = week*7;
        date.setDate(date.getDate() + weekToDay);
    
        var month = date.getMonth()+1;
        var day = date.getDate();
        var year = date.getFullYear();

        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();

        var deliveryDate =(year)+"-"+(month)+"-"+(day) ;
        $('#delivery_date').val(deliveryDate);
        
    });



//auto update delivery upon selected weeks
$(document).ready(function(){
    $(document).on('change','#week',function(){
        var week = $('#week').val();
        var days = week * 7;
        //alert(days)

        //update delivery date
        var prdate = $('#pr_date').val();
        var date = new Date(prdate);
        date.setDate(date.getDate() + days);
    
        var month = date.getMonth()+1;
        var day = date.getDate();
        var year = date.getFullYear();

        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();

        var deliveryDate =(year)+"-"+(month)+"-"+(day) ;
        $('#delivery_date').val(deliveryDate);


    })
})
    
//

//
   

    // if user didnt select currecy , cannot fill in the cost and price

   
   $('tbody').delegate('#currency_price,#currency_cost','change',function(){
       var tr = $(this).parent().parent();
        var currency_price_value = tr.find('#currency_price').val();
        var currency_cost_value = tr.find('#currency_cost').val();
        tr.find('.currency_price').html(currency_price_value+" ");
        tr.find('.currency_cost').html(currency_cost_value+" ");
   })

  

    //calculate total for each row
    $('tbody').delegate('#po_qty,#order_qty,#sell_price,#cost','keyup',function(){
        
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

      
        
        

     //  tr.find('#thiscost').html('x '+ordqty+"<br> = " +currency_cost+" "+totalcost);
      // tr.find('#thisprice').html('x '+poqty+"<br> = " +currency_price+" "+totalprc);

      tr.find('#qty1').html('x '+poqty+"<br> =");
      tr.find('#thisprice').html(totalprc);

      tr.find('#qty2').html('x '+ordqty+"<br> =");
      tr.find('#thiscost').html(totalcost);


    
//set value
        tr.find('#total_cost').val(totalcost);
        //tr.find('#total_cost').html(totalcost);
        tr.find('#total_price').val(totalprc);
        tr.find('#margin').val(margin);
        tr.find('#margin_percent').val(marginPercent);

      
        total();
       
       
     
    });

    function total(){
        var row = $('tbody tr').length;
        var totalCost = 0;
        var totalPrice = 0;
        for(var i = 0;i<row;i++){

            var price = $('input#total_price').eq(i).val();
            var cost = $('input#total_cost').eq(i).val();
            totalCost+=parseFloat(cost);
            totalPrice += parseFloat(price);

        }
        $('.totalc').val(totalCost.toFixed(2));
        $('.totalp').val(totalPrice.toFixed(2));
        
       }
    //
       var option;
        var newRow ="";
    $('input[type=radio][name=currency_option]').on('change',function()
         {
            
             
           if(this.value == 1){
            var currency_cost = '<select name="currency_cost[]" id="currency_cost" class="form-control" required="required" style="height:40px;"> <option value="">Currency</option>@foreach($currency as $c )<option value="{{$c["name"]}}">{{$c["name"]}}</option> @endforeach</select>';
            var currency_price = '<select name="currency_price[]" id="currency_price" class="form-control" required="required" style="height:40px;"> <option value="">Currency</option>@foreach($currency as $c )<option value="{{$c["name"]}}">{{$c["name"]}}</option> @endforeach</select>';

            $('#selling_price_header').append(currency_price);
            $('#cost_header').append(currency_cost);

             newRow = '<tr>+ <td><input type="text" name="item_des[]" id="item_des" class="form-control" required="required" placeholder="Item Description"> <br> <input type="text" name="model[]" id="model" class="form-control" required="required" placeholder="Part Number"></td>'+

        '<td><input type="text" name="po_qty[]" id="po_qty" class="form-control" required="required"  onkeypress="return onlyNumberKey(event)"></td>'+

        '<td><input type="text" name="order_qty[]" id="order_qty" class="form-control" required="required"  onkeypress="return onlyNumberKey(event)"></td>'+

        ' <td><input type="hidden" name="currency_price[]" class="currency_price" ><input type="text" name="sell_price[]" id="sell_price" class="form-control decimal" required="required"><br><span id="thisprice"></span></td>'+

        '<td><input type="hidden" name="currency_cost[]" class="currency_cost" ><input type="text" name="cost[]" id="cost" class="form-control decimal" required="required" ><br><span id="thiscost"></span></td>'+

        '<td class="collapse"><input type="text" name="total_price[]" id="total_price" class="form-control"></td>'+

        '<td class="collapse"><input type="text" name="total_cost[]" id="total_cost" class="form-control"></td>'+

        ' <td><select name="supplier[]" id="supplier" class="form-control" required="required">                     <option value=""></option> @foreach($supplier as $s) <option value="{{$s["supplier"]}}" clas="form-control">{{$s["supplier"]}}</option>@endforeach</select></td>'+

        '<td> <select name="term_2[]" id="term_2" class="form-control"><option value="With Term">With Term</option><option value="Without Term">Without Term</option></select></td>'+

        '<td><input type="text" name="leadtime[]" id="leadtime" class="form-control" ></td>'+

        '<td class="collapse"><input type="hidden" name="margin[]" id="margin"></td>'+

        '<td class="collapse"><input type="hidden" name="margin_percent[]" id="margin_percent"></td>'+

        '<td><a href="" onclick="return false;" class="deleteRow btn btn-danger" ><i class="fa fa-remove"></i></a></td>'+
        
        '</tr>'; 
      
              option = 1;
             
           }else if(this.value ==2){
               
         newRow = '<tr>+ <td><input type="text" name="item_des[]" id="item_des" class="form-control" required="required" placeholder="Item Description"> <br> <input type="text" name="model[]" id="model" class="form-control" required="required" placeholder="Part Number"></td>'+

        '<td><input type="text" name="po_qty[]" id="po_qty" class="form-control" required="required"  onkeypress="return onlyNumberKey(event)"></td>'+

        '<td><input type="text" name="order_qty[]" id="order_qty" class="form-control" required="required"  onkeypress="return onlyNumberKey(event)"></td>'+

        ' <td><input type="text" name="sell_price[]" id="sell_price" class="form-control decimal" required="required"><br><select name="currency_price[]" id="currency_price" class="form-control" required="required" style="height:40px;"><option value="">Currency</option> @foreach($currency as $c )<option value="{{$c["name"]}}">{{$c["name"]}}</option>@endforeach</select><br><span id="qty1"></span><span class="currency_price"></span><span id="thisprice"></span></td>'+

        '<td><input type="text" name="cost[]" id="cost" class="form-control decimal" required="required" ><br><select name="currency_cost[]" id="currency_cost" class="form-control" required="required" style="height:40px;"><option value="">Currency</option>@foreach($currency as $c )<option value="{{$c["name"]}}">{{$c["name"]}}</option>@endforeach</select><br><span id="qty2"></span><span class="currency_cost"></span><span id="thiscost"></span></td>'+

        '<td class="collapse"><input type="text" name="total_price[]" id="total_price" class="form-control"></td>'+

        '<td class="collapse"><input type="text" name="total_cost[]" id="total_cost" class="form-control"></td>'+

        ' <td><select name="supplier[]" id="supplier" class="form-control" required="required">                <option value=""></option> @foreach($supplier as $s) <option value="{{$s["supplier"]}}" clas="form-control">{{$s["supplier"]}}</option>@endforeach</select></td>'+

        '<td> <select name="term_2[]" id="term_2" class="form-control"><option value="With Term">With Term</option><option value="Without Term">Without Term</option></select></td>'+

        '<td><input type="text" name="leadtime[]" id="leadtime" class="form-control" ></td>'+

        '<td class="collapse"><input type="hidden" name="margin[]" id="margin"></td>'+

        '<td class="collapse"><input type="hidden" name="margin_percent[]" id="margin_percent"></td>'+

        '<td><a href="" onclick="return false;" class="deleteRow btn btn-danger" ><i class="fa fa-remove"></i></a></td>'+
        
        '</tr>';
        $('#selling_price_header').html("");
         $('#cost_header').html('');

         option = 2;
      

    }
         
       
        $('tbody').html(newRow);

    })

        $('.addRow').on('click',function(){
       // addRow(option);
       addnewrow();
    });

    function addnewrow(){
        $('tbody').append(newRow);
    }
    
    //delete row
    $('.table tbody').on('click','.deleteRow',function(){
        var length=$('tbody tr').length;
        if(length==1){
            alert("Last row cant' be removed !");
        }else{
             $(this).closest('tr').remove();
             total();
        }
       
    });
 

    $(document).on('change','#currency_price,#currency_cost',function(){
        var thispricecurrency = $('#currency_price').val();
        var thiscostcurrency = $('#currency_cost').val()
        $('.currency_price').val(thispricecurrency);
        $('.currency_cost').val(thiscostcurrency);
    })
  
 
   
   

</script>
@endsection
