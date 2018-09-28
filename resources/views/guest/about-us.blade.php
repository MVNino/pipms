@extends('guest.layouts.app')

@section('content')
<section class="material-half-bg">
  <div class="cover"></div>
</section>
<br><br><br><br><br>
<style type="text/css">
      body {
          background-image: url(assets/images/web1.jpg);
      }
    </style>
<div class="container">
  <div class="row col-md-12">
    <div class="tile">
      <div class="tile-body">
    <h1>ABOUT PAGE</h1>
    <div class="row">
        <div class="col-md-8 col-sm-8">
          <br>PUP Intellectual Property Management System is a website build in connection with the application of copyright and patent at the university. The Intellectual Property Management Office (IPMO) is the one responsible for the activities.    <br/>     
        </div>
        <div class="row-col-md-7">
         <img src="/storage/images/logo.png"
         width="100" height="100">
        </div>
      </div>
      <br/>
      <div class="row">
        <div class="col-md-8 col-sm-8">
          The Intellectual Property Management Office (IPMO) aids researchers to secure attractive returns in the long term from the bulk of valuable research outcomes and intellectual property. It also assists researchers in identifying possible partners within the academe, other businesses and investors to promote translation of research innovations into new products through advice and support for early stage research and development. The IPMO provides a portfolio of new technologies created through the university research for licensing or collaborative development.
        </div>
      </div>

      <br/>
      <div class="row">
        <div class="col-md-6">
          
        </div>
        <div class="col-md-6">
          
        </div>
      </div>
    </div>
    </div> 
  </div> 
</div>
@endsection

@section('pg-specific-js')
<!-- Adding class .active to about blade -->
<script>
  $(document).ready(function(){
    $('#about').addClass("active");
  });
</script>
@endsection