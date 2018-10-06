@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-user"></i> Authors</h1>
  <p>Authors of every project requests</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Reports</li>
<li class="breadcrumb-item"><a href="{{ route('reports.authors') }}">Authors</a></li>
@endsection

@section('content')<div class="row">
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
 {{--              @forelse($applicants as $applicant)
                {{ $applicant->bigInt_cellphone_number }}
                {{ $applicant->department->int_id }}
              @empty
              @endforelse --}}
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
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
<script src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script>$('#sampleTable').DataTable();</script>
<script>
  $(document).ready(function(){
    $('#li-reports').addClass('is-expanded');
    $('a[href="/admin/reports/authors"]').addClass('active');
  });
</script>
@endsection