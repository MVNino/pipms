@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-user-o"></i> {{ $faculty->str_first_name }} {{ $faculty->str_last_name }}</h1>
  <p>In charge of every department</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Maintenance</li>
<li class="breadcrumb-item"><a href="/admin/maintenance/faculties">Faculties</a></li>
<li class="breadcrumb-item"><a href="/admin/maintenance/faculty/{{ $faculty->int_id }}">{{ $faculty->str_first_name }} {{ $faculty->str_last_name }}</a></li>
@endsection
@section('content')

@section('pg-specific-js')
<!-- Page specific javascripts-->
<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
<script>
  $(document).ready(function(){
    $('#li-maintenance').addClass('is-expanded');
    $('a[href="/admin/maintenance/faculties"]').addClass('active');
  });
</script>
@endsection
@endsection