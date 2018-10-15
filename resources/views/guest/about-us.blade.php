@extends('guest.layouts.app')

@section('content')
<section class="material-half-bg">
  <div class="cover"></div>
</section>
<section class="login-content">
  <div class="logo">
      <h1>About Us</h1>
  </div>
<div class="container">
  <div class="row col-md-12">
    <div class="tile">
      <div class="tile-body">
        <div class="col-sm-11.5">
        <img src="/storage/images/logo.png" style="float: right">
        </div>
        <div class="col-md-10">
          <br>
          <b><i>PUP Intellectual Property Management System</i></b> is a website build in connection with the application of copyright and patent at the university. The Intellectual Property Management Office (IPMO) is the one responsible for the activities.    
          <br>     
          <br>
          The Intellectual Property Management Office (IPMO) aids researchers to secure attractive returns in the long term from the bulk of valuable research outcomes and intellectual property. It also assists researchers in identifying possible partners within the academe, other businesses and investors to promote translation of research innovations into new products through advice and support for early stage research and development. The IPMO provides a portfolio of new technologies created through the university research for licensing or collaborative development.
          <br/>
        </div>
        <br><br><br>
        <div class="col-md-10">
          <h3 class="text-muted"> Contact Us</h3>
          <p class="lead">
          Email: ipmo@pup.edu.ph<br>
              Telephone: (632) 335-1PUP (335-1787)<br>
              or 335-1777 local 395<br>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
@endsection

@section('pg-specific-js')
<!-- Adding class .active to about blade -->
<script>
  $(document).ready(function(){
    $('#about').addClass("active");
  });
</script>
@endsection