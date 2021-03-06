@extends('admin.layouts.app')

@section('pg-title')
<h1>On Process Copyright Requests</h1>
  <p>A listing of projects which are on its processs for copyright registration</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/copyrights/on-process">On Process Copyright Requests</a></li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th scope="col">Project Title</th>
                <th scope="col">Type</th>
                <th scope="col">Date Complied</th>
                <th scope="col">Applicant Name - Type</th>
                <th scope="col">Department - College - Branch</th>
                <th scope="col" class="text-center">Details</th>
              </tr>
            </thead>
            <tbody>
              @forelse($copyrights as $copyright)
              <tr>
              <th scope="row">{{ $copyright->str_project_title }}</th>
              <td scope="row">{{ $copyright->projectType->char_project_type }}</td>
              <td scope="row">{{ $copyright->dtm_on_process }}</td>
              <td scope="row">{{ $copyright->applicant->user->str_first_name }} {{ $copyright->applicant->user->str_middle_name }} {{ $copyright->applicant->user->str_last_name }} - {{ $copyright->applicant->char_applicant_type }}</td>
              <td scope="row">{{ $copyright->applicant->department->char_department_code }} - {{ $copyright->applicant->department->college->char_college_code }} - {{ $copyright->applicant->department->college->branch->str_branch_name }}</td>
              <td scope="row" class="text-center">
                <a href="/admin/transaction/copyright/on-process/{{ $copyright->int_id }}" role="button" class="btn btn-info">
                  <span class="fa fa-eye"></span> View
                </a>
              </td>
              </tr>
              @empty  
                <div class="alert alert-warning">
                  There is no record yet.
                </div>
              @endforelse
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
<script>
  $(document).ready(function(){
    $('#li-transaction').addClass('is-expanded');
    $('a[href="/admin/transaction/copyrights/on-process"]').addClass('active');
  });
</script>
@endsection