@extends('layouts.default')

@section('title','Supplier Management')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/form.css')}}"/>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<br>
<div class="row">
    <div class="col-12">
        <button class="btn btn-primary float-right" id="addBtn">Add New Supplier</button>
    </div>
</div>

<div class="row">
    <div class="col-12 mt-5">
       <div class="card">
       <div class="msg"></div>
        <div class="card-body">
            <div class="data-tables">
                <table id="supplier_table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="20%">Supplier</th>
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
<!-- Add Modal -->
<div id="supplierModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="supplier_form">
                <div class="modal-header"> 
                    <h4 class="modal-title">Add Supplier</h4>
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                  
                </div>
                <div class="modal-body">
                    {{csrf_field()}}
                    <span id="form_output"></span>

                    <div class="form-group row">
                        <div class="col-sm-4">
                               <label for="supplier"><h6>Enter Supplier</h6> </label>
                        </div>

                        <div class="col">
                             <input type="text" name="supplier" id="supplier" class="form-control" style="width:300px;" align="left" autofocus/>
                        </div>
                     
                       
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4">
                               <label for="term"><h6>Enter Term</h6> </label>
                        </div>

                        <div class="col">
                             <input type="text" name="term" id="term" class="form-control" style="width:300px;" align="left" />
                        </div>
                     
                       
                    </div>

                    


                   
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="supplier_id" id="supplier_id" value=""/>
                    <input type="hidden" name="button_action" id="button_action" value="insert" />
                    <input type="submit" name="submit" id="action" value="Add" class="btn btn-info" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#supplier_table').DataTable({
            "processing" : true,
            "serverSide" : true,
             "ajax"       :"{{route('supplier.getData')}}",
             "columns":[
                 {"data":"supplier"},
                 {"data":"term"},
                 {"data":"action",orderable:false,searchable:false}
        ]
         })

         $('#addBtn').on('click',function(){
            $('#supplier_form')[0].reset();
            $('#form_output').html('');
            $('#supplierModal').modal('show');
            $('.modal-title').val("Add Supplier");
            $('#supplier_form')[0].reset();
            $('#action').val('Add');
        });

        //on Submit
        $('#supplier_form').on('submit',function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url:'{{route("supplier.postData")}}',
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
                    
                     $('#form_output').html(data.success);
                    $('.msg').html('<div class="alert alert-success">'+data.success+'</div>');
                    $('#supplier_form')[0].reset();
                    $('#action').val('Add');
                    $('.modal-title').text('Add Data');
                    $('#button_action').val('insert');
                    $('#supplier_table').DataTable().ajax.reload()
                    $('#supplierModal').modal('hide');
                  
                   
                }
            }
        });
        });//end submit

          //edit function
        $(document).on('click','.edit',function(){
                var id=$(this).attr('id');
                $('#form_output').html('');

                $.ajax({
                    url:"{{route('supplier.fetchdata')}}",
                    method:'get',
                    data:{id:id},
                    dataType:'json',
                    success:function(data){
                        $('#supplier').val(data.supplier);
                        $('#term').val(data.term);
                        $('#supplier_id').val(id);
                        $('#supplierModal').modal('show');
                    
                        $(".modal-title").text("Edit Data");
                        $('#button_action').val('update');
                        $('#action').val('Update');
                    }
                })
        });

        //delete
        $(document).on('click','.delete',function(){
        var id = $(this).attr('id');
            if(confirm("Are you sure want to delete this customer ?")){
                $.ajax({
                    url:"{{route('supplier.removedata')}}",
                    method:"get",
                    data:{id,id},
                    success:function(data){
                        //alert(data);
                        $('.msg').html('<div class="alert alert-success">'+data+'</div>');
                       // setTimeout($('.msg').hide("fade"),1000000);
                        $('#supplier_table').DataTable().ajax.reload();
                    }
                })
            }else{
                    return false;
                 }
        });



    //     
    });




    

  
    
</script>
@endsection