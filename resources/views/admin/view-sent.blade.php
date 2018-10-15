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
	      </ul>
	    </div>
	  </div>
	</div>
	<div class="col-md-9">
    <div class="tile">
      
      <div class="table-responsive mailbox-messages">
        
          <div class="card-body">
                  <h5 class="card-title"><b>TO: </b>{{ $mails->email }}</h5>
            </div>
            <div class="card-body">
                <h5 class="card-title"><b>Subject:</b></h5>
                  <p class="card-text">{{ $mails->str_subject }}</h5>
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
<div class="modal fade" id="composeMails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="composeMails">New Message</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
     
        {!! Form::open(['action' => 'Admin\MailController@composeMails', 'method' => 'POST', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'class' => 'form-material form-horizontal'])!!}
          <div class="form-group">
            {{ Form::label('lblEmail', 'Email', ['class' => 'col-md-12']) }}
            <div class="col-md-12">
              {{ Form::text('email', '', ['class' => 'form-control']) }}    
            </div>      
          </div>
          <div class="form-group">
            {{ Form::label('lblSubject', 'Subject', ['class' => 'col-md-12']) }}
            <div class="col-md-12">
              {{ Form::text('subject', '', ['class' => 'form-control']) }}    
            </div>      
          </div>
          <div class="form-group">
            {{ Form::label('lblMessage', 'Message', ['class' => 'col-md-12']) }}
            <div class="col-md-12">
              {{ Form::textarea('message', '', ['class' => 'form-control', 'rows' => '5']) }}
            </div>
          </div>

      
      <div class="modal-footer">
        <button type="submit" class="btn btn-info">Send</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection