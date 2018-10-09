@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-envelope"></i> Mails</h1>
	<p>Communicate with the faculties and clients</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item"><a href="/admin/mails">Mails</a></li>
 @endsection
@section('content')
<div class="row">
	<div class="col-md-3"><a class="mb-2 btn btn-primary btn-block" data-toggle="modal" data-target="#composeMails">Compose Mail</a>
	  <div class="tile p-0">
	    <h4 class="tile-title folder-head">Folders</h4>
	    <div class="tile-body">
	      <ul class="nav nav-pills flex-column mail-nav">
	        <li class="nav-item active"><a class="nav-link" href="/admin/mails"><i class="fa fa-inbox fa-fw"></i> Inbox</a></li>
	        <li class="nav-item"><a class="nav-link" href="/admin/sent"><i class="fa fa-envelope-o fa-fw"></i> Sent</a></li>
	        <li class="nav-item"><a class="nav-link" href="/admin/trash"><i class="fa fa-trash-o fa-fw"></i> Trash</a></li>
	      </ul>
	    </div>
	  </div>
	</div>
	<div class="col-md-9">
	  <div class="tile">
	    
	    <div class="table-responsive mailbox-messages">
	      	@if($mails->receiver_id == 1)
	       	<div class="card-body">
                  <h5 class="card-title"><b>From: </b>{{ $mails->sender_name }}</h5>
            </div>
            @else
            <div class="card-body">
                  <h5 class="card-title"><b>To: </b>{{ $mails->sender_name }}</h5>
            </div>
            @endif
            <div class="card-body">
            	  <h5 class="card-title"><b>Message:</b></h5>
                  <p class="card-text">{{ $mails->mdmTxt_message }}</h5>
            </div>

	       	<div class="card-footer text-muted"><strong>Date received:</strong> 
                  @if($mails->created_at->diffInDays(Carbon\Carbon::now()) < 2)
                    {{ $mails->created_at->format('M d - g:i A') }}
                  @else
                    {{ $mails->created_at->format('M d, Y') }}
                  @endif
            </div>

           
	    </div>
	    
	  </div>
	</div>
</div>

@endsection