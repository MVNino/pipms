
    <div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="/storage/images/profile/lonlon.jpg">
          </div>
        </a>
        <a href="#" class="simple-text logo-normal">
          Marlon Niño<br>&nbsp&nbsp&nbsp&nbsp&nbsp<small class="text-danger">Author</small>
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li id="li-dashboard" class="{{Request::is('author/dashboard') ? 'active':''}}">
            <a href="{{ route('author.dashboard') }}">
              <i class="nc-icon nc-chart-bar-32"></i>
              <p>My Dashboard</p>
            </a>
          </li>
          <li id="li-mails" class="{{Request::is('author/mails') ? 'active':''}}">
            <a href="{{ route('author.mails') }}">
              <i class="nc-icon nc-email-85"></i>
              <p>My Mails</p>
            </a>
          </li>
          <li id="li-profile" class="{{Request::is('author/user-profile') ? 'active':''}}">
            <a href="{{ route('author.profile') }}">
              <i class="nc-icon nc-single-02"></i>
              <p>User Profile</p>
            </a>
          </li>
          <li id="li-apply-project" class="{{Request::is('author/ipr-application') ? 'active':''}}">
            <a href="{{ route('author.ipr-application') }}">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>Apply Project</p>
            </a>
          </li>
          <li id="li-my-projects" class="{{Request::is('author/my-projects') ? 'active':''}}">
            <a href="{{ route('author.my-projects') }}">
              <i class="nc-icon nc-caps-small"></i>
              <p>My Projects</p>
            </a>
          </li>
          <li class="active-pro">
            <a href="/">
              <i class="nc-icon nc-user-run"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </div>
    </div>