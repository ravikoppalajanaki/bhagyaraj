@extends('main')
@section('pagetitle')
Users : List of all Users
@endsection
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admins
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Admins</li>
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
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Admins</h3>
			  <div class="box-toolbar pull-right"><a href="{{url('admins/add')}}" class="btn btn-small btn-primary">Add</a></div>
            </div><!-- /.box-header -->
            <div class="box-body">
				<table class="table centertd">
				<tr><td style="text-align:center"><b>Name</b></td><td style="text-align:center"><b>Email</b></td><td style="text-align:center"><b>Mobile</b></td><td style="text-align:center"><b>Action</b></td></tr>
				
				 @foreach ($users as $user)
					<tr><td style="text-align:center">{{$user->name}}</td><td style="text-align:center">{{$user->email}}</td><td style="text-align:center">{{$user->mobile}}</td><td style="text-align:center">
					<form method="post" action="{{url('admins/delete')}}">
										{!!csrf_field()!!}
					<input type="hidden" name="id" value="{{$user->id}}">
					<button class="btn btn-primary btn-small">Delete</button> 
					</form>
					<a class="btn btn-primary btn-small" href="{{url('admins/view/')}}/{{$user->id}}">Profile</a>
					</td></tr>
					
				@endforeach
				</table>
            </div><!-- /.box-body -->
			
            <div class="box-footer">
			{{ $users->links() }}
			</div>
          </div><!-- /.box -->
		  

        </section><!-- /.content -->
@endsection
@section('rightsidebar')
  @include('includes.rightsidebar')
@endsection