@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-building"></i> {{ $branch->str_branch_name }} Report</h1>
  <p>Copyright and Patent Statistics as of today, 
    <span class="text-primary">{{ Carbon\Carbon::now()->format('F d') }}</span> 
  </p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Reports</li>
<li class="breadcrumb-item"><a href="{{ route('reports.branches') }}">Branches</a></li>
<li class="breadcrumb-item">
  <a href="/admin/reports/branch/{{ $branch->int_id }}">
    {{ $branch->str_branch_name }}
  </a>
</li>
@endsection

@section('content')
  <h3>Reports for {{ $branch->str_branch_name }}</h3>
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
  $('#sampleTable').DataTable();
  $('#sampleTable3').DataTable();
</script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/bootstrap-datepicker.min.js') }}"></script>
<script>
$('#demoDate').datepicker({
  format: "yyyy-mm-dd",
  autoclose: true,
  todayHighlight: true
});
$('#demoDate2').datepicker({
  format: "yyyy-mm-dd",
  autoclose: true,
  todayHighlight: true
});
</script>
<script>
  $(document).ready(function(){
    $('#li-reports').addClass('is-expanded');
    $('a[href="/admin/reports/branches"]').addClass('active');
  });
</script>
@endsection