<!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{ asset('storage/images/profile/default_user_image.png') }}" alt="User Image" style="height: 48px; width: 48px;">
      <div>
        <p class="app-sidebar__user-name">Pyke Bio</p>
        <p class="app-sidebar__user-designation">Author</p>
      </div>
    </div>
    <ul class="app-menu">
      <li><a class="app-menu__item {{Request::is('admin/dashboard') ? 'active':''}}" href="/admin/dashboard"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
      <li><a class="app-menu__item {{Request::is('admin/mails') ? 'active':''}}" href="/admin/mails"><i class="app-menu__icon fa fa-envelope"></i><span class="app-menu__label">Mails</span></a></li>
      <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">My Account</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="/admin/user-profile">My Profile</a></li>
        </ul>
      </li>
      <li><a class="app-menu__item {{Request::is('admin/mails') ? 'active':''}}" href="/admin/mails"><i class="app-menu__icon fa fa-copyright"></i><span class="app-menu__label">Projects</span></a></li>

      <li class="treeview" id="li-records"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">My Applications</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="#">Copyrights</a></li>
          <li><a class="treeview-item" href="#">Patents</a></li>
        </ul>
      </li>

    </ul>
  </aside>