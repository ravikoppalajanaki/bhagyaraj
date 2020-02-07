<section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{asset('img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p class="style">{{Session::get('teacher_details')->name}}</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- /.search form -->
          <!-- h sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li>
              <a href="{{url('teacher/dashboard')}}">
                 <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li>
              <a href="{{url('teacher/students')}}">
                 <i class="fa fa-dashboard"></i> <span>Students</span>
              </a>
            </li>
          </ul>
        </section>
        <style type="text/css">
          .style{
            margin-left: -5px;
          }
        </style>
        <!-- /.sidebar -->