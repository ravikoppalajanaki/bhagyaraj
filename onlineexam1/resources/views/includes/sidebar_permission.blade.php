<section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{asset('img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>{{Auth::user()->name}}</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li>
              <a href="{{url('dashboard')}}">
                 <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
			@if(in_array('users', json_decode(Auth::user()->permission)))
            <li>
              <a href="{{url('users')}}">
                 <i class="fa fa-users"></i> <span>Users</span>
              </a>
            </li>
			@endif
			@if(in_array('helps', json_decode(Auth::user()->permission)))
            <li>
              <a href="{{url('helps')}}">
                 <i class="fa fa-table"></i> <span>GetHelp Request</span>
              </a>
            </li>
			@endif
			@if(in_array('donations', json_decode(Auth::user()->permission)))
            <li>
              <a href="{{url('donations')}}">
                 <i class="fa fa-table"></i> <span>Donation Request</span>
              </a>
            </li>
			@endif
			@if(in_array('settings', json_decode(Auth::user()->permission)))
            <li>
              <a href="{{url('settings')}}">
                 <i class="fa fa-table"></i> <span>Settings</span>
              </a>
            </li>
			@endif
			@if(in_array('bonus', json_decode(Auth::user()->permission)))
            <li>
              <a href="{{url('bonus')}}">
                 <i class="fa fa-table"></i> <span>Bonus</span>
              </a>
            </li>
			@endif
			@if(in_array('blacklist', json_decode(Auth::user()->permission)))
            <li>
              <a href="{{url('blacklist')}}">
                 <i class="fa fa-table"></i> <span>Black List</span>
              </a>
            </li>
			@endif
			@if(in_array('admins', json_decode(Auth::user()->permission)))
            <li>
              <a href="{{url('admins')}}">
                 <i class="fa fa-table"></i> <span>Admin Users</span>
              </a>
            </li>
			@endif
          </ul>
        </section>
        <!-- /.sidebar -->