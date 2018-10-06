@extends('admin.layouts.app')

@section('pg-title')
<h1>This college menn</h1>
  <p>A listing of projects for patent registration</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/patents/pend-request">Patents Pending Requests</a></li>
<li class="breadcrumb-item"><a href="/admin/transaction/patents/pend-request/id/college">CAFA</a></li>
@endsection

@section('content')
<div class="row">
  <div class="col-md-5">    
    <div class="bs-component">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-md-9">
              <h4>Patent Details</h4>
            </div>
            <div class="col-md-3">
              <button type="button" class="btn btn-primary mb-1 float-right" data-toggle="modal" data-target="#toApproveModalLong">
                <i class="fa fa-fw fa-lg fa-calendar"></i> Set Appointment
              </button>
            </div>
          </div>
        </div>
        <div class="card-body">
          
        </div>
        <div class="card-footer text-muted">
          <div class="row">
            <div class="col-md-6">
              <strong>
                Date added: ISIP PA
              </strong>   
            </div>
            <div class="col-md-6">
              Date ano?
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-7">
    <div class="bs-component">
    <div class="card">
      <div class="card-header pb-0">
      <div class="row">
        <div class="col-md-12">
          <h4>Uploaded Files</h4>
        </div> 
      </div>
      </div>
      <div class="card-body">
        <div class="bs-component">
          <div class="list-group">
            <div class="card card-body"></div>
        </div>
        </div>
      </div>
      <div class="card-footer text-muted">
      </div>
    </div>
    </div>
  </div>
</div>
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/bootstrap-datepicker.min.js') }}"></script>
<script>
$('#demoDate').datepicker({
  format: "yyyy-mm-dd",
  autoclose: true,
  todayHighlight: true
});
</script>
<script>
  $(document).ready(function(){
    $('#li-transaction').addClass('is-expanded');
    $('a[href="/admin/transaction/patents/pend-request"]').addClass('active');
  });
</script>
@endsection