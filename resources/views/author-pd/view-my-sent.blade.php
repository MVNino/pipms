@extends('author-pd.layouts.app')

@section('pg-specific-css')
<!-- Main Modified CSS -->
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}"> --}}
@endsection

@section('content')
<div class="row">
  <div class="col-md-3"><a class="mb-2 btn btn-primary btn-block" data-toggle="modal" data-target="#composeMails">Compose Mail</a>
    <div class="tile p-0">
      <h4 class="tile-title folder-head">Folders</h4>
      <div class="tile-body">
        <ul class="nav nav-pills flex-column mail-nav">
          <li class="nav-item active"><a class="nav-link" href="/author/mails"><i class="fa fa-inbox fa-fw"></i> Inbox</a></li>
          <li class="nav-item"><a class="nav-link" href="/author/sent"><i class="fa fa-envelope-o fa-fw"></i> Sent</a></li>
          <li class="nav-item"><a class="nav-link" href="/author/trash"><i class="fa fa-trash-o fa-fw"></i> Trash</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-md-9">
    <div class="tile">
      
      <div class="table-responsive mailbox-messages">
        <div class="table-responsive mailbox-messages">
	      
	       	<div class="card-body">
                  <h5 class="card-title"><b>TO: </b>{{ $mails->sender_name }}</h5>
            </div>

            <div class="card-body">
            	  <h5 class="card-title"><b>Message:</b></h5>
                  <p class="card-text">{{ $mails->mdmTxt_message }}</h5>
            </div>

	       	<div class="card-footer text-muted"><strong>Date sent:</strong> 
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
</div>

@endsection