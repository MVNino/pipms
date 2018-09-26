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
                                            <li><a href="#0" data-date="{{$myProject->created_at}}" class="selected">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myProject->created_at)->format('M d')}}"</a></li>

                                        @elseif($myProject->char_copyright_status == 'To submit')
                                            <li><a href="#0" data-date="{{$myProject->created_at}}" class="selected">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myProject->created_at)->format('M d')}}"</a></li>
                                            <li><a href="#0" data-date="{{$myProject->dtm_schedule}}">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myProject->dtm_schedule)->format('M d')}}"</a></li>

                                        @elseif($myProject->char_copyright_status == 'On process')
                                            <li><a href="#0" data-date="{{$myProject->created_at}}" class="selected">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myProject->created_at)->format('M d')}}"a></li>
                                            <li><a href="#0" data-date="{{$myProject->dtm_schedule}}">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myProject->dtm_schedule)->format('M d')}}"</a></li>
                                            <li><a href="#0" data-date="01/01/2019">Jan 01</a></li>
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
                                    <h2><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="{{asset('elite/images/1.jpg')}}" alt="user"> Copyright Status:<br/>Pending<br/><small>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myProject->created_at)->format('l jS \of F Y g:i A')}}</small></h2>
                                    <p class="m-t-40">
                                        Your Application is currently on pending status, and is waiting for approval
                                    </p>
                                    <p>
                                        <button class="btn btn-rounded btn-outline-info m-t-20">Read more</button>
                                    </p>
                                </li><br/>
                                @endif
                                @if($myPatentProjects->char_patent_status == 'pending')
                                <li class="selected" data-date="{{$myPatentProjects->created_at}}">
                                    <h2><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="{{asset('elite/images/1.jpg')}}" alt="user"> Patent Status:<br/>Pending<br/><small>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myPatentProjects->created_at)->format('l jS \of F Y g:i A')}}</small></h2>
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
                                    <h2><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="{{asset('elite/images/1.jpg')}}" alt="user">Copyright Status:<br/> Pending<br/><small>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myProject->created_at)->format('l jS \of F Y g:i A')}}</small></h2>
                                    <p class="m-t-40">
                                        Your Application is currently on pending status, and is waiting for approval
                                    </p>
                                    <p>
                                        <button class="btn btn-rounded btn-outline-info m-t-20">Read more</button>
                                    </p>
                                </li>
                                <li data-date="{{$myProject->dtm_schedule}}">
                                    <h2><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="{{asset('elite/images/1.jpg')}}" alt="user">Copyright Status:<br/> To Submit<br/><small>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myProject->dtm_schedule)->format('l jS \of F Y g:i A')}}</small></h2>
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
                                    <h2><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="{{asset('elite/images/1.jpg')}}" alt="user">Copyright Status:<br/> Pending<br/><small>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myProject->created_at)->format('l jS \of F Y g:i A')}}</small></h2>
                                    <p class="m-t-40">
                                        Your Application is currently on pending status, and is waiting for approval
                                    </p>
                                    <p>
                                        <button class="btn btn-rounded btn-outline-info m-t-20">Read more</button>
                                    </p>
                                </li>
                                <li data-date="{{$myProject->dtm_schedule}}">
                                    <h2><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="{{asset('elite/images/1.jpg')}}" alt="user">Copyright Status:<br/> To submit<br/><small>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myProject->dtm_schedule)->format('l jS \of F Y g:i A')}}</small></h2>
                                    <p class="m-t-40">
                                        Your Document is to be submitted.
                                    </p>
                                    <p>
                                        <button class="btn btn-rounded btn-outline-info m-t-20">Read more</button>
                                    </p>
                                </li>
                                <li data-date="01/01/2019">
                                    <h2><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="{{asset('elite/images/1.jpg')}}" alt="user">Copyright Status:<br/> On process<br/><small>Jan 01</small></h2>
                                    <p class="m-t-40">
                                        Your document is now on process.                                    
                                    </p>
                                    <p>
                                        <button class="btn btn-rounded btn-outline-info m-t-20">Read more</button>
                                    </p>
                                </li>
                                @endif


                                @if($myPatentProjects->char_patent_status == 'To submit')
                                <li class="selected" data-date="{{$myPatentProjects->created_at}}">
                                    <h2><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="{{asset('elite/images/1.jpg')}}" alt="user">Patent Status:<br/> Pending<br/><small>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myPatentProjects->created_at)->format('l jS \of F Y g:i A')}}</small></h2>
                                    <p class="m-t-40">
                                        Your Application is currently on pending status, and is waiting for approval
                                    </p>
                                    <p>
                                        <button class="btn btn-rounded btn-outline-info m-t-20">Read more</button>
                                    </p>
                                </li>
                                <li data-date="{{$myPatentProjects->dtm_schedule}}">
                                    <h2><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="{{asset('elite/images/1.jpg')}}" alt="user">Patent Status:<br/> To Submit<br/><small>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myPatentProjects->dtm_schedule)->format('l jS \of F Y g:i A')}}</small></h2>
                                    <p class="m-t-40">
                                        Your Document is to be submitted.
                                    </p>
                                    <p>
                                        <button class="btn btn-rounded btn-outline-info m-t-20">Read more</button>
                                    </p>
                                </li>
                                @endif
                                @if($myPatentProjects->char_patent_status == 'On process')
                                <li class="selected" data-date="{{$myPatentProjects->created_at}}">
                                    <h2><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="{{asset('elite/images/1.jpg')}}" alt="user">Patent Status:<br/> Pending<br/><small>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myPatentProjects->created_at)->format('l jS \of F Y g:i A')}}</small></h2>
                                    <p class="m-t-40">
                                        Your Application is currently on pending status, and is waiting for approval
                                    </p>
                                    <p>
                                        <button class="btn btn-rounded btn-outline-info m-t-20">Read more</button>
                                    </p>
                                </li>
                                <li data-date="{{$myPatentProjects->dtm_schedule}}">
                                    <h2><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="{{asset('elite/images/1.jpg')}}" alt="user">Patent Status:<br/> To submit<br/><small>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$myPatentProjects->created_at)->format('l jS \of F Y g:i A')}}</small></h2>
                                    <p class="m-t-40">
                                        Your Document is to be submitted.
                                    </p>
                                    <p>
                                        <button class="btn btn-rounded btn-outline-info m-t-20">Read more</button>
                                    </p>
                                </li>
                                <li data-date="01/01/2019">
                                    <h2><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="{{asset('elite/images/1.jpg')}}" alt="user">Patent Status:<br/> On process<br/><small>Jan 01</small></h2>
                                    <p class="m-t-40">
                                        Your document is now on process.                                    
                                    </p>
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

<script src="{{ asset('elite/js/timeline.js')}}"></script>

<script>
$('#li-my-projects').addClass('active');
</script>
=======

@endsection
