<!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="/storage/images/profile/{{ auth()->user()->str_user_image_code }}" alt="User Image" style="height: 48px; width: 48px;">
      <div>
        <p class="app-sidebar__user-name">{{ Auth::user()->str_first_name }} {{ Auth::user()->str_last_name }}</p>
        <p class="app-sidebar__user-designation">Author</p>
      </div>
    </div>
    <ul class="app-menu">
      <li><a class="app-menu__item {{Request::is('author/{id}/dashboard') ? 'active':''}}" href="/author/{{ auth()->user()->id }}/dashboard"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
      <li><a class="app-menu__item {{Request::is('author/messages') ? 'active':''}}" href="/author/messages"><i class="app-menu__icon fa fa-envelope"></i><span class="app-menu__label">Messages</span></a></li>
      <li><a class="app-menu__item {{Request::is('author/my-account') ? 'active':''}}" href="/author/my-account"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">My Account</span></a></li>
      <li class="treeview" id="li-apply"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Apply project</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a class="treeview-item" href="/author/apply-project">Copyright</a></li>
          <li><a class="treeview-item" href="/author/apply-patent-project">Patent</a></li>
        </ul>
      </li>
      <li><a class="app-menu__item {{Request::is('author/my-projects') ? 'active':''}}" href="/author/my-projects"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">My Projects</span></a></li>
    </ul>
  </aside>