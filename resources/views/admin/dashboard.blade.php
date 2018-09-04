@if(Auth::user()->isAdmin == 1)
    @include('admin.dashboard-content')
  @else
    @include('author-pd.dashboard')
@endif

