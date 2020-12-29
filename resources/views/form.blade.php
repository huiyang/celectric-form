

@extends('layout.head')


<link rel="stylesheet" href="assets/css/form.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet"
        type="text/css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<script>
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
   $('#prDate').val(today);
   var deli = $('#deliDate').val();
  
    $('.datepick').attr('min', maxDate);
   
   
   
    
   
    

    // $('.datepick').datepicker({
    //     minDate:0
    // })   
})
   
</script>


@section('content') 
 <div class="form-container">
<div class="main-content-inner">
    <h2 align="center">Purchase Request</h2>
    <!--form --> 
    <br>
    <div class="row">
        <div class="col-lg-8">
        <div class="row">
        <div class="col">
         <label for="salesperson" class=" label">Sales Person : </label>
        <span name="salesperson" id="salesperson" align="left" class="">&emsp;Steve</span>
        </div>
        </div>
       
         <form action="" class="customer-form">
   
            <div class="form-group row">
                <label for="custname" class="col-sm-4 col-form-label">Name</label>
                    <div class="col-sm-8">
                       <select name="custname" id="" class="form-control">
                       <option >--Select Customer-- </option>
                       @foreach($name as $custname)
     <option value="{{ $custname->name}}">{{ $custname->name }}</option>
     @endforeach
                       </select>
                     </div>
            </div>

            <div class="form-group row">
                <label for="term" class="col-sm-4 col-form-label">Term</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="term" name="term" placeholder="">
                     </div>
                          
            </div>

            <div class="form-group row">
                <label for="ponum" class="col-sm-4 col-form-label">PO Number</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="ponum" name="ponum" placeholder="">
                     </div>
                          
            </div>

            <div class="form-group row">
                <label for="prDate" class="col-sm-4 col-form-label">Date</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control datepick" id="prDate" name="prDate" placeholder="">
                     </div>
                          
            </div>

            <div class="form-group row">
                <label for="qtnum" class="col-sm-4 col-form-label">Quotation Number</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="qtnum" name="qtnum" placeholder="">
                     </div>
                          
            </div>

            <div class="form-group row">
                <label for="deliDate" class="col-sm-4 col-form-label">Expected Delivery</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control datepick" id="deliDate" name="deliDate" placeholder="Expected Delivery Date">
                        <!-- <button class="btn btn-info">Submit</button> -->
                     </div>
                          
            </div>



            </form>
        </div>
      <div class="col-lg-4">
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <button class="btn btn-info" id="submit">Submit</button>&ensp;
        <button class="btn btn-danger" id="clear">Clear</button>
      </div>

    </div>
<hr class="hrbar">
<br>
 <!--table form-->

     <form>
         <section>
             <div class="panel panel-header">

            </div>
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
                             <th><a href="" onclick="return false;" class="addRow"><i class="material-icons" id="addRow">add</i></a></th>
                         </tr>
                     </thead>
                     <tbody>
                     
         <tr>
         
         <td><input type="text" name="itemDes" id="itemDes" class="form-control"></td>

         <td><input type="text" name="model" id="model" class="form-control"></td>

         <td><input type="text" name="POqty" id="POqty" class="form-control"></td>

         <td><input type="text" name="ordqty" id="ordqty" class="form-control"></td>

         <td><input type="text" name="sellprc" id="sellprc" class="form-control"></td>

         <td><input type="text" name="cost" id="cost" class="form-control"></td>

         <td><input type="text" name="totalprc" id="totalprc" class="form-control"></td>

         <td><input type="text" name="totalcst" id="totalcst" class="form-control"></td>
         
         <td><input type="text" name="supplier" id="supplier" class="form-control"></td>

         <td><input type="text" name="termInput" id="term" class="form-control"></td>

         <td><input type="text" name="week" id="week" class="form-control" ></td>



         <td><a href="" onclick="return false;" class="deleteRow btn btn-danger" ><i class="material-icons">delete</i></a></td>
         </tr>
                        
                     </tbody>
                    <!--
                     <tfoot>
                         <tr>
                             <td style="border: none"></td>
                             <td style="border: none"></td>
                             <td style="border: none"></td>
                             <td style="border: none"></td>
                             <td style="border: none"></td>

                             <td>Total</td>
                             <td><b class="gtp"></b> </td>
                             <td style="border: none" class="gtc"></td>
                             <td><input type="submit" name="" value="Submit" class="btn btn-success"></td>
                         </tr>
                     </tfoot>-->
                 </table>
             </div>
         </section>
     </form>

    
</div>
</div>


<script>
$(document).ready(function(){
    $("#totalprc,#totalcst").attr("disabled", true);
})
    //add row function
    $('.addRow').on('click',function(){
        addRow();
    });

    function addRow(){
        var newRow ='<tr>'+
        '<td><input type="text" name="itemDes" id="itemDes" class="form-control"></td>'+
        '<td><input type="text" name="model" id="model" class="form-control"></td>'+
        '<td><input type="text" name="POqty" id="POqty" class="form-control"></td>'+
        '<td><input type="text" name="ordqty" id="ordqty" class="form-control"></td>'+
        '<td><input type="text" name="sellprc" id="sellprc" class="form-control"></td>'+
        '<td><input type="text" name="cost" id="cost" class="form-control"></td>'+
        '<td><input type="text" name="totalprc" id="totalprc" disabled="true" class="form-control"></td>'+
        '<td><input type="text" name="totalcst" id="totalcst" disabled = "true" class="form-control"></td>'+
        '<td><input type="text" name="supplier" id="supplier" class="form-control"></td>'+
        '<td><input type="text" name="term" id="term" class="form-control"></td><td><input type="text" name="week" id="week" class="form-control" required=""></td>'+
        '<td><a href="" onclick="return false;" class=" btn btn-danger deleteRow"><i class="material-icons">delete</i></a></td>'+'</tr>';

        $('tbody').append(newRow);
        //$("#totalprc,#totalcst").attr("disabled", true);

    }
    //

    // deleteRow
    $('.table tbody').on('click','.deleteRow',function(){
        var length=$('tbody tr').length;
        if(length==1){
            alert("Last row cant' be removed !");
        }else{
             $(this).closest('tr').remove();
        }
       
    });

    //calculate total for same row
    $('tbody').delegate('#POqty,#sellprc,#ordqty,#cost','keyup',function(){
        var tr = $(this).parent().parent();
        var poqty = tr.find('#POqty').val();
        var sellprc = tr.find('#sellprc').val();
        var ordqty = tr.find('#ordqty').val();
        var cost = tr.find('#cost').val();
        var totalcost = (ordqty*cost);
        var totalprc = (poqty*sellprc);
        tr.find('#totalcst').val(totalcost);
        tr.find('#totalprc').val(totalprc);
        //total();
    });
    
  
    // function total(){
    //     calTotalCost();
    //     calTotalPrice();
    // }
    // function calTotalCost(){
    //   var totalcost=0;
    //     $('#totalcst').each(function(i,e){
    //         var amountcst = $(this).val()-0;
    //         totalcost+=amountcst;

    //     });
    //     $('.gtc').html(totalcost);
    // }

    // function calTotalPrice(){
    //     var totalprice = 0;
    //     $('#totalprc').each(function(i,e){
    //         var amount = $(this).val()-0;
    //         totalprice += amount;
    //     });
    //     $('.gtp').html(totalprice);
    // }
  
</script>

@endsection