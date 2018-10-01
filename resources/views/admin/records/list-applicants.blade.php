@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-user"></i> Authors</h1>
  <p>Authors of every project requests</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Records</li>
<li class="breadcrumb-item"><a href="/admin/records/applicants">Authors</a></li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th scope="col">Author Name</th>
                <th scope="col">College - Department - Branch</th>
                <th scope="col">Type of Author</th>
                <th scope="col" class="text-center">Details</th>
              </tr>
            </thead>
            <tbody>
              {{-- @forelse($applicants as $applicant)
              <tr>
                <th>{{ $applicant->user->str_first_name }} {{ $applicant->user->str_middle_name }} {{ $applicant->user->str_last_name }}</th>
                <td>{{ $applicant->department->college->char_college_code }} - {{ $applicant->department->char_department_code }} - {{ $applicant->department->college->branch->str_branch_name }}</td>
                <td>{{ $applicant->char_applicant_type }}</td>
                <td class="text-center"><a href="/admin/records/applicant/{{ $applicant->int_id }}" role="button" class="btn btn-info"><i class="fa fa-eye"></i>View</a></td>
              </tr>
              @empty  
                <div class="alert alert-warning">
                  There is no record yet.
                </div>
              @endforelse --}}
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