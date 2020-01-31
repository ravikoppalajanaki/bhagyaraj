@extends('main')
@section('pagetitle')
User Access Denied
@endsection
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Access Denied
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Access Denied</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">	
		
          <div class="row">
		  <div class="col-md-12">
		  <div class="alert alert-warning">
		  Access Denied, Check your permission.
		  </div>
		  </div>
		  </div>
		  
        </section><!-- /.content -->
@endsection
@section('rightsidebar')
  @include('includes.rightsidebar')
@endsection