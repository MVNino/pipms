@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-building"></i> Copyright Request</h1>
  <p>Request project for copyright</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/copyright-request">Copyright Request</a></li>
@endsection
@section('content')
<div id="app">
<copyright-request></copyright-request>
</div>
@section('pg-specific-js')
<!-- Page specific javascripts-->
<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
<script>
  $(document).ready(function(){
    $('#li-transaction').addClass('is-expanded');
    $('a[href="/admin/transaction/copyright-request1"]').addClass('active');
  });
</script>
@endsection
@endsection