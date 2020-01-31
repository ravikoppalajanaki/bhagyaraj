@extends('main')
@section('pagetitle')
Exams : List of all Exams
@endsection
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Exams
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Exams</li>
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
				<div class="box-header with-border">
				  <h3 class="box-title">Report Generator</h3>
				 </div>
				 <div class="box-body">
				 <form action="{{url('report/generate')}}">
				  <div class="col-md-2"><select name="SubjectID" class="form-control"><option value="All">All</option> @foreach($Subject as $S)<option value="{{$S->id}}">{{$S->Name}}</option> @endforeach </select></div>
				  <div class="col-md-2"><input type="text" name="startdate" id="datepicker1" class="form-control" placeholder="From Date"></div>
				  <div class="col-md-2"><input type="text" name="enddate" id="datepicker2" class="form-control" placeholder="To Date"></div>
				  <div class="col-md-2"><input type="submit" class="btn btn-success" value="Generate"></div>
				  </form>
				 </div>
			</div>
		   
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Exams</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
				<table class="table centertd">
				<tr><td style="text-align:center"><b>Roll No.</b></td><td style="text-align:center"><b>Name</b></td><td style="text-align:center"><b>Total Question</b></td><td style="text-align:center"><b>Correct Question</b></td>
				<td style="text-align:center"><b>Action</b></td></tr>
				 @foreach ($Exam as $S)
					<tr><td style="text-align:center">{{$S->RollNo}}</td>
					<td style="text-align:center">{{$S->Name}}</td>
					<td style="text-align:center">{{$S->TotalQuestion}}</td>
					<td style="text-align:center">{{$S->correctAnswer}}</td>
					<td style="text-align:center">
				 <a class="btn btn-primary btn-small" href="{{url('exams/view')}}/{{$S->id}}" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a>
					<a class="btn btn-primary btn-small" title="Delete" onclick="deleteexam({{$S->id}});"><i class="fa fa-trash" aria-hidden="true"></i></a>
					</td></tr>
				@endforeach
				</table>
            </div><!-- /.box-body -->
            <div class="box-footer">
			{{ $Exam->links() }}
			</div>
          </div><!-- /.box -->
        </section><!-- /.content -->
@endsection
@section('rightsidebar')
  @include('includes.rightsidebar')
@endsection
@section('extra')
  <script>

	function deleteexam(a)
	{
		var c = confirm("Are you sure want to delete this exam ?");
		if(c)
		{
		window.location = "{{url('exams/delete/')}}/"+a;
		}
	}
	 $('#datepicker1 , #datepicker2').datepicker({
      autoclose: true,
format : "yyyy/mm/dd"
    });
</script>
@endsection