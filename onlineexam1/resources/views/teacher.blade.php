@extends('main')
@section('pagetitle')
Teachers : List of all Teachers
@endsection
@section('content')
<script type="text/javascript"> $(document).ready(function () {
//alert("hii");
    $('#submitform').validate({ 

        rules: {
            Name: {
                required: true
            },
            Designation: {
                required: true
            },
            email: {
                required: true,
                email:true
            },
            gender: {
                required: true
            },
            address: {
                required: true
            },
            phone_number: {
                required: true,
                digits:true
            },
            dob: {
                required: true
            },
            joining_date: {
                required: true
            },
            username: {
                required: true
            },
            Password: {
                required: true
            },
            image: {
                required: true
            },
        }
    });

});
</script>
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Teachers
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Teacher</li>
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


		  
		 
		   <div class="row" id="Teacher_add"  style="display:none;">
		  <div class="col-md-12">
		  <div class="box box-info">
		    <div class="box-header">
			Add Teacher
			</div>
		    <div class="box-body">
		  <!-- form start -->
                <form action="{{url('teacher/add')}}" method="post"  enctype="multipart/form-data" class="form-horizontal" id="submitform">
					{!! csrf_field() !!}
                  <div class="box-body" id="addformdiv">
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Name</label><div class="col-sm-10"><input type="text" class="form-control" id="Name" name="Name" placeholder="Teacher Name"></div></div>
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Designation</label><div class="col-sm-10"><input type="text" class="form-control" id="Designation" name="Designation" placeholder="Teacher Designation"></div></div>
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Date of birth</label><div class="col-sm-10"><input type="text" class="form-control" name="dob" id="dob" placeholder="Teacher date of birth"></div></div>
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Gender</label><div class="col-sm-10"><label class="radio-inline"><input type="radio" id="gender" name="gender" value="Male" >Male</label>
                   <label class="radio-inline"><input type="radio" id="gender" name="gender" value="Female">Female</label></div></div>
				   
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Email ID</label><div class="col-sm-10"><input type="text" class="form-control" id="email" name="email" placeholder="Teacher Email ID"></div></div>
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Phone Number</label><div class="col-sm-10"><input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Teacher phone number"></div></div>
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Address</label><div class="col-sm-10"><input type="text" class="form-control" name="address" id="address" placeholder="Teacher address"></div></div>
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Joining date</label><div class="col-sm-10"><input type="text" class="form-control" name="joining_date" id="joining_date" placeholder="Teacher joining date"></div></div>
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Username</label><div class="col-sm-10"><input type="text" class="form-control" id="username" name="username" placeholder="Teacher Username"></div></div>
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Password</label><div class="col-sm-10"><input type="password" class="form-control" id="Password" name="Password" placeholder="Password"></div></div>
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Image</label><div class="col-sm-10"><input type="file" class="form-control" id="image" name="image" placeholder="Teacher Photo" accept=".jpg"></div></div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Add</button>
                  </div><!-- /.box-footer -->
                </form>
		  </div>
		  </div>
		  </div>
		  </div>
		  
		  
		   <div class="row" id="Teacher_edit" style="display:none;">
		  <div class="col-md-12">
		  <div class="box box-info">
		    <div class="box-header">
			Edit Teacher
			</div>
		    <div class="box-body">
		  <!-- form start -->
                <form action="{{url('teacher/update')}}" enctype="multipart/form-data"  method="post" class="form-horizontal" >
					{!! csrf_field() !!}
                  <div class="box-body" id="addformdiv">
                  	<div class="form-group"><label for="email" class="col-sm-2 control-label">Name</label><div class="col-sm-10"><input type="text" class="form-control" name="Name" id="NameUpdate" placeholder="Student Name"></div></div>
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Designation</label><div class="col-sm-10"><input type="text" class="form-control" name="designation" id="DesignationUpdate" placeholder="Roll No."></div></div>
				     <div class="form-group"><label for="email" class="col-sm-2 control-label">Date of birth</label><div class="col-sm-10"><input type="text" class="form-control" name="dob" id="dobUpdate" placeholder="Teacher date of birth"></div></div>
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Gender</label><div class="col-sm-10"><label class="radio-inline"><input type="radio" name="gender" value="Male" id="male" >Male</label>
                   <label class="radio-inline"><input type="radio" name="gender" value="Female" id="female">Female</label></div></div>
				   
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Email ID</label><div class="col-sm-10"><input type="text" class="form-control" name="email" placeholder="Teacher Email ID" id="emailUpdate"></div></div>
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Phone Number</label><div class="col-sm-10"><input type="text" class="form-control" name="phone_number" placeholder="Teacher phone number" id="phone_number_update"></div></div>
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Address</label><div class="col-sm-10"><input type="text" class="form-control" name="address" placeholder="Teacher address" id="addressUpdate"></div></div>
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Joining date</label><div class="col-sm-10"><input type="text" class="form-control" name="joining_date" id="joining_date_Update" placeholder="Teacher joining date"></div></div>
				    <!--<div class="form-group"><label for="email" class="col-sm-2 control-label">Username</label><div class="col-sm-10"><input type="text" class="form-control" name="username" id="usernameUpdate" placeholder="Teacher joining date"></div></div>
				     <div class="form-group"><label for="email" class="col-sm-2 control-label">Update Password</label><div class="col-sm-10"><input type="password" class="form-control" name="Password" id="passwordUpdate" placeholder="Password"></div></div> -->
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Teacher Photo</label><div class="col-sm-10"><input type="file" class="form-control" name="image" accept=".jpg" placeholder="Student Photo"><em>This will replace exiting Photo</em></div></div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
				  <input type="hidden" name="id" value="" id="IDupdate">
                    <button type="submit" class="btn btn-info pull-right">Update</button>
                  </div><!-- /.box-footer -->
                </form>
		  </div>
		  </div>
		  </div>
		  </div>
		  
		  
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Teacher</h3>
			  <div class="pull-right">
			  <a class="btn btn-primary btn-small" onclick="addteacher();">Add Teacher</a>
			  </div>
            </div><!-- /.box-header -->
            <div class="box-body">
				<table class="table centertd">
				<tr>
					<td style="text-align:center"><b>Photo</b></td><td style="text-align:center"><b>Name</b></td><td style="text-align:center"><b>Designation</b></td>
				<td style="text-align:center"><b>Action</b></td></tr>
				 @foreach ($Teacher as $S)
					<tr><td style="text-align:center"><img src="{{asset('img/upload/')}}/@if($S->photo == null or $S->photo == "")noimage.jpg @else{{$S->photo}} @endif" style="width:50px;" /></td><td style="text-align:center">{{$S->name}}</td><td style="text-align:center">{{$S->designation}}</td>
						<td style="text-align:center">
					<a class="btn btn-primary btn-small" title="Edit" onclick="editteacher({{$S->id}}, '{{$S->designation}}', '{{$S->name}}','{{$S->date_of_birth}}','{{$S->gender}}','{{$S->email}}','{{$S->phone_number}}','{{$S->address}}','{{$S->joining_date}}'/*,'{{$S->username}}','{{$S->password}}'*/);"><i class="fa fa-edit" aria-hidden="true"></i></a>
					<a class="btn btn-primary btn-small" title="Delete" onclick="deleteteacher({{$S->id}});"><i class="fa fa-trash" aria-hidden="true"></i></a>
					</td>
				</tr>
				@endforeach
				</table>
            </div><!-- /.box-body -->
            <div class="box-footer">
			{{ $Teacher->links() }}
			</div>
          </div><!-- /.box -->
        </section><!-- /.content -->
@endsection
@section('rightsidebar')
  @include('includes.rightsidebar')
@endsection
@section('extra')

  <script>
  	
	function addteacher()
	{
		$('#Teacher_add').toggle(500);
	}
	function editteacher(id,designation,name,dob,gender,email,phone_number,address,joining_date)
	{
		if($.trim(gender)=="Male")
			$("#male").prop("checked", true);
		if($.trim(gender)=="Female")
			$("#female").prop("checked", true);
		$('#IDupdate').val(id);
		$('#NameUpdate').val(name);
		$('#DesignationUpdate').val(designation);
		$('#dobUpdate').val(dob);
		$("#emailUpdate").val(email);
		$("#phone_number_update").val(phone_number);
		$("#addressUpdate").val(address);
		$("#joining_date_Update").val(joining_date);
		$('#Teacher_edit').slideDown(500);
	}
	function deleteteacher(a)
	{
		var c = confirm("Are you sure want to remove this Teacher ?");
		if(c)
		{
		window.location = "{{url('teacher/remove/')}}/"+a;
		}
	}

	$('#dob , #joining_date,#dobUpdate,#joining_date_Update').datepicker({
      autoclose: true,
format : "yyyy/mm/dd"
    });
   
</script>
@endsection