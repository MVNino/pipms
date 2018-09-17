
    <div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="/storage/images/profile/{{ Auth::user()->str_user_image_code }}">
          </div>
        </a>
        <a href="#" class="simple-text logo-normal">
          {{ Auth::user()->str_first_name }} {{ Auth::user()->str_last_name }}<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<small class="text-danger">Author</small>
        </a>
          <!-- <div class="logo-image-big">
            <img src="/storage/images/profile/{{Auth::user()->str_user_image_code}}">
          </div> -->
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
          <li id="li-information" class="{{Request::is('author/guide') ? 'active':''}}">
            <a href="{{ route('author.guide') }}">
              <i class="nc-icon nc-alert-circle-i"></i>
              <p>My Guide</p>
            </a>
          </li>
          <li class="active-pro">
            <a class="text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="nc-icon nc-user-run text-danger"></i>
              <p>{{ __('Logout') }}</p>
            </a>
             <form id="logout-form" action="{{ route('logout') }}" 
              method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </div>
    </div>