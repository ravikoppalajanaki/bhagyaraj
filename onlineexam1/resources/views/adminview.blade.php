@extends('main')
@section('pagetitle')
Admin Profile : Admin Profile
@endsection
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admin Profile
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Admin Profile</li>
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
           <div class="box box-info" id="useraddview">
                <div class="box-header with-border">
                  <h3 class="box-title">Admin Profile</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form action="{{url('/admins/view/update/')}}" method="post" class="form-horizontal" onSubmit="return checkform();">
					{!! csrf_field() !!}
                  <div class="box-body" id="addformdiv">
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Email </label><div class="col-sm-10"><input type="text" class="form-control" id="email" value="{{$user->email}}" name="email" placeholder="Email"></div></div>
				    <div class="form-group"><label for="name" class="col-sm-2 control-label">Name</label><div class="col-sm-10"><input type="text" class="form-control" id="name" name="name" value="{{$user->name}}"  placeholder="Name"></div></div>
				    <div class="form-group"><label for="mobileno" class="col-sm-2 control-label">Mobile Number</label><div class="col-sm-10"><input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number" value="{{$user->mobile}}" required></div></div>
					<div class="form-group"> <label for="password1" class="col-sm-2 control-label">Password</label> <div class="col-sm-10"> <input type="password" class="form-control" id="password1" name="password" placeholder="Password"> <em id="passworderror" style="color:red">Password & Confirm Password not matched</em></div></div>
					<div class="form-group"><label for="password2" class="col-sm-2 control-label">Confirm Password</label> <div class="col-sm-10"> <input type="password" class="form-control" id="password2" name="password_confirm" placeholder="Confirm Password"> <em>Provide password only if you want to change password.</em></div> </div> 
					<div class="form-group"><label for="select" class="col-sm-2 control-label">Permission</label> <div class="col-sm-10"> 
					<select class="form-control" name="permission[]" multiple>
					<option value="users" @if(in_array('users', json_decode($user->permission))) selected @endif>Users List</option>
					<option value="userspost" @if(in_array('userspost', json_decode($user->permission))) selected @endif>Ability to Suspend/Unsuspend/Delete User</option>
					<option value="userview" @if(in_array('userview', json_decode($user->permission))) selected @endif>View User Profile</option>
					<option value="userupdate" @if(in_array('userupdate', json_decode($user->permission))) selected @endif>Able to Update User Profile</option>
					<option value="userAssign" @if(in_array('userAssign', json_decode($user->permission))) selected @endif>View Assign Donation Page</option>
					<option value="AssignSelectPost" @if(in_array('AssignSelectPost', json_decode($user->permission))) selected @endif>Assign Donation to User</option>
					<option value="requestmanager" @if(in_array('requestmanager', json_decode($user->permission))) selected @endif>Access Request Manager</option>
					<option value="settings" @if(in_array('settings', json_decode($user->permission))) selected @endif>View Site Settings</option>
					<option value="settingsupdate" @if(in_array('settingsupdate', json_decode($user->permission))) selected @endif>Update Site Settings</option>
					<option value="admins" @if(in_array('admins', json_decode($user->permission))) selected @endif>Admins User List</option>
					<option value="adminview" @if(in_array('adminview', json_decode($user->permission))) selected @endif>Admin, Single Admin Profile</option>
					<option value="adminadd" @if(in_array('adminadd', json_decode($user->permission))) selected @endif>Add Admin</option>
					<option value="adminupdate" @if(in_array('adminupdate', json_decode($user->permission))) selected @endif>Admin Update Details</option>
					<option value="admindelete" @if(in_array('admindelete', json_decode($user->permission))) selected @endif>Admin Delete</option>
					</select>
					</div> </div> 
					





					<input type="hidden" name="id" value="{{$user->id}}">
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Update</button>
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
		