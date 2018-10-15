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
          <li class="nav-item"><a class="nav-link" href="mails"><i class="fa fa-inbox fa-fw"></i> Inbox</a></li>
          <li class="nav-item active"><a class="nav-link" href="sent"><i class="fa fa-envelope-o fa-fw"></i> Sent</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-md-9">
    <div class="tile">
      
      <div class="table-responsive mailbox-messages">
        <table class="table table-hover">
          <tbody>
          @foreach($mails as $mail)
            <tr>
             @if($mail->sender_name == Auth::user()->email)
              <td><a class="nav-link" href="/author/sent/{{ $mail->int_id }}">{{$mail->email}}</a></td>
              <td class="mail-subject"><a class="nav-link" href="/author/sent/{{ $mail->int_id }}"><b>{{$mail->str_subject}}</b> - {{str_limit($mail->mdmTxt_message, $limit = 20, $end = '...')}}</a></td>
              <td><a class="nav-link" href="/author/sent/{{ $mail->int_id }}">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$mail->created_at)->format('F j Y g:i A ')}}</a></td>
              <td>
                <div align="center">
                  {!!Form::open(['action' => ['Author\MailController@deleteMails', $mail->int_id],'method' => 'POST', 'onsubmit' => "return confirm('Remove Message?')"])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    <button type="submit" class="fa fa-trash-o" data-toggle="tooltip" data-original-title="Delete">
                      <i class="ti-close" aria-hidden="true"></i>
                    </button>
                  {!!Form::close()!!}
                </div>
              </td>
              @endif
        
            </tr>
           @endforeach
          </tbody>
        </table> 
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
      <div class="modal-body">
        {!! Form::open(['action' => 'Author\MailController@composeMails', 'method' => 'POST', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'class' => 'form-material form-horizontal'])!!}
          <div class="form-group">
            {{ Form::label('lblEmail', 'Email', ['class' => 'col-md-12']) }}
            <div class="col-md-12">
              {{ Form::text('email', 'Admin', ['class' => 'form-control']) }}    
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

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info">Send</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection