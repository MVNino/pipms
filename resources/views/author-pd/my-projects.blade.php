@extends('author-pd.layouts.app')

@section('content')

	<div class="row">
                            <!-- column -->
	   @foreach($myProjects as $row)
	    <div class="col-lg-3 col-md-6">
	        <!-- Card -->
	        <div class="card">
	            <img class="card-img-top img-responsive" src="{{asset('elite/images/1.jpg')}}" alt="Card image cap">
	            <div class="card-body">
	                <h4 class="card-title">	{{$row['str_project_title']}}</h4>
	                <p class="card-text">{{$row['mdmTxt_project_description']}}</p>
	                <a href="/author/my-project/{{ $row->int_id }}" class="btn btn-primary">View</a>
	                <small>
	                	<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	                	<a href="">Apply for Patent?</a>
	           	 	</small>
	            </div>
	        </div>
	        <!-- Card -->
	    </div>
	    @endforeach
     </div>
@endsection