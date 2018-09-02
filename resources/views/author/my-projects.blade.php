@extends('author.layouts.app-classimax')

@section('content')

Hey! you!
 mak yu

 @endsection

 @section('pg-specific-js')
 <script>
  $(document).ready(function(){
    $('#li-my-projects').addClass('active');
  });
 </script>
 @endsection