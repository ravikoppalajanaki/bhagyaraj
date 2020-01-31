@extends('main')
@section('pagetitle')
Subjects : List of all Subjects
@endsection
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Subject
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
           <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Subjects</li>
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
		 
		  
		  <div class="row" id="Subject_add" style="display:none;">
		  <div class="col-md-12">
		  <div class="box box-info">
		    <div class="box-header">
			Add Subject
			</div>
		    <div class="box-body">
		  <!-- form start -->
                <form action="{{url('subject/add')}}" method="post" class="form-horizontal">
					{!! csrf_field() !!}
                  <div class="box-body" id="addformdiv">
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Subject Name</label><div class="col-sm-10"><input type="text" class="form-control" name="Name" placeholder="Subject Name"></div></div>
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Add</button>
                  </div><!-- /.box-footer -->
                </form>
		  </div>
		  </div>
		  </div>
		  </div>
		  
		  
		  <div class="row" id="Subject_edit" style="display:none;">
		  <div class="col-md-12">
		  <div class="box box-info">
		    <div class="box-header">
			Edit Subject
			</div>
		    <div class="box-body">
		  <!-- form start -->
                <form action="{{url('subject/update')}}" method="post" class="form-horizontal">
					{!! csrf_field() !!}
                  <div class="box-body" id="addformdiv">
				    <div class="form-group"><label for="email" class="col-sm-2 control-label">Subject Name</label><div class="col-sm-10"><input type="text" class="form-control" name="Name" id="updateName" placeholder="Subject Name"></div></div>
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
			Subjects
			 <div class="pull-right">
			  <a class="btn btn-primary btn-small" onclick="addsubject();">Add Subject</a>
			  </div>
			</div>
			
		    <div class="box-body">
			<table class="table centertd">
				<tr><td style="text-align:center"><b>Name</b></td>
				<td style="text-align:center"><b>Action</b></td></tr>
				@foreach($Subject as $A)
					<tr><td style="text-align:center">{{$A->Name}}</td><td style="text-align:center">
					
				  <button  class="btn btn-info" style="display:inline-block" onclick="editsubject({{$A->id}}, '{{$A->Name}}')"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button>
					 <form action="{{url('subject/remove')}}"  style="display:inline-block"  method="post" class="form-horizontal">
					{!! csrf_field() !!}
                  <input type="hidden" name="id" value="{{$A->id}}" >
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
function addsubject()
	{
		$('#Subject_add').toggle(500);
	}
function editsubject(id, Name)
	{
		$('#updateName').val(Name);
		$('#updateID').val(id);
		$('#Subject_edit').slideDown(500);
	}
	</script>
@endsection