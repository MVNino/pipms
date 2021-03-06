@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-certificate"></i> On Process Patent Requests</h1>
  <p>A listing of projects which are on its processs for patent registration</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/patents/on-process">Patents on process</a></li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th scope="col">Patent Project Title</th>
                <th scope="col">Type</th>
                <th scope="col">Status</th>
                <th scope="col">Date Complied</th>
                <th scope="col">Applicant Name - Type</th>
                <th scope="col">College - Department - Branch</th>
                <th scope="col" class="text-center">Details</th>
              </tr>
            </thead>
            <tbody>
              @forelse($patents as $patent)
              <tr>
              <th scope="row">{{ $patent->str_patent_project_title }}</th>
              <td scope="row">{{ $patent->projectType->char_project_type }}</td>
              <td scope="row">{{ $patent->char_patent_status }}</td>
              <td scope="row">{{ $patent->dtm_on_process }}</td>
              <td scope="row">{{ $patent->copyright->applicant->user->str_first_name }} {{ $patent->copyright->applicant->user->str_middle_name }} {{ $patent->copyright->applicant->user->str_last_name }} - {{ $patent->copyright->applicant->char_applicant_type }}</td>
              <td scope="row">{{ $patent->copyright->applicant->department->char_department_code }} - {{ $patent->copyright->applicant->department->college->char_college_code }} - {{ $patent->copyright->applicant->department->college->branch->str_branch_name }}</td>
              <td scope="row" class="text-center">
                <a href="/admin/transaction/patent/on-process/{{ $patent->int_id }}" role="button" class="btn btn-info">
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
    $('a[href="/admin/transaction/patents/on-process"]').addClass('active');
  });
</script>
@endsection