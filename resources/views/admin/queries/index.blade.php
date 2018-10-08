@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-history"></i> Queries</h1>
  <p>System Queries</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Queries</li>
@endsection
@section('content')
<div class="tile">
  <div class="tile-body">
    Queries here!
  </div>
</div>
@endsection

@section('pg-specific-js')
<script>
  $(document).ready(function(){
    $('#li-query').addClass('is-expanded');
    $('a[href="/admin/queries/index"]').addClass('active');
  });
</script>
@endsection