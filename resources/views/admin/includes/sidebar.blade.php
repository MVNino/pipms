<!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user">
      <a href="/admin/user-profile">
      <img class="app-sidebar__user-avatar" src="/storage/images/profile/{{ auth()->user()->str_user_image_code }}" alt="User Image" style="height: 48px; width: 48px;">
      </a>
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
      <li>
        <a class="app-menu__item {{Request::is('admin/user-profile') ? 'active':''}}" href="/admin/user-profile">
          <i class="app-menu__icon fa fa-user"></i>
          <span class="app-menu__label">My Account</span>
        </a>
      </li>
      <li>
        <a class="app-menu__item {{Request::is('admin/schedule-today') ? 'active':''}}" href="{{ route('admin.today') }}">
          <i class="app-menu__icon fa fa-calendar"></i>
          <span class="app-menu__label">Schedule Today</span>
        </a>
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
          <li><a class="treeview-item" href="/admin/transaction/copyrights/to-submit">To Submit</a></li>
          <li><a class="treeview-item" href="/admin/transaction/copyrights/on-process">On Process</a></li>
          </ul>
          </li>    
          <li class="treeview" id="li-transaction"><a class="app-menu__item" href="#" data-toggle="treeview"><span class="app-menu__label">Patent Application</span></a>
          <ul class="treeview-menu" style="padding-left: 20px";>
          <li><a class="treeview-item" href="/admin/transaction/patents/pend-request">Pending</a></li>
          <li><a class="treeview-item" href="/admin/transaction/patents/to-submit">To Submit</a></li>
          <li><a class="treeview-item" href="/admin/transaction/patents/on-process">On Process</a></li>
          </ul>
          </li>
        </ul>
      </li>
      <li>
        <a class="app-menu__item {{Request::is('admin/queries') ? 'active':''}}" href="{{ route('queries') }}">
          <i class="app-menu__icon fa fa-history"></i>
          <span class="app-menu__label">Queries</span>
        </a>
      </li>
      <li class="treeview" id="li-reports"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-bar-chart"></i><span class="app-menu__label">Reports</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li>
            <a class="treeview-item" href="/admin/reports/branches">
              Branch
            </a>
          </li>
          <li>
            <a class="treeview-item" href="/admin/reports/colleges">
              College
            </a>
          </li>
          <li>
            <a class="treeview-item" href="/admin/reports/departments">
              Department
            </a>
          </li>
          <li>
            <a class="treeview-item" href="/admin/reports/copyright">
              Copyright
            </a>
          </li>
          <li>
            <a class="treeview-item" href="/admin/reports/patent">
              Patent
            </a>
          </li>
          <li>
            <a class="treeview-item" href="/admin/reports/author">
              Author
            </a>
          </li>
          <li>
            <a class="treeview-item" href="/admin/reports/application-issues">
              Application Issue
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </aside>