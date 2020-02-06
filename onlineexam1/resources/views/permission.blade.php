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
		
          <div class="row">
		  <div class="col-md-12">
		  <div class="alert alert-success" style="display: none;" id="succ">
		     Permissions saved successfully
		  </div>
		  </div>
		  </div>
		 
		
          <div class="row">
		  <div class="col-md-12">
		  <div class="alert alert-warning" style="display: none;"id="err">
		     Permissions updated successfully
		  </div>
		  </div>
		  </div>
		  
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
					<td ><input type="checkbox" class="dashchck" name="perm_dashboard" data-value="Dashboard"></td>
					<td >Dashboard</td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
					</tr>
					<tr>
					<td ><input type="checkbox" class="permsn stdntchck" name="perm_student" data-value="Student"></td>
					<td >Student</td>
					<td ><input type="checkbox" class="childpm stdntaddchck" name="" data-value="Student_add"></td>
					<td ><input type="checkbox" class="childpm stdnteditchck" name="" data-value="Student_edit"></td>
					<td ><input type="checkbox" class="childpm stdntdeletechck" name="" data-value="Student_delete"></td>
					<td ><input type="checkbox" class="childpm stdntviewchck" name="" data-value="Student_view"></td>
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
		
		$.ajax({
		   	url:"{{url('permission/role')}}",
		   	method:"POST",
		   	data:{role:val},
		   	success:function(data){
		   		//console.log(data);
		   		r=JSON.parse(data);
		   		if (r.statuscode==200) {
		   			//console.log(r.Permissions);
		   			var test=r.Permissions;
		   			for (index = 0; index < test.length; ++index) {
       						console.log(test[index]);
   						if(test[index]['module_name']=="Dashboard"){
							//$(".dashchck").prop("checked", true);
							if (test[index]['add']==0)
							  $(".dashchck").prop("checked",true);
							 
							  if (test[index]['edit']==0)
							  $(".dashchck").prop("checked",true);
							  
							  if (test[index]['delete']==0)
							  $(".dashchck").prop("checked",true);
							  
							  if (test[index]['view']==0)
							  $(".dashchck").prop("checked",true);
							  
   						}
   						if(test[index]['module_name']=="Student"){
   							$(".stdntchck").prop("checked", true);
   							$(".permsn").trigger("change");
							if (test[index]['add']==0)
							  $(".stdntaddchck").prop("checked",true);
							  else
							  	$(".stdntaddchck").prop("checked",false);
							  if (test[index]['edit']==0)
							  $(".stdnteditchck").prop("checked",true);
							  else
							  	$(".stdnteditchck").prop("checked",false);
							  if (test[index]['delete']==0)
							  $(".stdntdeletechck").prop("checked",true);
							  else
							  	$(".stdntdeletechck").prop("checked",false);
							  if (test[index]['view']==0)
							  $(".stdntviewchck").prop("checked",true);
							  else
							  	$(".stdntviewchck").prop("checked",false);

   						}
					}
		   		}
		   	}

		   });

	}
	else{
		$("#permission_table").hide();
		
	}
	
});

$("#btnpermission").click(function(e){
	e.preventDefault();
	listInput = [];
	if ($('input[type=checkbox]').is(':checked')) {
     	$('input[type=checkbox]').each(function(){
      		if ($(this).is(':checked')) 
          {
            listInput.push($(this).attr('data-value'));
          }
      });
      
    }
		    let map = ((m, a) => (a.forEach(s => {
		  let a = m.get(s[0]) || [];
		  m.set(s[0], (a.push(s), a));
		}), m))(new Map(), listInput);

    var permissions={role:$("#SubjectID").val(),dashboard_permission:map.get("D"),student_permission:map.get("S")}
   
   $.ajax({
   	url:"{{url('permission/add')}}",
   	method:"POST",
   	data:permissions,
   	success:function(data){
   		
   		if ($.trim(data)=="Permissions saved") {
   			$("#succ").show();
   			setTimeout(
				    function () {
				        $("#succ").hide();
				    },1000);
   		}
   		if ($.trim(data)=="Permissions Updated") {
   			$("#err").show();
		   			setTimeout(
				    function () {
				        $("#err").hide();
				    },1000);
   		}
   	}

   });
   
});
	

	 
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