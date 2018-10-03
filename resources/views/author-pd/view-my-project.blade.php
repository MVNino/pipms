@extends('author-pd.layouts.app')

@section('pg-specific-css')
<!-- Custom CSS -->
<link href="{{asset('elite/css/style.min.css')}}" rel="stylesheet">
<link href="{{asset('elite/css/timeline-vertical-horizontal.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="timeline">
            			@if($viewProject->char_copyright_status == 'pending')
            				<li>
                                <div class="timeline-badge success"><img class="img-responsive" alt="user" src="../assets/images/users/1.jpg" alt="img"> </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Copyright Status: <b>Pending</b></h4>
                                        <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->created_at)->format('l, jS \of F Y g:i A')}}</small> </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Your Application is currently on pending status, and is waiting for approval</p>
                                    </div>
                                </div>
                            </li>
                        @elseif($viewProject->char_copyright_status == 'To submit')    
                            <li>
                                <div class="timeline-badge success"><img class="img-responsive" alt="user" src="../assets/images/users/1.jpg" alt="img"> </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Copyright Status: <b>Pending</b></h4>
                                        <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->created_at)->format('l, jS \of F Y g:i A')}}</small> </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Your Application is currently on pending status, and is waiting for approval</p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-badge warning"><img class="img-responsive" alt="user" src="../assets/images/users/1.jpg" alt="img"> </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Copyright Status: <b>To submit</b></h4>
                                        <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->dtm_to_submit)->format('l, jS \of F Y g:i A')}}</small> </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Your Document is to be submitted to the National Library.</p>
                                    </div>
                                </div>
                            </li>


                         @elseif($viewProject->char_copyright_status == 'On process')    
                            <li>
                                <div class="timeline-badge success"><img class="img-responsive" alt="user" src="../assets/images/users/1.jpg" alt="img"> </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Copyright Status: <b>Pending</b></h4>
                                        <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->created_at)->format('l, jS \of F Y g:i A')}}</small> </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Your Application is currently on pending status, and is waiting for approval</p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-badge warning"><img class="img-responsive" alt="user" src="../assets/images/users/1.jpg" alt="img"> </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Copyright Status: <b>To submit</b></h4>
                                        <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->dtm_to_submit)->format('l, jS \of F Y g:i A')}}</small> </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Your Document is to be submitted to the National Library.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-badge danger"><img class="img-responsive" alt="user" src="../assets/images/users/1.jpg" alt="img"> </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Copyright Status: <b>On process</b></h4>
                                        <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->dtm_on_process)->format('l, jS \of F Y g:i A')}}</small> </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Your document is now on process.</p>
                                    </div>
                                </div>
                            </li>

                        @elseif($viewProject->char_copyright_status == 'Copyrighted')    
                            <li>
                                <div class="timeline-badge success"><img class="img-responsive" alt="user" src="../assets/images/users/1.jpg" alt="img"> </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Copyright Status: <b>Pending</b></h4>
                                        <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->created_at)->format('l, jS \of F Y g:i A')}}</small> </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Your Application is currently on pending status, and is waiting for approval</p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-badge warning"><img class="img-responsive" alt="user" src="../assets/images/users/1.jpg" alt="img"> </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Copyright Status: <b>To submit</b></h4>
                                        <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->dtm_to_submit)->format('l, jS \of F Y g:i A')}}</small> </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Your Document is to be submitted to the National Library.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-badge danger"><img class="img-responsive" alt="user" src="../assets/images/users/1.jpg" alt="img"> </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Copyright Status: <b>On process</b></h4>
                                        <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->dtm_on_process)->format('l, jS \of F Y g:i A')}}</small> </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Your document is now on process.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-badge info"><img class="img-responsive" alt="user" src="../assets/images/users/1.jpg" alt="img"> </div>
                                <div class="timeline-panel">
                                    <div class="timeline-heading">
                                        <h4 class="timeline-title">Copyright Status: <b>Copyrighted</b></h4>
                                        <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->dtm_copyrighted)->format('l, jS \of F Y g:i A')}}</small> </p>
                                    </div>
                                    <div class="timeline-body">
                                        <p>Your document is already copyrighted. </p>
                                    </div>
                                </div>
                            </li>
                        @endif    
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection	

@section('pg-specific-js')
<script src="{{ asset('elite/js/custom.min.js') }}"></script>


<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<script src="../assets/node_modules/popper/popper.min.js"></script>



<script>
$('#li-my-projects').addClass('active');
</script>
=======

@endsection
