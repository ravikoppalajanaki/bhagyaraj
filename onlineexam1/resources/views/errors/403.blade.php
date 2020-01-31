@extends('main')
@section('pagetitle')
Error 403 :: Forbidden
@endsection
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Error 403 :: Forbidden
            <small>Error Encounter</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Error 403 :: Forbidden</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="error-page">
            <h2 class="headline text-red">403</h2>
            <div class="error-content">
              <h3><i class="fa fa-warning text-red"></i> Oops! Something went wrong.</h3>
              <p>
                You are accessing the page which you have no permission to access
                Meanwhile, you may <a href="{{url('dashboard')}}">return to dashboard</a>.
              </p>
            </div>
          </div><!-- /.error-page -->

        </section><!-- /.content -->
@endsection
		