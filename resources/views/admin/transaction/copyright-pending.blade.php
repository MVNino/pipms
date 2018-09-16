@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-copyright"></i> Pending Requests for Copyright</h1>
  <p>A listing of projects which requests for copyright registration</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/copyrights/pend-request">Copyright Pending Requests</a></li>
@endsection
@section('content')
<div class ="card" style="padding: 5px;">
    <table class="table table-hover">
      <thead>
        <th>Project/Work Title</th>
        <th>Applicant - Type - Department - College - Branch</th>
        <th>Date requested</th>
        <th class="text-center">View more details</th>
      </thead>
      <tbody>
      @forelse($copyrights as $copyright)
      <tr>
        <td><b>{{ $copyright->str_project_title }}</b></td>
        <td class="mail-subject"><b>{{ $copyright->applicant->user->str_first_name }} {{ $copyright->applicant->user->str_last_name }}</b> - <b>{{ $copyright->applicant->char_applicant_type }}</b> {{ $copyright->applicant->department->char_department_code }} - {{ $copyright->applicant->department->college->char_college_code }} - {{ $copyright->applicant->department->college->branch->str_branch_name }}</td>
        <td>{{ $copyright->created_at }}</td>
        <td class="text-center"><a href="/admin/transaction/copyright/pend-request/{{ $copyright->int_id }}" role="button" class="btn btn-info"><span class="fa fa-eye"></span>View</a></td>
      </tr>
      @empty
        <div class="alert alert-warning">
          There is no record yet.
        </div>
      @endforelse
    </tbody>
  </table>
</div>
<div class="text-right"><span class="text-muted mr-2">Showing 1-15 out of 60</span>
  <div class="btn-group">
    <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-chevron-left"></i></button>
    <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-chevron-right"></i></button>
  </div>
</div>
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
<script>
  $(document).ready(function(){
    $('#li-transaction').addClass('is-expanded');
    $('a[href="/admin/transaction/copyrights/pend-request"]').addClass('active');
  });
</script>
<script>
  $(document).ready(function(){
    $('#li-copyright').addClass('');
    $('a[href="/admin/transaction/copyrights/pend-request"]').addClass('active');
  });
</script>


@endsection