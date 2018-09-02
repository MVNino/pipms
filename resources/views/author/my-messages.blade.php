@extends('author.layouts.app-classimax')

@section('content')

message to

 @endsection

 @section('pg-specific-js')
 <script>
  $(document).ready(function(){
  	$('#li-my-messages').addClass('active');
  });
 </script>
 @endsection