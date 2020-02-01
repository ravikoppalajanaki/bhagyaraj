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
					<td ><input type="checkbox" name=""></td>
					<td >Dashboard</td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
					</tr>
					<tr>
					<td ><input type="checkbox" name=""></td>
					<td >Student</td>
					<td ><input type="checkbox" name=""></td>
					<td ><input type="checkbox" name=""></td>
					<td ><input type="checkbox" name=""></td>
					<td ><input type="checkbox" name=""></td>
					</tr>
					<tr>
                       <td colspan="6" rowspan="2">
                        <input class="btn btn-success" type="submit" name="" value="Save Permission">
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
$("#SubjectID").change(function(e){
	e.preventDefault();
	var val=$(this).val();
	if(val!=''){
		$("#permission_table").show();
	}
	else
		$("#permission_table").hide();
	

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