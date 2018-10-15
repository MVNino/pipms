@extends('guest.layouts.app')

@section('content')
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
  <div class="logo">
      <h1>Patentable Works</h1>
  </div>
<div class="container">
	<div style="background-color: #f3f3f3">
		<div class="container pt-3">
		  <div class="row">
		  	@forelse($patentables as $patent)
		    <div class="col-md-6 col-lg-4">
		      <div class="tile tile-body">
		        <img src="/storage/images/project_type/{{ $patent->str_project_type_image }}" alt="Patent Work" style="width: 100%">
	        	<h2 class="text-center">{{ $patent->char_project_type }}</h2>
	        	<p class="text-center">Projects Submitted: <b>{{ $patent->patents->count() }}</b></p>

		      </div>
		    </div>
		    @empty
				<div class="alert alert-warning">
					There is no record for patentable works yet.
				</div>
		    @endforelse
		    </div>
	  	</div>
	</div>
</div>
</section>
@endsection

@section('pg-specific-js')
<script>
  $(document).ready(function(){
    $('#dropdown-ipr').css('color', 'maroon');
    $('#dropdown-ipr').css('border-bottom', '1px solid rgb(136,136,129)');
  });
</script>
@endsection