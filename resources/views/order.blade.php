@extends('layouts.default')

@section('title', 'Purchase Request History')

@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>


<link rel="stylesheet" href="{{asset('assets/css/form.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/css/default-css.css')}}">

<div class="row">

                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Data Table Default</h4>
                                <div class="data-tables">

           <table class="order_table table table-bordered">
                <thead>
                    <tr>
                             <th>No.</th>
                            <th>Customer</th>
                            <th>Term</th>
                            <th>PO Number</th>
                            <th>Date</th>
                            <th>Quotation</th> 
                            <th>Actual Delivery</th>
                            <th> Actions </th>
                    </tr>
                </thead>
                <tbody>
                     @if(count($orders)>0)
                    @foreach($orders as $key=>$data)
                    <tr>
                          <td>{{++$key}}</td>
                            <td>{{$data->cust_name}}</td>
                            <td>{{$data->term}}</td>
                            <td>{{$data->po_number}}</td> 
                            <td>{{$data->pr_date}}</td>
                            <td>{{$data->quotation_number}}</td>
                            <td>{{$data->delivery_date}}</td>
                            <td>
                               <div class="btn-group dropdown ">
                                    <!-- <a href="/order/items/{{$data->id}}" target="_blank" class="btn btn-primary">View</a> -->
                                     <a href="{{route('viewItems',$data->id)}}" target="_blank" class="btn btn-primary btn-xs ">View</a>

                                
                                    
                                
                                    <button type="button" class="btn btn-primary btn-xs  dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button> 
                                    <div class="dropdown-menu">
                                   
                                         
                                         <div class="dropdown-divider"></div> 
                                         <a class="dropdown-item editbtn" href="#" onclick="return false;" id="{{$data->id}}" data-toggle="modal" data-target="#editOrder_modal">Edit</a>
                                        
                                        <a class="dropdown-item deletebtn" href="#" id="{{$data->id}}" onclick="return false;">Delete</a> 

                                        
                                       
                                       
                                     </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
           </table>
       </div>
</div>
</div>
</div>
</div>

        
<!----Modal-----> 
 <!---Edit Modal-->
 <div id="editOrder_modal" class="modal  fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
          <h4 class="modal-title">Edit Order Details</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
         <span id="form_result"></span>
         <form method="POST" action="{{url('order/edit')}}" id="editOrder_form" class="form-horizontal" enctype="multipart/form-data">
          @csrf
          <div class="form-group row">
              <div class="col-sm-3">   
                   <label >Customer</label></div>
        
            <div class="col">

           
                  <select name="customer"  class="form-control form-control">
                <option value="" id="customer"></option>
                <option value="">---------------</option>
                @foreach($customer as $cust)
                <option value="{{$cust['name']}}">{{$cust['name']}}</option>
                @endforeach
                </select>
         
               </div>
            
           </div>

          <div class="form-group row">
              <div class="col-sm-3">            
                  <label for="term">Term</label>
            </div>
            <div class="col">
                <input type="text" name="term" id="term" class="form-control" />
            </div>
            
             
            
           </div>

           <div class="form-group row">
               <div class="col-sm-3">
                   <label>PO Number</label>
               </div>
            
            <div class="col">
                <input type="text" name="po_number" id="po_number" class="form-control" />
            </div>
             
            
           </div>
           <div class="form-group row">
               <div class="col-sm-3">
                      <label  >Date</label>
            
               </div>
               <div class="col">
                     <input type="date" name="pr_date" id="date" class="form-control" />
               </div>
         
           
        
           </div>

           <div class="form-group row">
               <div class="col-sm-3">
                    <label >Quotation</label>
               </div>
           
            <div class="col">
                   <input type="text" name="quotation_number" id="quotation_number" class="form-control" />
            </div>
          
            
           </div>

           <div class="form-group row">
               <div class="col-sm-3">
                   <label >Actual Delivery</label>
               </div>
            <div class="col">
                   <input type="date" name="delivery_date" id="delivery_date" class="form-control" />
          
            </div>
          
          
           </div>




           
           <br />
           <div class="form-group" align="center">
            <input type="hidden" name="action" id="action" />
            <input type="hidden" name="order_id" id="order_id" />
            <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Update" />
           </div>
         </form>
        </div>
     </div>
    </div>
</div>

<!---------END-------------------->



<script>
     $(window).ready(function(){
            // $('.page-container').toggleClass('sbar_collapsed');
            // $('.form-container').toggleClass('sbar_collapsed');
       
    })

    $(document).ready(function(){
        $('.order_table').DataTable({
            "bAutoWidth": false,
            "dom":'<"wrapper"flipt>',
        

        });

        //edit 
        $(document).on('click','.editbtn',function(){
           // $('#editOrder_modal').modal('show');
            var id =$(this).attr('id');
            $('form_result').html('');
            $.ajax({
                url:"{{route('order.findOrder')}}",
                method:'get',
                data:{id,id},
                dataType:'json',
                success:function(data){
                    $('#customer').val(data.customer);
                    var cust = $('#customer').val();
                    $('#customer').html(cust);
                   
                   $('#term').val(data.term);
                    $('#po_number').val(data.po_number);
                    $('#date').val(data.date);
                    $('#quotation_number').val(data.quotation_number);
                    $('#delivery_date').val(data.delivery_date);
                    $('#order_id').val(data.id);
                    $('#editOrder_modal.modal').modal('show');
                    
                    
                }
            })
        });

        $('#editOrder_form').on('submit',function(event){
            event.preventDefault();
            var form = $(this).serialize();
            $.ajax({
                url:'{{route("order.edit")}}',
                method:'POST',
                data:form,
                dataType:'json',
                success:function(data){
                    // if(data.error.length>0){
                    //     var error_html='';
                    //     for(var error=0;error<data.error.length;error++){
                    //         error_html+='<div class="alert alert-danger">'+data.error[error]+'</div>';
                    //     }
                    //     $('#form_result').html(error_html);
                    // }
                    if(data.success.length>0){
                         $('#form_result').html(data.success);
                       
                       
                        //$('#editOrder_form')[0].reset();
                         //$('#editOrder_modal.modal').modal('hide');
                        
                       setTimeout(() => {
                           window.location.reload();
                       }, 500);
                        
                        
                    }
                }
            })
        })

        $(document).on('click','.deletebtn',function(){
            var id = $(this).attr('id');
            $('#form_result').html('');
            if(confirm("Are you sure want to remove this order ?"))
            {
                $.ajax({
                    url:"{{route('order.delete')}}",
                    method:'GET',
                    data:{id,id},
                    success:function(data){
                        $('.msg').html('<div class="alert alert-success">'+data+'</div>');
                        window.location.reload();
                }

                });
            }
        })

    })

    
</script>
@endsection