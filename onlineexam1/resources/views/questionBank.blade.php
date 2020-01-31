@extends('main')
@section('pagetitle')
Question Bank : List of all Question Bank
@endsection
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Question Bank
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Question Bank</li>
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
		 
		  
		  <div class="row" id="QuestionBank_add" style="display:none;">
		  <div class="col-md-12">
		  <div class="box box-info">
		    <div class="box-header">
			Add Question Bank
			</div>
		    <div class="box-body">
		  <!-- form start -->
                <form action="{{url('questionbank/add')}}" method="post" class="form-horizontal" >
					{!! csrf_field() !!}
                  <div class="box-body" id="addformdiv">
				    <div class="form-group"><label for="Question" class="col-sm-2 control-label">Question</label><div class="col-sm-10"><input type="text" class="form-control" name="Question" id="Question" placeholder="Question"></div></div>
				    <div class="form-group"><label for="Option1" class="col-sm-2 control-label">Option 1 [Answer]</label><div class="col-sm-10"><input type="text" class="form-control" name="Option1" placeholder="Option 1"></div></div>
				    <div class="form-group"><label for="Option2" class="col-sm-2 control-label">Option 2 </label><div class="col-sm-10"><input type="text" class="form-control" name="Option2" placeholder="Option 2"></div></div>
				    <div class="form-group"><label for="Option3" class="col-sm-2 control-label">Option 3 </label><div class="col-sm-10"><input type="text" class="form-control" name="Option3" placeholder="Option 3"></div></div>
				    <div class="form-group"><label for="Option4" class="col-sm-2 control-label">Option 4</label><div class="col-sm-10"><input type="text" class="form-control" name="Option4" placeholder="Option 4"></div></div>
				    <div class="form-group"><label for="SubjectID" class="col-sm-2 control-label">Subject </label><div class="col-sm-10"><select class="form-control" name="SubjectID" required>
					<option value="">Select</option>
					@foreach($Subject as $S)
					<option value="{{$S->id}}">{{$S->Name}}</option>
					@endforeach
					</select></div></div>
					
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Add</button>
                  </div><!-- /.box-footer -->
                </form>
		  </div>
		  </div>
		  </div>
		  </div>
		  
		  
		  <div class="row" id="QuestionBank_edit" style="display:none;">
		  <div class="col-md-12">
		  <div class="box box-info">
		    <div class="box-header">
			Edit SuperVisor
			</div>
		    <div class="box-body">
		  <!-- form start -->
                <form action="{{url('questionbank/update')}}" method="post" class="form-horizontal"   onSubmit="return checkform2();">
					{!! csrf_field() !!}
                  <div class="box-body" id="addformdiv">
				     <div class="form-group"><label for="Question" class="col-sm-2 control-label">Question</label><div class="col-sm-10"><input type="text" class="form-control" id="UpdateQuestion" name="Question" placeholder="Question"></div></div>
				    <div class="form-group"><label for="Option1" class="col-sm-2 control-label">Option 1 [Answer]</label><div class="col-sm-10"><input type="text" class="form-control" id="UpdateOption1"  name="Option1" placeholder="Option 1"></div></div>
				    <div class="form-group"><label for="Option2" class="col-sm-2 control-label">Option 2 </label><div class="col-sm-10"><input type="text" class="form-control" id="UpdateOption2" name="Option2" placeholder="Option 2"></div></div>
				    <div class="form-group"><label for="Option3" class="col-sm-2 control-label">Option 3 </label><div class="col-sm-10"><input type="text" class="form-control" id="UpdateOption3" name="Option3" placeholder="Option 3"></div></div>
				    <div class="form-group"><label for="Option4" class="col-sm-2 control-label">Option 4</label><div class="col-sm-10"><input type="text" class="form-control" id="UpdateOption4" name="Option4" placeholder="Option 4"></div></div>
				    <div class="form-group"><label for="SubjectID" class="col-sm-2 control-label">Subject </label><div class="col-sm-10"><select class="form-control" name="SubjectID" id="UpdateSubjectID" required>
					<option value="">Select</option>
					@foreach($Subject as $S)
					<option value="{{$S->id}}">{{$S->Name}}</option>
					@endforeach
					</select></div></div>
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
			Question Bank
			 <div class="pull-right">
			  <a class="btn btn-primary btn-small" onclick="addquestionbank();">Add Question</a>
			  </div>
			</div>
			
		    <div class="box-body">
			<table class="table centertd">
				<tr><td style="text-align:center"><b>Question</b></td>
				<td style="text-align:center"><b>Options</b></td>
				<td style="text-align:center"><b>Subject</b></td>
				<td style="text-align:center"><b>Action</b></td>
				</tr>
				@foreach($QB as $A)
					<tr>
					<td style="text-align:left">{{$A->Question}}</td>
					<td style="text-align:center">{{$A->Option1}},{{$A->Option2}}<br />{{$A->Option3}},{{$A->Option4}}</td>
					<td style="text-align:center">{{$A->SubjectName}}</td>
					<td style="text-align:center">
				  <button  class="btn btn-info" style="display:inline-block" onclick="editquestionbank({{$A->id}}, '{{$A->Question}}', '{{$A->Option1}}', '{{$A->Option2}}', '{{$A->Option3}}', '{{$A->Option4}}', '{{$A->SubjectID}}')"><i class="fa fa-edit" aria-hidden="true"></i></button>
					 <form action="{{url('questionbank/remove')}}"  style="display:inline-block"  method="post" class="form-horizontal">
					{!! csrf_field() !!}
                  <input type="hidden" name="id" value="{{$A->id}}">
				  <button type="submit" class="btn btn-info"><i class="fa fa-trash" aria-hidden="true"></i></button>
				  </form>
					</td></tr>
				@endforeach
				</table>
                 
                
				</div>
		  <div class="box-footer">
{{$QB->links()}}
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

function addquestionbank()
	{
		$('#QuestionBank_add').toggle(500);
	}
function editquestionbank(id, Question, Option1,Option2,Option3,Option4, SubjectID)
	{
		$('#UpdateQuestion').val(Question);
		$('#UpdateOption1').val(Option1);
		$('#UpdateOption2').val(Option2);
		$('#UpdateOption3').val(Option3);
		$('#UpdateOption4').val(Option4);
		$('#UpdateSubjectID').val(SubjectID);
		$('#updateID').val(id);
		$('#QuestionBank_edit').slideDown(500);
	}
	</script>
@endsection