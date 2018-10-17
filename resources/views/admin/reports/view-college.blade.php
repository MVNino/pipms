@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-building"></i> College Reports</h1>
  <p>Copyright and Patent Statistics of {{ $college->char_college_code }}</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Reports</li>
<li class="breadcrumb-item"><a href="{{ route('reports.colleges') }}">Colleges</a></li>
<li class="breadcrumb-item"><a href="/admin/reports/college/{{ $college->int_id }}">{{ $college->char_college_code }}</a></li>
@endsection

@section('content')
<div class="row">
  <div class="col-md-4">
    <div class="tile">
      <div class="tile-body">
        this is right panel
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="tile">
      <div class="tile-body">
        this is left panel
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
<script type="text/javascript">
  $('#sampleTable').DataTable();
  $('#sampleTable2').DataTable();
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
    $('a[href="/admin/reports/colleges"]').addClass('active');
  });
</script>
@endsection