@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-certificate"></i> Patent</h1>
  <p>An exclusive right granted for an invention</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Records</li>
<li class="breadcrumb-item"><a href="/admin/records/patents">Patents</a></li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-11">
        <span></span>
    </div>
    <div class="col-md-1">
      <!-- Button trigger modal -->
      <a href="/copyright/create" type="button" class="btn btn-primary mb-2 float-right"><i class="fa fa-plus"></i> Request for copyright</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th scope="col">Patent ID</th>
                <th scope="col">Patent Project Title</th>
                <th scope="col">Type</th>
                <th scope="col">Status</th>
                <th scope="col">Date requested</th>
                <th scope="col">Applicant Name - Type</th>
                <th scope="col">College - Department - Branch</th>
                <th scope="col" class="text-center">Details</th>
              </tr>
            </thead>
            <tbody>
              @forelse($patents as $patent)
              <tr>
              <td scope="row">{{ $patent->int_id }}</td>
              <td scope="row">{{ $patent->str_patent_project_title }}</td>
              <td scope="row">{{ $patent->char_patent_project_type }}</td>
              <td scope="row">{{ $patent->char_patent_status }}</td>
              <td scope="row">{{ $patent->created_at }}</td>
              <td scope="row">{{ $patent->str_first_name }} {{ $patent->str_middle_name }} {{ $patent->str_last_name }} - {{ $patent->char_applicant_type }}</td>
              <td scope="row">{{ $patent->char_college_code }} - {{ $patent->char_department_code }} - {{ $patent->str_branch_name }}</td>
              <td scope="row" class="text-center"><a href="/admin/records/patent/{{ $patent->int_id }}" role="button" class="btn btn-info"><span class="fa fa-eye"></span> View</a></td>
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
@section('pg-specific-js')
<!-- Page specific javascripts-->
<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
<script>
  $(document).ready(function(){
    $('#li-records').addClass('is-expanded');
    $('a[href="/admin/records/patents"]').addClass('active');
  });
</script>
@endsection
@endsection