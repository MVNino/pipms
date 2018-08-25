@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-copyright"></i> Initial Requests for Copyright Application</h1>
  <p>A listing of requests for copyright application</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/copyrights/">Copyright Initial Requests</a></li>
@endsection
@section('content')
<div class ="card">
    <table class="table table-hover">
      <thead>
        <th>Applicant - Type - Department - College - Branch</th>
        <th>Date requested</th>
        <th class="text-center">Actions</th>
      </thead>
      <tbody>
      @forelse($applicants as $applicant)
      <tr>
        <td class="mail-subject"><b>{{ $applicant->str_first_name }} {{ $applicant->str_last_name }}</b> - <b>{{ $applicant->char_applicant_type }}</b> {{ $applicant->department->char_department_code }} - {{ $applicant->department->college->char_college_code }} - {{ $applicant->department->college->branch->str_branch_name }}</td>
        <td>{{ $applicant->receipt->created_at }}</td>
        <td class="text-center"><a href="/admin/transaction/copyright/initial-request/{{ $applicant->int_id }}" role="button" class="btn btn-info"><span class="fa fa-eye"></span></a><a role="button" class="btn btn-success" href="/admin/transaction/copyright/initial-request/{{ $applicant->int_id }}/approve"><span class="fa fa-thumbs-up"></span></a></td>
      </tr>
      @empty

      @endforelse
    </tbody>
  </table>
</div>
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
<script>
  $(document).ready(function(){
    $('#li-transaction').addClass('is-expanded');
    $('a[href="/admin/transaction/copyrights/initial-request"]').addClass('active');
  });
</script>
@endsection