@extends('author-pd.layouts.app')

@section('pg-specific-css')
{{-- Timeline CSS --}}
<link href="{{asset('elite/css/timeline-vertical-horizontal.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul id="tabs" class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#copyright" role="tab">Copyright</a>
                                    </li>
                                    @if($viewProject->patent)
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#patent" role="tab">Patent</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        
                        <div id="my-tab-content" class="tab-content text-center">
                            <div class="tab-pane active" id="copyright" role="tabpanel">
                                <h3 class="text-muted"><strong>Copyright Timeline</strong></h3>
                                <h4 class="text-muted"><strong>({{ $viewProject->str_project_title }})</strong></h4>
                                <ul class="timeline">
                                    @if($viewProject->char_copyright_status == 'pending')
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge default">
                                                <img class="img-responsive" alt="user" src="/storage/images/profile/{{ Auth::user()->str_user_image_code }}" alt="img">
                                            </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title"><b>Application</b> for Copyright Registration</h4>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>You've submitted your application form for copyright registration.</p>
                                                </div>
                                            </div>
                                        </li>  
                                        <li>
                                            <div class="timeline-badge primary"><i class="fa fa-hand-stop-o"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Copyright Status: <b>Pending</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->created_at)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your Application is currently on pending status, and is waiting to have your scheduled appointment with the administrator.</p>
                                                </div>
                                            </div>
                                        </li>
                                    @elseif($viewProject->char_copyright_status == 'to submit')    
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge default">
                                                <img class="img-responsive" alt="user" src="/storage/images/profile/{{ Auth::user()->str_user_image_code }}" alt="img">
                                            </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title"><b>Application</b> for Copyright Registration</h4>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>You've submitted your application form for copyright registration.</p>
                                                </div>
                                            </div>
                                        </li>  
                                        <li>
                                            <div class="timeline-badge primary"><i class="fa fa-hand-stop-o"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Copyright Status: <b>Pending</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->created_at)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your Application is currently on pending status, and is waiting to have your scheduled appointment with the administrator.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge success"><i class="fa fa-calendar-check-o"></i> </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Copyright Status: <b>To submit</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->dtm_to_submit)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your requirement documents are scheduled to be submitted in the office for actual application.</p>
                                                </div>
                                            </div>
                                        </li>

                                    @elseif($viewProject->char_copyright_status == 'to submit/conflict')    
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge default">
                                                <img class="img-responsive" alt="user" src="/storage/images/profile/{{ Auth::user()->str_user_image_code }}" alt="img">
                                            </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title"><b>Application</b> for Copyright Registration</h4>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>You've submitted your application form for copyright registration.</p>
                                                </div>
                                            </div>
                                        </li>  
                                        <li>
                                            <div class="timeline-badge primary"><i class="fa fa-hand-stop-o"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Copyright Status: <b>Pending</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->created_at)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your Application is currently on pending status, and is waiting to have your scheduled appointment with the administrator.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge success"><i class="fa fa-calendar-check-o"></i> </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Copyright Status: <b>To submit</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->dtm_to_submit)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your requirement documents are scheduled to be submitted in the office for actual application.</p>
                                                </div>
                                            </div>
                                        </li>  
                                        <li>
                                            <div class="timeline-badge primary"><i class="fa fa-calendar"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Copyright Status: <b>To Submit / Reappointment</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->created_at)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your schedule for this reappointment: <b>{{ $viewProject->dtm_schedule->format('M d, g:i A') }}</b></p>
                                                </div>
                                            </div>
                                        </li>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="bs-component">
                                                  <h5 class="list-group-item-heading text-primary">List of requirements that you have</h5>
                                                    <div class="list-group">
                                                      @foreach($viewProject->requirements as $reqList)
                                                      <a class="list-group-item list-group-item-action" href="#">
                                                        {{ $reqList->requirement->str_requirement }}
                                                      </a>
                                                      @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bs-component">
                                                  <h5 class="list-group-item-heading text-primary">Official list of requirements for copyright</h5>
                                                    <div class="list-group">
                                                      @foreach($requirements as $requirement)
                                                      <a class="list-group-item list-group-item-action" href="#">
                                                        {{ $requirement->str_requirement }}
                                                      </a>
                                                      @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                     @elseif($viewProject->char_copyright_status == 'on process')    
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge default">
                                                <img class="img-responsive" alt="user" src="/storage/images/profile/{{ Auth::user()->str_user_image_code }}" alt="img">
                                            </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title"><b>Application</b> for Copyright Registration</h4>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>You've submitted your application form for copyright registration.</p>
                                                </div>
                                            </div>
                                        </li>  
                                        <li>
                                            <div class="timeline-badge primary"><i class="fa fa-hand-stop-o"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Copyright Status: <b>Pending</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->created_at)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your Application is currently on pending status, and is waiting to have your scheduled appointment with the administrator.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge success"><i class="fa fa-calendar-check-o"></i> </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Copyright Status: <b>To submit</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->dtm_to_submit)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your requirement documents are scheduled to be submitted in the office for actual application.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="timeline-badge primary"><i class="fa fa-calendar"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Appointment</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->created_at)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your scheduled appointment: <b>{{ $viewProject->dtm_schedule->format('m/d/Y, g:i A') }}</b></p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge danger"><i class="fa fa-building-o"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Copyright Status: <b>On process</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->dtm_on_process)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p><b>You've complied with the requirements</b>. 
                                                        Your request now was on its process for copyright registration.</p>
                                                </div>
                                            </div>
                                        </li>
                                    @elseif($viewProject->char_copyright_status == 'copyrighted')  
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge default">
                                                <img class="img-responsive" alt="user" src="/storage/images/profile/{{ Auth::user()->str_user_image_code }}" alt="img">
                                            </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title"><b>Application</b> for Copyright Registration</h4>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>You've submitted your application form for copyright registration.</p>
                                                </div>
                                            </div>
                                        </li>  
                                        <li>
                                            <div class="timeline-badge primary"><i class="fa fa-hand-stop-o"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Copyright Status: <b>Pending</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->created_at)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your Application is currently on pending status, and is waiting to have your scheduled appointment with the administrator.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge success"><i class="fa fa-calendar-check-o"></i> </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Copyright Status: <b>To submit</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->dtm_to_submit)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your requirement documents are scheduled to be submitted in the office for actual application.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="timeline-badge primary"><i class="fa fa-calendar"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Appointment</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->created_at)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your scheduled appointment: <b>{{ $viewProject->dtm_schedule->format('m/d/Y, g:i A') }}</b></p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge danger"><i class="fa fa-building-o"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Copyright Status: <b>On process</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->dtm_on_process)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p><b>You've complied with the requirements</b>. 
                                                        Your request now was on its process for copyright registration.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="timeline-badge info"><i class="fa fa-copyright"></i></div>
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
                            @if($viewProject->patent)
                            <div class="tab-pane" id="patent" role="tabpanel">
                                <h3 class="text-muted"><strong>Patent Timeline</strong></h3>
                                <h4 class="text-muted"><strong>({{ $viewProject->patent->str_patent_project_title }})</strong></h4>
                                <ul class="timeline">
                                    @if($viewProject->patent->char_patent_status == 'pending')
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge default">
                                                <img class="img-responsive" alt="user" src="/storage/images/profile/{{ Auth::user()->str_user_image_code }}" alt="img">
                                            </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title"><b>Application</b> for Patent Registration</h4>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>You've submitted your application form for patent registration.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="timeline-badge primary"><i class="fa fa-hand-stop-o"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Patent Status: <b>Pending</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->patent->created_at)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your Application is currently on pending status, and is waiting for approval</p>
                                                </div>
                                            </div>
                                        </li>
                                    @elseif($viewProject->patent->char_patent_status == 'to submit')  
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge default">
                                                <img class="img-responsive" alt="user" src="/storage/images/profile/{{ Auth::user()->str_user_image_code }}" alt="img">
                                            </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title"><b>Application</b> for Patent Registration</h4>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>You've submitted your application form for patent registration.</p>
                                                </div>
                                            </div>
                                        </li>  
                                        <li>
                                            <div class="timeline-badge primary"><i class="fa fa-hand-stop-o"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Patent Status: <b>Pending</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->patent->created_at)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your Application is currently on pending status, and is waiting for approval</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge success"><i class="fa fa-calendar-check-o"></i> </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Patent Status: <b>To submit</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->patent->dtm_to_submit)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your requirement documents are scheduled to be submitted in the office for actual application.</p>
                                                </div>
                                            </div>
                                        </li>

                                    @elseif($viewProject->patent->char_patent_status == 'to submit/conflict')    
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge default">
                                                <img class="img-responsive" alt="user" src="/storage/images/profile/{{ Auth::user()->str_user_image_code }}" alt="img">
                                            </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title"><b>Application</b> for Patent Registration</h4>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>You've submitted your application form for patent registration.</p>
                                                </div>
                                            </div>
                                        </li>  
                                        <li>
                                            <div class="timeline-badge primary"><i class="fa fa-hand-stop-o"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Patent Status: <b>Pending</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->patent->created_at)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your Application is currently on pending status, and is waiting for approval</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge success"><i class="fa fa-calendar-check-o"></i> </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Patent Status: <b>To submit</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->patent->dtm_to_submit)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your requirement documents are scheduled to be submitted in the office for actual application.</p>
                                                </div>
                                            </div>
                                        </li>  
                                        <li>
                                            <div class="timeline-badge primary"><i class="fa fa-calendar"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Patent Status: <b>To Submit / Reappointment</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->patent->created_at)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your schedule for this reappointment: <b>{{ $viewProject->patent->dtm_schedule->format('M d, g:i A') }}</b></p>
                                                </div>
                                            </div>
                                        </li>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="bs-component">
                                                  <h5 class="list-group-item-heading text-primary">List of requirements that you have</h5>
                                                    <div class="list-group">
                                                      @foreach($viewProject->patent->requirements as $reqList)
                                                      <a class="list-group-item list-group-item-action" href="#">
                                                        {{ $reqList->requirement->str_requirement }}
                                                      </a>
                                                      @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="bs-component">
                                                  <h5 class="list-group-item-heading text-primary">Official list of requirements for patent</h5>
                                                    <div class="list-group">
                                                      @foreach($patentRequirements as $requirement)
                                                      <a class="list-group-item list-group-item-action" href="#">
                                                        {{ $requirement->str_requirement }}
                                                      </a>
                                                      @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                     @elseif($viewProject->patent->char_patent_status == 'on process') 
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge default">
                                                <img class="img-responsive" alt="user" src="/storage/images/profile/{{ Auth::user()->str_user_image_code }}" alt="img">
                                            </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title"><b>Application</b> for Patent Registration</h4>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>You've submitted your application form for patent registration.</p>
                                                </div>
                                            </div>
                                        </li>   
                                        <li>
                                            <div class="timeline-badge primary"><i class="fa fa-hand-stop-o"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Patent Status: <b>Pending</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->patent->created_at)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your Application is currently on pending status, and is waiting for approval</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge success"><i class="fa fa-calendar-check-o"></i> </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Patent Status: <b>To submit</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->patent->dtm_to_submit)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your requirement documents are scheduled to be submitted in the office for actual application.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="timeline-badge danger"><i class="fa fa-building-o"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Patent Status: <b>On process</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->patent->dtm_on_process)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p><b>You've complied with the requirements</b>. 
                                                        Your request now was on its process for patent registration.</p>
                                                </div>
                                            </div>
                                        </li>

                                    @elseif($viewProject->patent->char_patent_status == 'patented')
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge default">
                                                <img class="img-responsive" alt="user" src="/storage/images/profile/{{ Auth::user()->str_user_image_code }}" alt="img">
                                            </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title"><b>Application</b> for Patent Registration</h4>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>You've submitted your application form for patent registration.</p>
                                                </div>
                                            </div>
                                        </li>     
                                        <li>
                                            <div class="timeline-badge primary"><i class="fa fa-hand-stop-o"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Patent Status: <b>Pending</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->patent->created_at)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your Application is currently on pending status, and is waiting for approval</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge success"><i class="fa fa-calendar-check-o"></i> </div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Patent Status: <b>To submit</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->patent->dtm_to_submit)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your requirement documents are scheduled to be submitted in the office for actual application.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="timeline-badge danger"><i class="fa fa-building-o"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Patent Status: <b>On process</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->patent->dtm_on_process)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p><b>You've complied with the requirements</b>. 
                                                        Your request now was on its process for patent registration.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="timeline-inverted">
                                            <div class="timeline-badge info"><i class="fa fa-certificate"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">Patent Status: <b>Patented</b></h4>
                                                    <p><small class="text-muted"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$viewProject->patent->dtm_patented)->format('l, jS \of F Y g:i A')}}</small> </p>
                                                </div>
                                                <div class="timeline-body">
                                                    <p>Your document is already patented. </p>
                                                </div>
                                            </div>
                                        </li>
                                    @endif    
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>      
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
@endsection
