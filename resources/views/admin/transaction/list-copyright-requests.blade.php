@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-building"></i> Copyright Requests</h1>
  <p>A listing of PUP branches</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/maintenance/branches">Copyright Requests</a></li>
@endsection

@section('content')
    @include('admin.includes.messages')
  <div class="row user">
    <div class="col-md-2">
      <div class="tile p-0">
        <ul class="nav flex-column nav-tabs user-tabs">
          <li class="nav-item"><a class="nav-link active" href="#copyright-pending" data-toggle="tab">Pending</a></li>
          <li class="nav-item"><a class="nav-link" href="#copyright-to-submit" data-toggle="tab">To Submit</a></li>
          <li class="nav-item"><a class="nav-link" href="#copyright-on-process" data-toggle="tab">On Process</a></li>
        </ul>
      </div>
    </div>
    <div class="col-md-10">
      <div class="tab-content">
        @forelse($copyrights as $copyright)
        <div class="tab-pane active" id="copyright-pending">
          <div class="timeline-post">
            <div class="post-media"><a href="#"><img src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg"></a>
              <div class="content">
                <h5><a href="#"></a>{{ $copyright->applicant->user->str_first_name }} {{ $copyright->applicant->user->str_last_name }} of {{ $copyright->applicant->department->char_department_code }} - {{ $copyright->applicant->department->college->char_college_code }} - {{ $copyright->applicant->department->college->branch->str_branch_name }}</h5>
                <p class="text-muted"><small>Date requested: {{ $copyright->created_at }}</small></p>
              </div>
            </div>
            <div class="post-content">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,  quis tion ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <ul class="post-utility">
              <li class="likes"><a href="#"><i class="fa fa-fw fa-lg fa-thumbs-o-up"></i>Like</a></li>
              <li class="shares"><a href="#"><i class="fa fa-fw fa-lg fa-share"></i>Share</a></li>
              <li class="comments"><i class="fa fa-fw fa-lg fa-eye"></i> View more</li>
            </ul>
          </div>
        </div>
        @empty
        @endforelse
        <div class="tab-pane fade" id="copyright-to-submit">hehe</div>
        <div class="tab-pane fade" id="copyright-on-process">wawa</div>
    </div>
  </div>
</div>
@endsection