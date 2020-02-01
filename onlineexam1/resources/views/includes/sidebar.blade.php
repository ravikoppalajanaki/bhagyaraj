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
          <!-- h sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li>
              <a href="{{url('dashboard')}}">
                 <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li>
              <a href="{{url('student')}}">
                 <i class="fa fa-users"></i> <span>Students</span>
              </a>
            </li>
             <li>
              <a href="{{url('teacher')}}">
                 <i class="fa fa-table"></i> <span>Teachers</span>
              </a>
            </li>
            <li>
              <a href="{{url('subject')}}">
                 <i class="fa fa-table"></i> <span>Subject Manager</span>
              </a>
            </li>
            <li>
              <a href="{{url('supervisor')}}">
                 <i class="fa fa-table"></i> <span>Supervisor Manager</span>
              </a>
            </li>
            <li>
              <a href="{{url('questionbank')}}">
                 <i class="fa fa-table"></i> <span>QuestionBank Manager</span>
              </a>
            </li>
            <li>
              <a href="{{url('exams')}}">
                 <i class="fa fa-table"></i> <span>Exams</span>
              </a>
            </li>
            <li>
              <a href="{{url('settings')}}">
                 <i class="fa fa-table"></i> <span>Settings</span>
              </a>
            </li>
           <li class="treeview">
            <a href="#">
                 <i class="fa fa-table"></i> <span>Administration</span>
                 <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
              </a>
             <ul class="treeview-menu">
               <li>
                 <a href="{{url('permission')}}">
                 <i class="fa fa-table"></i> <span>Permission</span>
              </a>
               </li>
             </ul>
           </li>
            <!--li>
              <a href="{{url('admins')}}">
                 <i class="fa fa-table"></i> <span>Admin Users</span>
              </a>
            </li-->
          </ul>
        </section>
        
        <!-- /.sidebar -->