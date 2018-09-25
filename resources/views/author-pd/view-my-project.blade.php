@extends('author-pd.layouts.app')

@section('pg-specific-css')

<link href="{{asset('elite/css/horizontal-timeline.css')}}" rel="stylesheet">
<!-- Custom CSS -->
<link href="{{asset('elite/css/style.min.css')}}" rel="stylesheet">
<link href="{{asset('elite/css/timeline-vertical-horizontal.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <section class="cd-horizontal-timeline">
                        <div class="timeline">
                            <div class="events-wrapper">
                                <div class="events">
                                    <ol>
                                        @if($myProject->char_copyright_status == 'pending')
                                            <li><a href="#0" data-date="{{$myProject->created_at}}" class="selected">"{{$myProject->created_at}}"</a></li>
                                        @endif
                                        @if($myProject->char_copyright_status == 'To submit')
                                            <li><a href="#0" data-date="{{$myProject->created_at}}" class="selected">"{{$myProject->created_at}}"</a></li>
                                            <li><a href="#0" data-date="{{$myProject->dtm_schedule}}">"{{$myProject->dtm_schedule}}"</a></li>
                                        @endif
                                        @if($myProject->char_copyright_status == 'On Process')
                                            <li><a href="#0" data-date="{{$myProject->created_at}}" class="selected">"{{$myProject->created_at}}"</a></li>
                                            <li><a href="#0" data-date="{{$myProject->dtm_schedule}}">"{{$myProject->dtm_schedule}}"</a></li>
                                            <li><a href="#0" data-date="{{$myProject->dtm_schedule}}">$myProject->dtm_schedule}}"</a></li>
                                                @endif
                                        
                                    </ol>
                                    <span class="filling-line" aria-hidden="true"></span>
                                </div>
                                <!-- .events -->
                            </div>
                            <!-- .events-wrapper -->
                            <ul class="cd-timeline-navigation">
                                <li><a href="#0" class="prev inactive">Prev</a></li>
                                <li><a href="#0" class="next">Next</a></li>
                            </ul>
                            <!-- .cd-timeline-navigation -->
                        </div>
                        <!-- .timeline -->
                        <div class="events-content">
                            
                            <ol>
                                @if($myProject->char_copyright_status == 'pending')
                                <li class="selected" data-date="{{$myProject->created_at}}">
                                    <h2><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="{{asset('elite/images/1.jpg')}}" alt="user"> Copyright<br/>Pending<br/><small>{{$myProject->created_at}}</small></h2>
                                    <p class="m-t-40">
                                        Your Application is currently on pending status, and is waiting for approval
                                    </p>
                                    <p>
                                        <button class="btn btn-rounded btn-outline-info m-t-20">Read more</button>
                                    </p>
                                </li>

                                @endif

                                @if($myProject->char_copyright_status == 'To submit')
                                <li class="selected" data-date="{{$myProject->created_at}}">
                                    <h2><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="{{asset('elite/images/1.jpg')}}" alt="user">Copyright<br/> Pending<br/><small>{{$myProject->created_at}}</small></h2>
                                    <p class="m-t-40">
                                        Your Application is currently on pending status, and is waiting for approval
                                    </p>
                                    <p>
                                        <button class="btn btn-rounded btn-outline-info m-t-20">Read more</button>
                                    </p>
                                </li>
                                <li data-date="{{$myProject->dtm_schedule}}">
                                    <h2><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="{{asset('elite/images/1.jpg')}}" alt="user">Copyright<br/> To Submit<br/><small>{{$myProject->dtm_schedule}}</small></h2>
                                    <p class="m-t-40">
                                        Your Document is to be submitted.
                                    </p>
                                    <p>
                                        <button class="btn btn-rounded btn-outline-info m-t-20">Read more</button>
                                    </p>
                                </li>
                                @endif
                                @if($myProject->char_copyright_status == 'On process')
                                <li class="selected" data-date="{{$myProject->created_at}}">
                                    <h2><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="{{asset('elite/images/1.jpg')}}" alt="user">Copyright<br/> Pending<br/><small>{{$myProject->created_at}}</small></h2>
                                    <p class="m-t-40">
                                        Your Application is currently on pending status, and is waiting for approval
                                    </p>
                                    <p>
                                        <button class="btn btn-rounded btn-outline-info m-t-20">Read more</button>
                                    </p>
                                </li>
                                <li data-date="{{$myProject->dtm_schedule}}">
                                    <h2><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="{{asset('elite/images/1.jpg')}}" alt="user">Copyright<br/> To Submit<br/><small>{{$myProject->dtm_schedule}}</small></h2>
                                    <p class="m-t-40">
                                        Your Document is to be submitted.
                                    </p>
                                    <p>
                                        <button class="btn btn-rounded btn-outline-info m-t-20">Read more</button>
                                    </p>
                                </li>
                                <li data-date="{{$myProject->dtm_schedule}}">
                                    <h2><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="{{asset('elite/images/1.jpg')}}" alt="user">Copyright<br/> On Process<br/><small>{{$myProject->dtm_schedule}}</small></h2>
                                    <p class="m-t-40">
                                        Your document is now on process.                                    </p>
                                    <p>
                                        <button class="btn btn-rounded btn-outline-info m-t-20">Read more</button>
                                    </p>
                                </li>
                                @endif
                            </ol>
                        
                        </div>
                        <!-- .events-content -->
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection	

@section('pg-specific-js')
<script src="{{ asset('elite/js/custom.min.js') }}"></script>
<script src="{{ asset('elite/js/horizontal-timeline.js')}}"></script>
<<<<<<< HEAD
<script>
$('#li-my-projects').addClass('active');
</script>
=======
>>>>>>> 74d4d556c46e60906cef2ab0d1be9c8d78100a0f
@endsection
