@extends('main')
@section('pagetitle')
Settings
@endsection
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Exams Reports
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Report Settings</li>
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
           <div class="box box-info" id="useraddview">
                <div class="box-header with-border">
                  <h3 class="box-title">Settings</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form action="{{url('settings')}}" method="post" class="form-horizontal">
					{!! csrf_field() !!}
                  <div class="box-body" id="addformdiv">
				    <div class="form-group"><label for="showResult" class="col-sm-2 control-label">Show Result</label><div class="col-sm-10"><select class="form-control" id="showResult" name="showResult" value="{{$settings->showResult}}">
					<option value="1" @if($settings->showResult == 1) Selected @endif>Yes</option>
					<option value="0" @if($settings->showResult == 0) Selected @endif>No</option>
					</select></div></div>
				    <div class="form-group"><label for="noQuestion" class="col-sm-2 control-label">No of Question </label><div class="col-sm-10"><input type="text" class="form-control" id="noQuestion" value="{{$settings->noQuestion}}" name="noQuestion" placeholder="No. of Question"></div></div>
				    <div class="form-group"><label for="timing" class="col-sm-2 control-label">Timing </label><div class="col-sm-10"><input type="text" class="form-control" id="timing" value="{{$settings->timing}}" name="timing" placeholder="Timing"></div></div>
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
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 5000);

</script>
@endsection		
		