@extends('guest.layouts.app')

@section('content')
<section class="material-half-bg">
  <div class="cover"></div>
</section>
<br><br><br><br><br>
<style type="text/css">
      body {
          background-image: url(storage/images/web1.jpg);
      }
    </style>
<div class="container">
	<div class="row col-md-12">
    <div class="tile">
      <div class="tile-body">
    <h1>ABOUT PAGE</h1>
    <div class="row">
        <div class="col-md-8 col-sm-8">
          PUP Intellectual Property Management System is a website build in connection with the application of copyright and patent at the university. The Intellectual Property Management Office (IPMO) is the one responsible for the activities.         
        </div>
        <div class="col-md-4 col-sm-4">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat.
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
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
        <div class="col-md-6">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat.
        </div>
      </div>
    </div>
    </div> 
  </div> 
</div>

  <!-- Adding class .active to about blade -->
	<script>
    $(document).ready(function(){
      $('#about').addClass("active");
    });
	</script>
@endsection