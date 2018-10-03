	@extends('author-pd.layouts.app')

@section('content')

	<div class="row">
       <!-- column -->
	   @foreach($myProjects as $myProject)
	    <div class="col-lg-3 col-md-6">
	        <!-- Card -->
	        <div class="card">
	            <img class="card-img-top img-responsive" src="/storage/images/project_type/{{ $myProject->projectType->str_project_type_image }}" alt="project type image" height="200" width="300">
	            <div class="card-body">
	                <h4 class="card-title">	{{$myProject->str_project_title}}</h4>
	                <small class="card-text">Copyright Status: <b>{{$myProject->char_copyright_status}}</b></small>
	                <br/>
	                @if($myProject->char_copyright_status == 'To submit')
	                <small class="card-text">Appointed Schedule: <b>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myProject->dtm_to_submit)->format('F d Y, l \a\t g:i A')}}</b></small>
	                <br><br>
	                @elseif($myProject->char_copyright_status == 'On process')
	                <small class="card-text">Appointed Schedule: <b>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myProject->dtm_on_process)->format('F d Y, l \a\t g:i A')}}</b></small>
	                <br><br>
	                @elseif($myProject->char_copyright_status == 'Copyrighted')
	                <small class="card-text">Date: <b>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myProject->dtm_copyrighted)->format('F d Y')}}</b></small>
	                <br><br>
	                @endif
	                @if($myProject->patent)
	                <small class="card-text">Patent Status: <b>{{ $myProject->patent->char_patent_status }}</b></small>
		                <br>
		                @if($myProject->patent->char_patent_status == 'To submit')
		                <small class="card-text">Appointed Schedule: <b>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myProject->patent->dtm_to_submit)->format('F d Y, l \a\t g:i A')}}</b></small>
		                @elseif($myProject->patent->char_patent_status == 'On process')
		                <small class="card-text">Appointed Schedule: <b>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myProject->patent->dtm_to_submit)->format('F d Y, l \a\t g:i A')}}</b></small>
		                @elseif($myProject->patent->char_patent_status == 'Patented')
		                <small class="card-text">Date: <b>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myProject->patent->dtm_patented)->format('F d Y')}}</b></small>
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
	                	<a href="/author/ipr-patent-application/{{ $myProject->int_id }}/{{ $myProject->str_project_title }}">Want to apply for patent?</a>
	           	 	</small>
	           	 	@endif
	            </div>
	        </div>
	        <!-- Card -->
	    </div>
	    @endforeach
     </div>
@endsection