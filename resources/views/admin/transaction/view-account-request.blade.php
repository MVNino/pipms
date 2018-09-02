@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-copyright"></i> Account Requests</h1>
  <p>A listing of requests for author account registration</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/author/account-requests">Account Requests</a></li>
<li class="breadcrumb-item"><a href="/admin/transaction/author/account-request/{{ $accountRequest->int_id }}">{{ $accountRequest->str_first_name }} {{ $accountRequest->str_last_name }}</a></li>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">    
    <div class="bs-component">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-md-12">
              <h4>Requested Account Details</h4>
            </div> 
          </div>
        </div>
        <div class="card-body">
          <label>Author's Name: <b>{{ $accountRequest->str_last_name }}, {{ $accountRequest->str_first_name }} {{ $accountRequest->str_middle_name }}</b></label>
        </div>
        <div class="card-footer text-muted">Date Requested: <span class="text-dark"><b>{{ $accountRequest->created_at }}</b></span></div>
      </div>
    </div>
  </div>
</div>



<div class="row">
  <div class="col-md-7">
    <div class="bs-component">
      <div class="card">
        <div class="card-header pb-0">
        <div class="row">
          <div class="col-md-12">
            <h4>Receipt</h4>
          </div> 
        </div>
        </div>
        <div class="card-body">
            
              <a target="_blank" href="/storage/images/receipts/{{ $accountRequest->applicant->receipt->str_receipt_image }}">
              <img  class="mb-10" style="display: block; margin-left: 30px;" src="/storage/images/receipts/{{ $accountRequest->applicant->receipt->str_receipt_image }}" alt="Receipt image">
              </a>

        </div>
        <div class="card-footer text-muted"><h5>Receipt Code: <span class="text-dark"><strong>{{ $accountRequest->applicant->receipt->char_receipt_code }}</strong></span></h5></div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
<script>
  $(document).ready(function(){
    $('#li-transaction').addClass('is-expanded');
    $('a[href="/admin/transaction/copyrights/pend-request"]').addClass('active');
  });
</script>
<script>
  $(document).ready(function(){
    $('#li-copyright').addClass('');
    $('a[href="/admin/transaction/author/account-requests"]').addClass('active');
  });
</script>
@endsection