@extends('admin.layouts.app')

@section('pg-specific-css')
<!-- Popup CSS -->
<link href="{{ asset('elite/css/magnific-popup.css') }}" rel="stylesheet">
<!-- Custom CSS -->
{{-- <link href="{{ asset('elite/css/style.min.css') }}" rel="stylesheet"> --}}
<!-- page css -->
<link href="{{ asset('elite/css/user-card.css') }}" rel="stylesheet">
@endsection

@section('pg-title')
<h1><i class="fa fa-user-o"></i> Account Request</h1>
  <p>Approbation for an author account</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/author/account-requests">Account Requests</a></li>
<li class="breadcrumb-item"><a href="/admin/transaction/author/account-request/{{ $accountRequest->int_id }}">{{ $accountRequest->str_first_name }} {{ $accountRequest->str_last_name }}</a></li>
@endsection

@section('content')
<div class="row">
  <div class="col-md-5">    
    <div class="bs-component">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row col-md-12">
              <h4>Requested Account Details</h4>
          </div>
        </div>
        <div class="card-body">
        	<label>Author's Name: <b>{{ $accountRequest->str_last_name }}, {{ $accountRequest->str_first_name }} {{ $accountRequest->str_middle_name }}</b></label>
          <label>Date Requested: <span class="text-dark"><b>{{ $accountRequest->created_at }}</b></span></label>
        </div>
        <div class="card-footer text-muted">
          <div class="row">
            <div class="col-lg-6 col-md-0 col-sm-0"><span></span></div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a class="btn btn-info" href="#" data-toggle="modal" data-target="#exampleModalCenter">
                  <i class="fa fa-lg fa-envelope"></i>Message
                </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              {!! Form::open(['id' => 'formApproveRequest', 'action' => ['Transaction\RegisterAuthorController@approvePutAccountRequest', $accountRequest->int_id], 'method' => 'POST']) !!}
                @csrf
                {{ Form::hidden('_method', 'PUT') }}
                <button type="button" id="demoSwal" class="btn btn-primary"><span class="fa fa-thumbs-up"></span> Approve</button>
              {!! Form::close() !!}
          {{--       <a class="btn btn-primary" href="/admin/transaction/author/account-request/{{ $accountRequest->int_id }}/approved"><i class="fa fa-lg fa-thumbs-up"></i>Approve</a> --}}
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
            <h4>Receipt</h4>
          </div> 
        </div>
        </div>
        <div class="card-body"> 
          <a target="_blank" href="/storage/images/receipts/{{ $accountRequest->applicant->receipt->str_receipt_image }}">
          <img  class="mb-10" style="display: block; margin-left: 30px;" src="/storage/images/receipts/{{ $accountRequest->applicant->receipt->str_receipt_image }}" alt="Receipt image" height="900" width="600">
          </a>
        </div>
        <div class="card-footer text-muted"><h5>Receipt Code: <span class="text-dark"><strong>{{ $accountRequest->applicant->receipt->char_receipt_code }}</strong></span></h5></div>
      </div>
    </div>
  </div>
</div>

<!-- Message author -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Send message to {{ $accountRequest->str_first_name }},</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(['action' => 'Transaction\RegisterAuthorController@messageAuthor', 'method' => 'POST']) !!}
      <div class="modal-body">
          <div class="form-group" hidden>
            <input type="text" class="form-control" name="numId" readonly value="{{ $accountRequest->int_id }}">
          </div>
          <div class="form-group" hidden>
            <label for="recipient-name" class="col-form-label"><b>Recipient Name:</b></label>
            <input type="text" class="form-control" id="recipient-name" name="txtFName" readonly value="{{ $accountRequest->str_first_name }}">
          </div>
          <div class="form-group">
            <label for="recipient-email" class="col-form-label"><b>Recipient:</b></label>
            <input type="text" class="form-control" id="recipient-email" name="txtEmail" readonly value="{{ $accountRequest->str_email }}">
          </div>
          <div class="form-group">
            <label class="col-form-label"><b>Message:</b></label>
            {{Form::textarea('txtAreaMessage', '', ['class' => 'form-control', 'placeholder' => 'Enter your message here', 'rows' => 7])}}
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane-o"></i> Send</button>
      </div>
      {!! Form::close() !!}

    </div>
  </div>
</div>
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
{{-- Sweet Alert --}}
<script src="{{ asset('vali/js/plugins/sweetalert.min.js') }}"></script>
<script>
$('#demoSwal').click(function(){
  swal({
    title: "Are you sure?",
    text: "Approve this account request.",
    type: "info",
    showCancelButton: true,
    confirmButtonText: "Yes, approve this request!",
    cancelButtonText: "Cancel",
    closeOnConfirm: false,
    closeOnCancel: false
  }, function(isConfirm) {
    if (isConfirm) {
      $('#formApproveRequest').submit();
      swal("Approved", "An author account request has been approved!", "success");
    } else {
      swal("Cancelled", "The action has been cancelled!", "error");
    }
  });
});
</script>
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
<!--Wave Effects -->
<script src="{{ asset('elite/js/waves.js') }}"></script>
<!--stickey kit -->
<script src="{{ asset('elite/js/sticky-kit.min.js') }}"></script>
<script src="{{ asset('elite/js/jquery.sparkline.min.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('elite/js/custom.min.js') }}"></script>
<!-- Magnific popup JavaScript -->
<script src="{{ asset('elite/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('elite/js/jquery.magnific-popup-init.js') }}"></script>
@endsection