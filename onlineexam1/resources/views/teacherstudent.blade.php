@extends('teachermain')
@section('pagetitle')
Students : List of  Students
@endsection
@section('content')
        <!-- Content Header (Page header) -->
        
        <section class="content-header">
          <h1>
            Students
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{url('teacher/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Students</li>
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
		  
		   <div class="row" id="Student_add"  style="display:none;">
		  <div class="col-md-12">
		  <div class="box box-info">
		    <div class="box-header">
			Add Student
			</div>
		    <div class="box-body">
		  <!-- form start -->
                <form action="{{url('teacher/studentadd')}}" method="post"  enctype="multipart/form-data" class="form-horizontal">
					{!! csrf_field() !!}
                  <div class="box-body" id="addformdiv">
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Roll No.</label><div class="col-sm-10"><input type="text" class="form-control" name="RollNo" placeholder="Roll No."></div></div>
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Name</label><div class="col-sm-10"><input type="text" class="form-control" name="Name" placeholder="Student Name"></div></div>
				    
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Image</label><div class="col-sm-10"><input type="file" class="form-control" name="image" placeholder="Student Photo" accept=".jpg"></div></div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Add</button>
                  </div><!-- /.box-footer -->
                </form>
		  </div>
		  </div>
		  </div>
		  </div>
		  
		  
		   <div class="row" id="Student_edit" style="display:none;">
		  <div class="col-md-12">
		  <div class="box box-info">
		    <div class="box-header">
			Edit Student
			</div>
		    <div class="box-body">
		  <!-- form start -->
                <form action="{{url('teacher/studentupdate')}}" enctype="multipart/form-data"  method="post" class="form-horizontal">
					{!! csrf_field() !!}
                  <div class="box-body" id="addformdiv">
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Roll No.</label><div class="col-sm-10"><input type="text" class="form-control" name="RollNo" id="RollNoUpdate" placeholder="Roll No."></div></div>
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Name</label><div class="col-sm-10"><input type="text" class="form-control" name="Name" id="NameUpdate" placeholder="Student Name"></div></div>
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Student Photo</label><div class="col-sm-10"><input type="file" class="form-control" name="image" accept=".jpg" placeholder="Student Photo"><em>This will replace exiting Photo</em></div></div>
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
              <h3 class="box-title">Students</h3>
			  <div class="pull-right">
			  <a class="btn btn-primary btn-small addbtn" onclick="addstudent();" @if($add_permission==1) disabled='disabled' @endif >Add Student</a>
			  </div>
            </div><!-- /.box-header -->
            <div class="box-body">
				<table class="table centertd">
				<tr><td style="text-align:center"><b>Photo</b></td><td style="text-align:center"><b>Roll No.</b></td><td style="text-align:center"><b>Name</b></td>
				<td style="text-align:center"><b>Action</b></td></tr>
				 @foreach ($Student as $S)
					<tr><td style="text-align:center"><img src="{{asset('img/upload/')}}/@if($S->img == null or $S->img == "")noimage.jpg @else{{$S->img}} @endif" style="width:50px;" /></td><td style="text-align:center">{{$S->RollNo}}</td><td style="text-align:center">{{$S->Name}}</td><td style="text-align:center">
					<a class="btn btn-primary btn-small" title="Edit" onclick="editstudent({{$S->id}}, {{$S->RollNo}}, '{{$S->Name}}')" @if($edit_permission==1) disabled='disabled' @endif><i class="fa fa-edit" aria-hidden="true"></i></a>
					<a class="btn btn-primary btn-small" title="Delete" onclick="deletestudent({{$S->id}});" @if($delete_permission==1) disabled='disabled' @endif><i class="fa fa-trash" aria-hidden="true"></i></a>
					</td></tr>
				@endforeach
				</table>
            </div><!-- /.box-body -->
            <div class="box-footer">
			{{ $Student->links() }}
			</div>
          </div><!-- /.box -->
        </section><!-- /.content -->
@endsection
<!-- @section('rightsidebar')
  @include('includes.rightsidebar')
@endsection -->
@section('extra')
  <script>
  	
	function addstudent()
	{
		$('#Student_add').toggle(500);
	}
	function editstudent(id, rollno, name)
	{
		$('#IDupdate').val(id);
		$('#RollNoUpdate').val(rollno);
		$('#NameUpdate').val(name);
		$('#Student_edit').slideDown(500);
	}
	function deletestudent(a)
	{
		var c = confirm("Are you sure want to remove this Student ?");
		if(c)
		{
		window.location = "{{url('teacher/studentremove/')}}/"+a;
		}
	}
</script>
@endsection