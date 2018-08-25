@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-building"></i> Intellectual Property Rights</h1>
  <p>A listing of Intellectual Property Protections</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Maintenance</li>
<li class="breadcrumb-item"><a href="/admin/maintenance/ipr">IPR</a></li>
@endsection

@section('content')

@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
<script>
  $(document).ready(function(){
    $('#li-maintenance').addClass('is-expanded');
    $('a[href="/admin/maintenance/ipr"]').addClass('active');
  });
</script>
@endsection