@extends('main')
@section('pagetitle')
Supervisor : List of all Supervisor
@endsection
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Supervisor
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Supervisor</li>
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
		 
		  
		  <div class="row" id="Supervisor_add" style="display:none;">
		  <div class="col-md-12">
		  <div class="box box-info">
		    <div class="box-header">
			Add Supervisor
			</div>
		    <div class="box-body">
		  <!-- form start -->
                <form action="{{url('supervisor/add')}}" method="post" class="form-horizontal"  onSubmit="return checkform();">
					{!! csrf_field() !!}
                  <div class="box-body" id="addformdiv">
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Supervisor Name</label><div class="col-sm-10"><input type="text" class="form-control" name="Name" id="Name" placeholder="Supervisor Name"></div></div>
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Mobile</label><div class="col-sm-10"><input type="text" class="form-control" name="Mobile" placeholder="Supervisor Mobile"></div></div>
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Supervisor Status</label><div class="col-sm-10"><select class="form-control" name="status" ><option value="1">Active</option><option value="0">De-active</option></select></div></div>
				    <div class="form-group"><label for="password" class="col-sm-2 control-label">Supervisor Password</label><div class="col-sm-10"><input type="password" class="form-control" name="Password" id="password1" placeholder="Supervisor Password" required> <em id="passworderror" style="color:red">Password & Confirm Password not matched</em></div></div>
				    <div class="form-group"><label for="password" class="col-sm-2 control-label">Supervisor Confirm Password</label><div class="col-sm-10"><input type="password" class="form-control" name="ConfirmPassword" id="password2" placeholder="Supervisor Confirm Password" required></div></div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Add</button>
                  </div><!-- /.box-footer -->
                </form>
		  </div>
		  </div>
		  </div>
		  </div>
		  
		  
		  <div class="row" id="Supervisor_edit" style="display:none;">
		  <div class="col-md-12">
		  <div class="box box-info">
		    <div class="box-header">
			Edit SuperVisor
			</div>
		    <div class="box-body">
		  <!-- form start -->
                <form action="{{url('supervisor/update')}}" method="post" class="form-horizontal"   onSubmit="return checkform2();">
					{!! csrf_field() !!}
                  <div class="box-body" id="addformdiv">
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Supervisor Name</label><div class="col-sm-10"><input type="text" class="form-control" name="Name" id="updateSupervisorName" placeholder="Supervisor Name"></div></div>
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Mobile</label><div class="col-sm-10"><input type="text" class="form-control" name="Mobile" id="updateSupervisorMobile" placeholder="Supervisor Mobile"></div></div>
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Supervisor Status</label><div class="col-sm-10"><select class="form-control" name="status" id="updateSupervisorStatus" ><option value="1">Active</option><option value="0">De-active</option></select></div></div>
				    <div class="form-group"><label for="password" class="col-sm-2 control-label">Supervisor Password</label><div class="col-sm-10"><input type="password" class="form-control" name="Password" id="password11" placeholder="Supervisor Password"> <em id="passworderror1" style="color:red">Password & Confirm Password not matched</em></div></div>
				    <div class="form-group"><label for="password" class="col-sm-2 control-label">Supervisor Confirm Password</label><div class="col-sm-10"><input type="password" class="form-control" name="ConfirmPassword" id="password22" placeholder="Supervisor Confirm Password"></div></div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
				  <input type="hidden" name="id" value="" id="updateID">
                    <button type="submit" class="btn btn-info pull-right">Update</button>
                  </div><!-- /.box-footer -->
                </form>
		  </div>
		  </div>
		  </div>
		  </div>
		  
		  <div class="row" id="Subject_remove">
		  <div class="col-md-12">
		  <div class="box box-info">
		    <div class="box-header">
			Supervisor
			 <div class="pull-right">
			  <a class="btn btn-primary btn-small" onclick="addsupervisor();">Add Supervisor</a>
			  </div>
			</div>
			
		    <div class="box-body">
			<table class="table centertd">
				<tr><td style="text-align:center"><b>Name</b></td>
				<td style="text-align:center"><b>Mobile</b></td>
				<td style="text-align:center"><b>Status</b></td>
				<td style="text-align:center"><b>Action</b></td>
				</tr>
				@foreach($Supervisor as $A)
					<tr>
					<td style="text-align:center">{{$A->Name}}</td>
					<td style="text-align:center">{{$A->Mobile}}</td>
					<td style="text-align:center">@if($A->status) Activated @else Deactivated @endif</td>
					<td style="text-align:center">
				  <button  class="btn btn-info" style="display:inline-block" onclick="editsupervisor({{$A->id}}, '{{$A->Name}}', '{{$A->Mobile}}', '{{$A->status}}')"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button>
					 <form action="{{url('supervisor/remove')}}"  style="display:inline-block"  method="post" class="form-horizontal">
					{!! csrf_field() !!}
                  <input type="hidden" name="id" value="{{$A->id}}">
				  <button type="submit" class="btn btn-info"><i class="fa fa-trash" aria-hidden="true"></i> Remove</button>
				  </form>
					</td></tr>
				@endforeach
				</table>
                 
                
				</div>
		  <div class="box-footer">
                  </div><!-- /.box-footer -->
		  </div>
		  </div>
		  </div>

        </section><!-- /.content -->
@endsection
@section('rightsidebar')
  @include('includes.rightsidebar')
@endsection

@section('extra')
<script>

	$('#passworderror').hide();
function checkform()
{
var password1 = $('#password1').val();
var password2 = $('#password2').val();
if(password1 != password2)
{
	$('#passworderror').show();
	return false;
}
else
{
   return true;
}
}
function checkform2()
{
var password1 = $('#password11').val();
var password2 = $('#password22').val();
if(password1 != password2)
{
	$('#passworderror1').show();
	return false;
}
else
{
   return true;
}
}
function addsupervisor()
	{
		$('#Supervisor_add').toggle(500);
	}
function editsupervisor(id, Name, Mobile, status)
	{
		$('#updateSupervisorName').val(Name);
		$('#updateSupervisorMobile').val(Mobile);
		$('#updateSupervisorStatus').val(status);
		$('#updateID').val(id);
		$('#Supervisor_edit').slideDown(500);
	}
	</script>
@endsection