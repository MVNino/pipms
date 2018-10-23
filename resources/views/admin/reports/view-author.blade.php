@extends('admin.layouts.app')

@section('pg-title')
@forelse($applicantCollection as $author)
<h1><i class="fa fa-user"></i> {{ $author->str_first_name }} {{ $author->str_last_name }}</h1>
  <p>Author of a project request</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Records</li>
<li class="breadcrumb-item"><a href="/admin/reports/author">Authors</a></li>
<li class="breadcrumb-item"><a href="/admin/reports/author/{{ $author->id }}">{{ $author->str_last_name }}</a></li>
@endsection
@section('content')
<div class="row">
  <div class="col-md-7">    
    <div class="bs-component">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-md-10">
              <h4>Author details</h4>
            </div>
            <div class="col-md-2">
            </div>
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title">{{-- {{ $applicant->user->str_first_name }} {{ $applicant->user->str_middle_name }} {{ $applicant->user->str_last_name }} --}}</h5>
          <h6 class="card-subtitle text-muted">A <a href="/admin/maintenance/department/{{ $author->applicant->int_department_id }}">{{ $author->applicant->department->str_department_name }}</a> {{ $author->applicant->char_applicant_type }}</h6>
        </div>
        <div class="card-body">
          <label class="card-text">
            <strong>College: </strong>
            <a href="/admin/maintenance/college/{{ $author->applicant->department->int_college_id }}">{{ $author->applicant->department->college->char_college_code }} - {{ $author->applicant->department->college->str_college_name }}
            </a>
          </label><br>
          <label class="card-text"><strong>Branch: </strong><a href="/admin/maintenance/branch/{{ $author->applicant->department->college->int_branch_id }}">{{ $author->applicant->department->college->branch->str_branch_name }}</a></label><br>
          <label class="card-text"><strong>Home Address: </strong>{{ $author->applicant->str_home_address }}</label><br>
          <label class="card-text"><strong>Email Address: </strong>{{ $author->email }}</label><br>
          <label class="card-text"><strong>Cellphone Number: </strong>{{ $author->applicant->bigInt_cellphone_number }}</label><br>
          <label class="card-text"><strong>Telephone Number: </strong>{{ $author->applicant->mdmInt_telephone_number }}</label><br>
          <label class="card-text"><b>Co-Authors:</b></label><br>
          <div class="row">
          @forelse($author->applicant->coAuthors as $coAuthor)
            <div class="col-md-4">
              <p>
                {{ $coAuthor->str_first_name }} {{ $coAuthor->str_middle_name }} {{ $coAuthor->str_last_name }}
              </p>
            </div>
          @empty
            <h6 class="text-muted">There is no other authors</h6>
          @endforelse
          </div>
        </div>
        <div class="card-footer text-muted">
          <div class="row">
            <div class="col-md-7">
              <strong>Date joined:</strong> {{ $author->created_at }}
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-2">
              {{-- <p><button type="button" class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-envelope"></i>Message</button></p> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-5">
    <div class="bs-component">
    <div class="card">
      <div class="card-header pb-0">
      <div class="row">
        <div class="col-md-12">
          <h4>Author's project request/s</h4>
        </div> 
      </div>
      </div>
      <div class="card-body">
        <div class="bs-component">
          <h4>Copyright</h4>
          <div class="list-group">
            @forelse($author->applicant->copyrights as $copyright)
              @if($copyright->char_copyright_status == 'pending')
              <a class="list-group-item list-group-item-action" href="/admin/transaction/copyright/pend-request/{{ $copyright->int_id }}">
                {{ $copyright->str_project_title }} ({{ $copyright->char_copyright_status }})
              </a>
              @elseif($copyright->char_copyright_status == 'to submit')
              <a class="list-group-item list-group-item-action" href="/admin/transaction/copyright/to-submit/{{ $copyright->int_id }}">
                {{ $copyright->str_project_title }} ({{ $copyright->char_copyright_status }})
              </a>
              @elseif($copyright->char_copyright_status == 'conflict')
              <a class="list-group-item list-group-item-action" href="#">
                {{ $copyright->str_project_title }} (Appointment Unattended)
              </a>
              @elseif($copyright->char_copyright_status == 'to submit/conflict')
              <a class="list-group-item list-group-item-action" href="#">
                {{ $copyright->str_project_title }} (Incomplete Requirements)
              </a>
              @elseif($copyright->char_copyright_status == 'on process')
              <a class="list-group-item list-group-item-action" href="/admin/transaction/copyright/on-process/{{ $copyright->int_id }}">
                {{ $copyright->str_project_title }} ({{ $copyright->char_copyright_status }})
              </a>
              @elseif($copyright->char_copyright_status == 'copyrighted')
              <a class="list-group-item list-group-item-action" href="/admin/reports/copyrighted/{{ $copyright->int_id }}">
                {{ $copyright->str_project_title }} ({{ $copyright->char_copyright_status }})
              </a>
              @endif
            @empty
              <div class="alert alert-warning">
                There is no record for copyright.
              </div>
            @endforelse
          </div>
        </div>
      </div>
      <div class="card-footer text-muted">Project requested for copyright and patent by <strong>{{ $author->str_first_name }} {{ $author->str_last_name }}</strong></p></div>
    </div>
    </div>
  </div>
  </div>
</div>

@empty
  @include('admin.includes.page-error')
@endforelse
@section('pg-specific-js')
<!-- Page specific javascripts-->
<!-- Data table plugin-->
<script src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script>$('#sampleTable').DataTable();</script>
<script>
  $(document).ready(function(){
    $('#li-reports').addClass('is-expanded');
    $('a[href="/admin/reports/author"]').addClass('active');
  });
</script>
@endsection
@endsection