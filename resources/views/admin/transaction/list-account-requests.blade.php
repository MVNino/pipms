@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-copyright"></i> Account Requests</h1>
  <p>A listing of requests for author account registration</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/author/account-requests">Author Account Requests</a></li>
@endsection
@section('content')
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLongTitle">Check Receipt</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div style="height: 250px; position: relative;">
            @foreach($authAccoRequests as $accountRequest)
              <img class="align-self-center mr-3" alt="Branch profile image" style="position: absolute; left: 50px;" 
              src="/storage/images/receipts/{{ $accountRequest->applicant->receipt->str_receipt_image }}">
            @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

<div class ="tile">
  <div class="tile-body">
    <table class="table table-hover table-bordered" id="sampleTable">
      <thead>
        <th scope="col">Author Name</th>
        <th scope="col">Gender - Type</th>
        <th scope="col">Receipt Code</th>
        <th scope="col">Date requested</th>
        <th class="text-center">Actions</th>
      </thead>
      <tbody>
        <div class="container">
          @forelse($authAccoRequests as $accountRequest)
          <tr>
            <td>
              {{ $accountRequest->str_first_name }} {{ $accountRequest->str_middle_name }} 
                {{ $accountRequest->str_last_name }}
            </td>
            <td>@if($accountRequest->applicant->char_gender == 'M')
                Male
              @else
                Female
              @endif 
              - {{ $accountRequest->applicant->char_applicant_type }}
            </td>
            <td>{{ $accountRequest->applicant->receipt->char_receipt_code }}</td>
            <td>{{ $accountRequest->created_at }}</td>
            <td class="text-center">
              <a href="/admin/transaction/author/account-request/{{ $accountRequest->int_id }}" role="button" class="btn btn-info">
                <span class="fa fa-eye"></span>
              </a>
              <a class="btn btn-primary" href="/admin/transaction/author/account-request/{{ $accountRequest->int_id }}/approved">
                <i class="fa fa-lg fa-thumbs-up"></i>
              </a>
              {{-- {!! Form::open(['id' => 'formApproveRequest', 'action' => ['Transaction\RegisterAuthorController@approvePutAccountRequest', $accountRequest->int_id], 'method' => 'POST']) !!}
                @csrf
                {{ Form::hidden('_method', 'PUT') }}
                
                <button type="button" id="demoSwal" class="btn btn-primary"><span class="fa fa-thumbs-up"></span></button>
              {!! Form::close() !!} --}}
            </td>
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
    confirmButtonText: "Yes, I am!",
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
<!-- Data table plugin-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
<script>
  $(document).ready(function(){
    $('#li-transaction').addClass('is-expanded');
    $('a[href="/admin/transaction/author/account-requests"]').addClass('active');
  });
</script>
@endsection