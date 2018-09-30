@extends('author-pd.layouts.app')

@section('content')

	<div class="row">
       <!-- column -->
	   @foreach($myProjects as $myProject)
	    <div class="col-lg-3 col-md-6">
	        <!-- Card -->
	        <div class="card">
	            <img class="card-img-top img-responsive" src="{{asset('elite/images/img1.jpg')}}" alt="Card image cap">
	            <div class="card-body">
	                <h4 class="card-title">	{{$myProject->str_project_title}}</h4>
	                <small class="card-text">Copyright Status: <b>{{$myProject->char_copyright_status}}</b></small>
	                <br/>
	                @if($myProject->char_copyright_status == 'To submit')
	                <small class="card-text">Appointed Schedule: <b>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myProject->dtm_schedule)->format('F d Y, l')}}</b></small>
	                <br><br>
	                @endif
	                @if($myProject->patent)
	                <small class="card-text">Patent Status: <b>{{ $myProject->patent->char_patent_status }}</b></small>
		                <br>
		                @if($myProject->patent->char_patent_status == 'To submit')
		                <small class="card-text">Appointed Schedule: <b>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myProject->patent->dtm_schedule)->format('F d Y, l')}}</b></small>
		                @endif
	                @endif
	                <div align="center">
		                <a href="/author/my-project/{{ $myProject->int_id }}/{{ $myProject->str_project_title }}" class="btn btn-primary">
		                	View Progress
		                </a>
	                </div>
	                @if(!$myProject->patent)
	                <small>
	                	<br>
	                	<a href="/author/ipr-patent-application/{{ $myProject->int_id }}">Want to apply for patent?</a>
	           	 	</small>
	           	 	@endif
	            </div>
	        </div>
	        <!-- Card -->
	    </div>
	    @endforeach
     </div>
@endsection