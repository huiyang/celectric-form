
@extends('layouts.default')

@section('title', 'Customer Management')

@section('content')

<link rel="stylesheet" href="{{asset('assets/css/form.css')}}"/>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


        <br>
        <div class="row">
             <div class="col-12">
            <button class="btn btn-primary float-right" id="addBtn">Add New Customer</button>
            </div>
        </div>


<div class="row">

                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
            
                                <div class="data-tables">
            <table id="cust_table" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="20%">Name</th>
                        <th width="20%">Term</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
               
            </table>
            </div>
        </div>  
        </div>
    </div>
</div>
       

<!--Add Modal--> 


<!-- Add Customer Modal -->
<div id="custModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="customer_form">
                <div class="modal-header"> 
                    <h4 class="modal-title">Add Customer</h4>
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                  
                </div>
                <div class="modal-body">
                    {{csrf_field()}}
                    <span id="form_output"></span>
                    <div class="form-group row">
                        <div class="col-sm-4">
                               <label for="custname"><h6>Enter Name</h6> </label>
                        </div>
                     
                        <input type="text" name="custname" id="custname" class="form-control" style="width:300px;" align="left" required="required"/>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4">
                               <label for="custname"><h6>Term</h6> </label>
                        </div>
                     
                        <input type="text" name="term" id="term" class="form-control" style="width:300px;" align="left" required="required"/>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="cust_id" id="cust_id" value=""/>
                    <input type="hidden" name="button_action" id="button_action" value="insert" />
                    <input type="submit" name="submit" id="action" value="Add" class="btn btn-info" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- End here -->
<script>
$(document).ready(function(){
    // auto reload datatables every 10secs
        // setInterval(function(){
        //     $('#cust_table').DataTable().ajax.reload();
        // },1000);

    //

    $('#cust_table').DataTable({
//         "dom":"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
// "<'row'<'col-sm-12'tr>>" +
// "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

        "processing" : true,
        "serverSide" : true,
        "ajax"       :"{{route('customer.getData')}}",
        "columns":[
            {"data":"name"},
            {"data":"term"},
            {"data":"action",orderable:false,searchable:false}
        ]
    });

    //add button script

    $('#addBtn').on('click',function(){
        $('#custModal').modal('show');
        $('.modal-title').val("Add Customer");
        $('#customer_form')[0].reset();
        $('#action').val('Add');
    });

    $('#customer_form').on('submit',function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url:'{{route("customer.postdata")}}',
            method:"POST",
            data:form_data,
            dataType:"json",
            success:function(data){
                if(data.error.length > 0){
                    var error_html ='';
                    for(var count=0;count<data.error.length;count++){
                        error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                    }
                    $('#form_output').html(error_html);

               
                }else{
                    
                    // $('#form_output').html(data.success);
                    $('.msg').html('<div class="alert alert-success">'+data.success+'</div>');
                    
                    $('#customer_form')[0].reset();
                    $('#action').val('Add');
                    $('.modal-title').text('Add Data');
                    $('#button_action').val('insert');
                    $('#cust_table').DataTable().ajax.reload();
                    $('#custModal').modal('hide');
                  
                   
                }
            }
        });
    });

    //edit function
    $(document).on('click','.edit',function(){
            var id=$(this).attr('id');
            $('#form_output').html('');

            $.ajax({
                url:"{{route('customer.fetchdata')}}",
                method:'get',
                data:{id:id},
                dataType:'json',
                success:function(data){
                    $('#custname').val(data.custname);
                    $('#cust_id').val(id);
                   $('#custModal').modal('show');
                   
                    $(".modal-title").text("Edit Data");
                    $('#button_action').val('update');
                    $('#action').val('Update');
                }
            })
    });

    $(document).on('click','.delete',function(){
        var id = $(this).attr('id');
        if(confirm("Are you sure want to delete this customer ?")){
            $.ajax({
                url:"{{route('customer.removedata')}}",
                method:"get",
                data:{id,id},
                success:function(data){
                    //alert(data);
                    $('.msg').html('<div class="alert alert-success">'+data+'</div>');
                    setTimeout($('.msg').hide("fade"),5000);
                    $('#cust_table').DataTable().ajax.reload();
                }
            })
        }else{
            return false;
        }
    })

  

});

</script>
@endsection
    