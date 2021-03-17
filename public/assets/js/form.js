
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
   
    $('.addRow').on('click',function(){
        addRow();
    });
    function addRow()
    {
    
        var newRow = '<tr>+ <td><input type="text" name="item_des[]" id="item_des" class="form-control" required="required" placeholder="Item Description"> <br> <input type="text" name="model[]" id="model" class="form-control" required="required" placeholder="Part Number"></td>'+

'<td><input type="text" name="po_qty[]" id="po_qty" class="form-control" required="required"  onkeypress="return onlyNumberKey(event)"></td>'+

'<td><input type="text" name="order_qty[]" id="order_qty" class="form-control" required="required"  onkeypress="return onlyNumberKey(event)"></td>'+

' <td><select name="currency_price[]" id="currency_price" class="form-control" required="required" style="height:40px;"><option value="">Currency</option> @foreach($currency as $c )<option value="{{$c["name"]}}">{{$c["name"]}}</option>@endforeach</select><br><input type="text" name="sell_price[]" id="sell_price" class="form-control decimal" required="required" disabled><br><span id="thisprice"></span></td>'+

'<td><select name="currency_cost[]" id="currency_cost" class="form-control" required="required" style="height:40px;"><option value="">Currency</option>@foreach($currency as $c )<option value="{{$c["name"]}}">{{$c["name"]}}</option>@endforeach</select><br><input type="text" name="cost[]" id="cost" class="form-control decimal" required="required" disabled><br><span id="thiscost"></span></td>'+

'<td class="collapse"><input type="text" name="total_price[]" id="total_price" class="form-control"></td>'+

'<td class="collapse"><input type="text" name="total_cost[]" id="total_cost" class="form-control"></td>'+

' <td><select name="supplier[]" id="supplier" class="form-control" required="required">                     <option value=""></option> @foreach($supplier as $s) <option value="{{$s["supplier"]}}" clas="form-control">{{$s["supplier"]}}</option>@endforeach</select></td>'+

'<td> <select name="term_2[]" id="term_2" class="form-control"><option value="With Term">With Term</option><option value="Without Term">Without Term</option></select></td>'+

'<td><input type="text" name="leadtime[]" id="leadtime" class="form-control" ></td>'+

'<td class="collapse"><input type="hidden" name="margin[]" id="margin"></td>'+

'<td class="collapse"><input type="hidden" name="margin_percent[]" id="margin_percent"></td>'+

'<td><a href="" onclick="return false;" class="deleteRow btn btn-danger" ><i class="fa fa-remove"></i></a></td>'+
        
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
             total();
        }
       
    });
    // if user didnt select currecy , cannot fill in the cost and price
    $(document).ready(function(){
        $('tbody').delegate('#currency_price,#currency_cost','change',function(){
            var tr = $(this).parent().parent();
            var currency_price = tr.find('#currency_price').val();
            var currency_cost = tr.find('#currency_cost').val();

            if(currency_price != ""){
                tr.find('#sell_price').prop("disabled",false);
            }else{
                tr.find('#sell_price').prop("disabled",true);
            }

            if(currency_cost != ""){
                tr.find('#cost').prop("disabled",false);
            }else{
                tr.find('#cost').prop("disabled",true);
            }
        })
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

        var currency_price = tr.find('#currency_price').val();
        var currency_cost = tr.find('#currency_cost').val();

      
       

       tr.find('#thiscost').html('x '+ordqty+"<br> = " +currency_cost+" "+totalcost);
       tr.find('#thisprice').html('x '+poqty+"<br> = " +currency_price+" "+totalprc);

    
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

    $('input[type=radio][name=currency_option]').change(function()
        {
            if(this.value == 1){
                var currency = '<select name="currency_cost[]" id="currency_cost" class="form-control" required="required" style="height:40px;"> <option value="">Currency</option>@foreach($currency as $c )<option value="{{$c["name"]}}">{{$c["name"]}}</option> @endforeach</select>';

                $('#selling_price_header').append(currency);
                $('#cost_header').append(currency);



            }else{
                $('#selling_price_header').html("");
                $('#cost_header').html('');
            }

        }
    )


  
  
 
   
   

