@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-copyright"></i> Copyrights</h1>
  <p>Form of intellectual property protection</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Records</li>
<li class="breadcrumb-item"><a href="/admin/records/copyrights">Copyrights</a></li>
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
                <th scope="col">Project Title</th>
                <th scope="col">Type</th>
                <th scope="col">Status</th>
                <th scope="col">Date requested</th>
                <th scope="col">Applicant Name - Type</th>
                <th scope="col">College - Department - Branch</th>
                <th scope="col" class="text-center">Details</th>
              </tr>
            </thead>
            <tbody>
              @forelse($copyrights as $copyright)
              <tr>
              <th scope="row">{{ $copyright->str_project_title }}</th>
              <td scope="row">{{ $copyright->char_project_type }}</td>
              <td scope="row">{{ $copyright->char_copyright_status }}</td>
              <td scope="row">{{ $copyright->created_at }}</td>
              <td scope="row">{{ $copyright->str_first_name }} {{ $copyright->str_middle_name }} {{ $copyright->str_last_name }} - {{ $copyright->char_applicant_type }}</td>
              <td scope="row">{{ $copyright->char_college_code }} - {{ $copyright->char_department_code }} - {{ $copyright->str_branch_name }}</td>
              <td scope="row" class="text-center"><a href="/admin/records/copyright/{{ $copyright->int_id }}" role="button" class="btn btn-info"><span class="fa fa-eye"></span> View</a></td>
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
<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
<script>
  $(document).ready(function(){
    $('#li-records').addClass('is-expanded');
    $('a[href="/admin/records/copyrights"]').addClass('active');
  });
</script>
@endsection