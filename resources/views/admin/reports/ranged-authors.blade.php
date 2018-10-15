@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-user"></i> Authors</h1>
  <p>Authors of every project requests</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Reports</li>
<li class="breadcrumb-item"><a href="{{ route('reports.author') }}">Authors</a></li>
@endsection

@section('content')
<div class="tile tile-body">
  <h4 align="right">Reports as of today, {{ Carbon\Carbon::now()->format('M d, Y') }}</h4>
  <h5>Date Range</h5>
  <div class="row">
      <div class="col-md-4">
      <label>Start Date</label>
        <input class="form-control" name="dateStart" id="demoDate" type="text" placeholder="Select Date" value="{{ $dateStart }}" readonly>
      </div>
      <div class="col-md-4">
        <label>End Date</label>
        <input class="form-control" name="dateEnd" id="demoDate2" type="text" placeholder="Select Date" value="{{ $dateEnd }}" readonly>    
      </div>
      <div class="col-md-2">
        <br>
        <a href="{{ route('reports.author') }}" class="btn btn-secondary">Back</a> 
      </div>
      <div class="col-md-2">
        <a role="button" target="_blank" href="/admin/reports/author/{{ date('Y-m-d', strtotime($dateStart)) }}/
                {{date('Y-m-d', strtotime($dateEnd))}}/authors_pdf" class="btn btn-primary float-right">
          <i class="fa fa-file"> Generate PDF</i>
        </a>
      </div>
  </div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <table class="table table-hover table-bordered" id="sampleTable">
            <thead>
              <tr>
                <th scope="col" class="text-center">Author Name</th>
                <th scope="col" class="text-center">Gender - Birthdate</th>
                <th scope="col" class="text-center">Type</th>
                <th scope="col" class="text-center">College - Department - Branch</th>
                <th scope="col" class="text-center">Copyrights</th>
                <th scope="col" class="text-center">Patents</th>
                <th scope="col" class="text-center">Date Registered</th>
              </tr>
            </thead>
            <tbody>
              @forelse($authors as $author)
              <tr>

                <td>
                  <a href="/admin/reports/author/{{ $author->id }}">
                    {{ $author->str_first_name }} {{ $author->str_middle_name }} {{ $author->str_last_name }}
                  </a>
                </td>
                <td>{{ $author->char_gender }} 
                  - {{ $author->dtm_birthdate }}
                </td>
                <td>{{ $author->char_applicant_type }}</td>
                <td>{{ $author->char_department_code }} 
                  - {{ $author->char_college_code }} 
                  - {{ $author->str_branch_name }}
                </td>
                <td>
                  <ul>
                    <li>{{ $author->str_project_title }}</li>
                  </ul>
                </td>
                <td>
                  <ul>
                    <li>{{ $author->str_patent_project_title }}</li>
                  </ul>
                </td>
                <td>{{ $author->created_at }}</td>
              </tr>
              @empty
                <div class="alert alert-warning">
                  There is no record.
                </div>
              @endforelse
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
    $('a[href="/admin/reports/author"]').addClass('active');
  });
</script>
@endsection