<!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="/storage/images/profile/{{ auth()->user()->str_user_image_code }}" alt="User Image" style="height: 48px; width: 48px;">
      <div>
        <p class="app-sidebar__user-name">{{ auth()->user()->str_first_name }} {{ auth()->user()->str_last_name }}</p>
        <p class="app-sidebar__user-designation" style="color: gold;">Administrator</p>
      </div>
    </div>
    <ul class="app-menu">
      <li>
        <a class="app-menu__item {{Request::is('admin/dashboard') ? 'active':''}}" href="/admin/dashboard">
          <i class="app-menu__icon fa fa-dashboard"></i>
          <span class="app-menu__label">Dashboard</span>
        </a>
      </li>
      <li>
        <a class="app-menu__item {{Request::is('admin/mails') ? 'active':''}}" href="/admin/mails">
          <i class="app-menu__icon fa fa-envelope"></i>
          <span class="app-menu__label">Mails</span>
        </a>
      </li>
      <li class="treeview" id="li-schedule">
        <a class="app-menu__item" href="#" data-toggle="treeview">
          <i class="app-menu__icon fa fa-calendar"></i>
          <span class="app-menu__label">Schedule</span>
          <i class="treeview-indicator fa fa-angle-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
              <a class="treeview-item" href="{{ route('schedule.calendar') }}">Calendar</a>
          </li>
          <li>
              <a id="admin-today" class="treeview-item" href="{{ route('admin.today') }}">Today</a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">My Account</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="/admin/user-profile">My Profile</a></li>
        </ul>
      </li>
      <li class="treeview" id="li-maintenance"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-database"></i><span class="app-menu__label">Maintenance</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="/admin/maintenance/project-types">Project Classifications</a></li>
          <li><a class="treeview-item" href="/admin/maintenance/requirements">Project Requirements</a></li>
          <li><a class="treeview-item" href="/admin/maintenance/branches">Branches</a></li>
          <li><a class="treeview-item" href="/admin/maintenance/colleges">Colleges</a></li>
          <li><a class="treeview-item" href="/admin/maintenance/departments">Departments</a></li>
          <li><a class="treeview-item" href="/admin/maintenance/projects">Projects</a></li>
          <li><a class="treeview-item" href="/admin/maintenance/accounts">User Accounts</a></li>
        </ul>
      </li>
      <li class="treeview" id="li-transaction"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-exchange"></i><span class="app-menu__label">Transaction</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu" style="padding-left: 15px";>
          <li><a class="treeview-item" href="/admin/transaction/author/account-requests">Account Approbations</a></li>
          <li class="treeview" id="li-transaction"><a class="app-menu__item" href="#" data-toggle="treeview"><span class="app-menu__label">Copyright Application</span></a>     
          <ul class="treeview-menu" style="padding-left: 20px";>
          <li><a class="treeview-item" href="/admin/transaction/copyrights/pend-request">Pending</a></li>
          <li><a class="treeview-item" href="/admin/transaction/copyrights/to-submit">To submit</a></li>
          <li><a class="treeview-item" href="/admin/transaction/copyrights/on-process">On process</a></li>
          </ul>
          </li>    
          <li class="treeview" id="li-transaction"><a class="app-menu__item" href="#" data-toggle="treeview"><span class="app-menu__label">Patent Application</span></a>
          <ul class="treeview-menu" style="padding-left: 20px";>
          <li><a class="treeview-item" href="/admin/transaction/patents/pend-request">Pending</a></li>
          <li><a class="treeview-item" href="/admin/transaction/patents/to-submit">To submit</a></li>
          <li><a class="treeview-item" href="/admin/transaction/patents/on-process">On process</a></li>
          </ul>
          </li>
        </ul>
      </li>
      <li class="treeview" id="li-records"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Records</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="/admin/records/copyrights">Copyrights</a></li>
          <li><a class="treeview-item" href="/admin/records/patents">Patents</a></li>
          <li><a class="treeview-item" href="/admin/records/applicants">Authors</a></li>
        </ul>
      </li>
      <li class="treeview" id="li-query"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-history"></i><span class="app-menu__label">Query</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="#"><i class="icon fa fa-user-o"></i> Query Monitor</a></li>
        </ul>
      </li>
      <li class="treeview" id="li-report"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-bar-chart"></i><span class="app-menu__label">Reports</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li>
            <a class="treeview-item" href="#">Monthly Reports</a>
          </li>
          <li>
              <a class="treeview-item" href="{{ route('report.schedule-issues') }}">Schedule Issues</a>
          </li>
        </ul>
      </li>
      <li>
        <a class="app-menu__item {{Request::is('admin/dashboard') ? 'active':''}}" href="#">
          <i class="app-menu__icon fa fa-gears"></i>
          <span class="app-menu__label">System Utilities</span>
        </a>
      </li>
    </ul>
  </aside>