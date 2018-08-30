@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-copyright"></i> Author Account Requests</h1>
  <p>A listing of requests for author account registration</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/author/account-requests">Author Account Requests</a></li>
@endsection
@section('content')
<!-- Add branch modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLongTitle">Check Receipt</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          @foreach($authAccoRequests as $accountRequest)
          <a target="_blank" href="/storage/images/receipts/{{ $accountRequest->applicant->receipt->str_receipt_image }}" style="position: absolute; bottom: -5%; left: 38%;">
              <img class="align-self-center mr-3" style="width:125px; height:125px;" alt="Branch profile image" src="/storage/images/receipts/{{ $accountRequest->applicant->receipt->str_receipt_image }}">
          </a>
          @endforeach
      </div>
    </div>
  </div>
</div> <!-- /Add branch modal -->
<div class ="card" style="padding: 3px;"> 
    <table class="table table-hover">
      <thead>
        <th>Author Name</th>
        <th>Gender - Type</th>
        <th>Receipt Code</th>
        <th>Date requested</th>
        <th class="text-center">Actions</th>
      </thead>
      <tbody>
        <div class="container">
          @forelse($authAccoRequests as $accountRequest)
      <tr>
        <td><b>{{ $accountRequest->str_first_name }} {{ $accountRequest->str_middle_name }} {{ $accountRequest->str_last_name }}</b></td>
        <td class="mail-subject">@if($accountRequest->applicant->char_gender == 'M')
            Male
          @else
            Female
          @endif - {{ $accountRequest->applicant->char_applicant_type }}</td>
          <td>{{ $accountRequest->applicant->receipt->char_receipt_code }}</td>
        <td>{{ $accountRequest->created_at }}</td>
        <td class="text-center"><a target="_blank" href="/storage/images/receipts/{{ $accountRequest->applicant->receipt->str_receipt_image }}" role="button" class="btn btn-info"><span class="fa fa-eye"></span></a>
        <a href="/admin/transaction/author/account-request/{{ $accountRequest->int_id }}/approved" role="button" class="btn btn-primary"><span class="fa fa-thumbs-up"></span></a></td>
      </tr>
      @empty
        <div class="alert alert-warning">
          There is no record yet.
        </div>
      @endforelse    
        </div>
    </tbody>
  </table>
</div>
<div class="text-right"><span class="text-muted mr-2">Showing 1-15 out of 60</span>
  <div class="btn-group">
    <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-chevron-left"></i></button>
    <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-chevron-right"></i></button>
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