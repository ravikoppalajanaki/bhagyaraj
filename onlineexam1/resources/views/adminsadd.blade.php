@extends('main')
@section('pagetitle')
Add Admin User
@endsection
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Admin User
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Admin User</li>
          </ol>
        </section>

          
			
                    
        <!-- Main content -->
        <section class="content">
		 @if(isset($success))
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h5> {!!$success!!}</h5>
				</div>
			@endif	
			 @if(count($errors) > 0)<div class="alert alert-warning alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					
 @foreach($errors->all() as $error)
           {!!$error!!}<br />
        @endforeach
    </div>
	@endif
	
           <div class="box box-info" id="useraddview">
                <div class="box-header with-border">
                  <h3 class="box-title">Add Admin User</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form action="{{url('admins/add')}}" method="post" class="form-horizontal" onSubmit="return checkform();">
					{!! csrf_field() !!}
                  <div class="box-body" id="addformdiv">
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Email </label><div class="col-sm-10"><input type="text" class="form-control" id="email" value="{{ old('email') }}" name="email" placeholder="Email"></div></div>
				    <div class="form-group"><label for="name" class="col-sm-2 control-label">Name</label><div class="col-sm-10"><input type="text" class="form-control" id="name" name="name" value="{{old('name')}}"  placeholder="Name"></div></div>
				    <div class="form-group"><label for="mobileno" class="col-sm-2 control-label">Mobile Number</label><div class="col-sm-10"><input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number" value="{{old('mobile')}}" required></div></div>
					<div class="form-group"> <label for="password1" class="col-sm-2 control-label">Password</label> <div class="col-sm-10"> <input type="password" class="form-control" id="password1" name="password" placeholder="Password"> <em id="passworderror" style="color:red">Password & Confirm Password not matched</em></div></div>
					
					<div class="form-group"><label for="password2" class="col-sm-2 control-label">Confirm Password</label> <div class="col-sm-10"> <input type="password" class="form-control" id="password2" name="password_confirm" placeholder="Confirm Password"></div> </div> 
					
					<div class="form-group"><label for="select" class="col-sm-2 control-label">Permission</label> <div class="col-sm-10"> 
					<select class="form-control" name="permission[]" multiple>
					<option value="users">Users List</option>
					<option value="userspost">Ability to Suspend/Unsuspend User</option>
					<option value="userview">View User Profile</option>
					<option value="userupdate">Able to Update User Profile</option>
					<option value="userAssign">View Assign Donation Page</option>
					<option value="AssignSelectPost">Assign Donation to User</option>
					<option value="requestmanager">Access Request Manager</option>
					<option value="settings">View Site Settings</option>
					<option value="settingsupdate">Update Site Settings</option>
					<option value="admins">Admins User List</option>
					<option value="adminview">Admin, Single Admin Profile</option>
					<option value="adminadd">Add Admin</option>
					<option value="adminupdate">Admin Update Details</option>
					<option value="admindelete">Admin Delete</option>
					</select>
					</div> </div> 
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Add</button>
                  </div><!-- /.box-footer -->
                </form>
              </div><!-- /.box -->
			  
          
          

        </section><!-- /.content -->
@endsection
@section('rightsidebar')
  @include('includes.rightsidebar')
@endsection
@section('extra')
<script src="plugins/select2/select2.full.min.js"></script>
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

window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 5000);

</script>
@endsection		
		