@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-user"></i> Applicants</h1>
  <p>Authors of every project requests</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Records</li>
<li class="breadcrumb-item"><a href="/admin/records/applicants">Applicants</a></li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-11">
        <span></span>
    </div>
    <div class="col-md-1">
      <a href="/copyright/create" type="button" class="btn btn-primary mb-2 float-right"><i class="fa fa-plus"></i>Add applicant</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th scope="col">Applicant ID</th>
                <th scope="col">Applicant Name</th>
                <th scope="col">College - Department - Branch</th>
                <th scope="col">Type of Applicant</th>
                <th scope="col" class="text-center">Details</th>
              </tr>
            </thead>
            <tbody>
              @forelse($applicants as $applicant)
              <tr>
                <th scope="row">{{ $applicant->int_id }}</th>
                <td>{{ $applicant->str_first_name }} {{ $applicant->str_middle_name }} {{ $applicant->str_last_name }}</td>
                <td>{{ $applicant->char_college_code }} - {{ $applicant->char_department_code }} - {{ $applicant->str_branch_name }}</td>
                <td>{{ $applicant->char_applicant_type }}</td>
                <td class="text-center"><a href="/admin/records/applicant/{{ $applicant->int_copyright_id }}" role="button" class="btn btn-info"><i class="fa fa-eye"></i>View</a></td>
              </tr>
              @empty  
                <div class="alert alert-warning">
                  There is no record yet.
                </div>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
@section('pg-specific-js')
<!-- Page specific javascripts-->
<!-- Data table plugin-->
<script src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script>$('#sampleTable').DataTable();</script>
<script>
  $(document).ready(function(){
    $('#li-records').addClass('is-expanded');
    $('a[href="/admin/records/applicants"]').addClass('active');
  });
</script>
@endsection
@endsection