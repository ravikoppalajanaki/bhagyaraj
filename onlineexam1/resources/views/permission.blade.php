@extends('main')
@section('pagetitle')
Administartion : Panel
@endsection
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Administration
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Permissions</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">	
		@if(session()->has('success'))
          <div class="row">
		  <div class="col-md-12">
		  <div class="alert alert-success">
		  {{ session()->get('success') }}
		  </div>
		  </div>
		  </div>
		  @endif	
		@if(session()->has('errors'))
          <div class="row">
		  <div class="col-md-12">
		  <div class="alert alert-warning">
		  {{ session()->get('errors') }}
		  </div>
		  </div>
		  </div>
		  @endif
			<div class="box box-default">
				<div class="box-header with-border full">
				  <h3 class="box-title styling">Permissions</h3>
				 </div>
				 <div class="box-body">
				 
				 
				  <div class="col-md-3"></div>
				  <div class="col-md-6"><select name="SubjectID" class="form-control" id="SubjectID"><option value="">Select Role</option> <option value="Teacher">Teacher</option> </select></div>
				  
				  <table class="table table-striped table-bordered table-hover dataTable no-footer style" id="permission_table" style="display: none;">
					<thead>
						<tr>
                                        <th class="col-lg-1">#</th>
                                        <th class="col-lg-3">Module Name</th>
                                        <th class="col-lg-1">Add</th>
                                        <th class="col-lg-1">Edit</th>
                                        <th class="col-lg-1">Delete</th>
                                        <th class="col-lg-1">View</th>
                                    </tr>
					</thead>
				
				 <tbody>
					<tr>
					<td ><input type="checkbox"  name="perm_dashboard" data-value="Dashboard"></td>
					<td >Dashboard</td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
					</tr>
					<tr>
					<td ><input type="checkbox" class="permsn" name="perm_student" data-value="Student"></td>
					<td >Student</td>
					<td ><input type="checkbox" class="childpm" name="" data-value="Student_add"></td>
					<td ><input type="checkbox" class="childpm" name="" data-value="Student_edit"></td>
					<td ><input type="checkbox" class="childpm" name="" data-value="Student_delete"></td>
					<td ><input type="checkbox" class="childpm" name="" data-value="Student_view"></td>
					</tr>
					<tr>
                       <td colspan="6" rowspan="2">
                        <input class="btn btn-success" type="submit" name="" id="btnpermission" value="Save Permission">
                        </td>
                     </tr>
					</tbody>
				  </table>
				  

				 </div>
			</div>
		   
          
        </section><!-- /.content -->
@endsection
@section('rightsidebar')
  @include('includes.rightsidebar')
@endsection
@section('extra')
  <script>
  
	var listInput = [];
  $("#btnpermission").attr("disabled", "disabled");
  $(".childpm").attr("disabled", true);
  
  $('.permsn').change(function(){
  
      if($(this).prop("checked") == true){
        $(".childpm").attr("disabled", false); //enable all check box
        $(this).removeAttr("disabled");// enable current checkbox
        $('.childpm').prop('checked', true);
    }

    else //Add this part only if you have to disable all checkbox after uncheck cuurent one
    {
       $(".childpm").attr("disabled", true);
       $('.childpm').prop('checked', false);
    }
  });
  $('input[type=checkbox]').change(function() {
  listInput = [];
      $("#permission_table > tbody  tr").each(function () {      			
      		if ($('input[type=checkbox]').is(':checked')) {  
             $('#btnpermission').removeAttr('disabled');            
          }else{         
          	 $("#btnpermission").attr("disabled", "disabled");
             
          }
      });
      });

$("#SubjectID").change(function(e){
	e.preventDefault();
	var val=$(this).val();
	if(val!=''){
		$("#permission_table").show();
		


	}
	else{
		$("#permission_table").hide();
		
	}
	
});

$("#btnpermission").click(function(e){
	e.preventDefault();
	if ($('input[type=checkbox]').is(':checked')) {
     	$('input[type=checkbox]').each(function(){
      		if ($(this).is(':checked')) 
          {
            listInput.push($(this).attr('data-value'));
          }
      });
      
    }
    var data={permission:listInput}
console.log(data);
});
	


	 /*$("input[name^='perm_']").change(function() { 
	 if($(this).attr("checked"))
	  $(this).closest("tr").children().children().removeAttr("disabled");
	   else { //remove checks
	    $(this).closest("tr").children().children().removeAttr("checked");
	     //make all disabled
	      $(this).closest("tr").children().children().attr("disabled","true");
	       //but fix me 
	       $(this).removeAttr("disabled");
	        } 
	    });*/
	 
</script>
<style type="text/css">
	.style{
		margin-top: 66px;
	}
	.full{
		background-color: #23292F;
	}
	.styling{
		color: #FFFFFF;
	}
</style>
@endsection