@extends('author-pd.layouts.app')

@section('content')

	<div class="row">
       <!-- column -->
	   @foreach($myProjects as $row)
	    <div class="col-lg-3 col-md-6">
	        <!-- Card -->
	        <div class="card">
	            <img class="card-img-top img-responsive" src="{{asset('elite/images/img1.jpg')}}" alt="Card image cap">
	            <div class="card-body">
	                <h4 class="card-title">	{{$row['str_project_title']}}</h4>

	                <small class="card-text">Copyright Status: <b>{{$row['char_copyright_status']}}</b></small>
	                <br>
	                @if($row->char_copyright_status == 'To submit')
	                <small class="card-text">Appointed Schedule: <b>{{$row->dtm_schedule}}</b></small>
	                <br><br>
	                @endif
	                @if($row->patent)
	                <small class="card-text">Patent Status: <b>{{ $row->patent->char_patent_status }}</b></small>
		                <br>
		                @if($row->patent->char_patent_status == 'To submit')
		                <small class="card-text">Appointed Schedule: <b>{{$row->patent->dtm_schedule}}</b></small>
		                @endif
	                @endif
	                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
	                <a href="/author/my-project/{{ $row->int_id }}" class="btn btn-primary">View Progress</a>
	                @if(!$row->patent)
	                <small>
	                	<br>
	                	<a href="/author/ipr-patent-application/{{ $row->int_id }}">Want to apply for patent?</a>
	           	 	</small>
	           	 	@endif
	            </div>
	        </div>
	        <!-- Card -->
	    </div>
	    @endforeach
     </div>
@endsection