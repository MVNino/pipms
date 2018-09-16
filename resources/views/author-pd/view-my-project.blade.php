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
                                        <li><a href="#0" data-date="01/06/2017" class="selected">16 Jan</a></li>
                                        <li><a href="#0" data-date="17/09/2018">28 Sep</a></li>
                                        <li><a href="#0" data-date="20/12/2018">20 Dec</a></li>

                                        
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
                                <li class="selected" data-date="01/06/2017">
                                    <h2><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="{{asset('elite/images/1.jpg')}}" alt="user"> Pending<br/></h2>
                             </ol>    
                        </li>
                                    <div class="row">
                                    <div class="col-md-6">
                                    <h2>Copyright</h2>    
                                    <p class="m-t-40">
                                        Your Application is currently on pending status, and is waiting for approval
                                    </p>
                                    <p>
                                        <button class="btn btn-rounded btn-outline-info m-t-20">Read more</button>
                                    </p>
                                
                                <li data-date="17/09/2018">
                                    <h2><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="{{asset('elite/images/1.jpg')}}" alt="user"> To Submit<br/><small>September 17th, 2018</small></h2>
                                    <p class="m-t-40">
                                        Your Document is to be submitted.
                                    </p>
                                    <p>
                                        <button class="btn btn-rounded btn-outline-info m-t-20">Read more</button>
                                    </p>
                                </li>
                                <li data-date="20/12/2018">
                                    <h2><img class="img-circle pull-left m-r-20 m-b-10" width="60" alt="user" src="{{asset('elite/images/1.jpg')}}" alt="user"> On Process<br/><small>December 20th, 2018</small></h2>
                                    <p class="m-t-40">
                                        Your document is now on process.                                    </p>
                                    <p>
                                        <button class="btn btn-rounded btn-outline-info m-t-20">Read more</button>
                                    </p>
                                </li>
                                    
                                
                            
                        </div>
                        <!-- .events-content -->
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection	

@section('pg-specific-js')
<script src="{{ asset('elite/js/custom.min.js') }}"></script>
<script src="{{ asset('elite/js/horizontal-timeline.js')}}"></script>
@endsection
