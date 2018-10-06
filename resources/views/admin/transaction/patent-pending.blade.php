@extends('admin.layouts.app')

@section('pg-title')
<h1>Pending Requests for Patent</h1>
  <p>A listing of projects which requests for patent registration</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Transaction</li>
<li class="breadcrumb-item"><a href="/admin/transaction/patents/pend-request">Patents Pending Requests</a></li>
@endsection

@section('content')
<div class="tile">
  <div class="tile-body">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#all">All</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#college">By College</a></li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade active show" id="all">
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>Project/Work Title</th>
                <th>Applicant - Type</th>
                <th>Department-College-Branch</th>
                <th>Date Requested</th>
                <th class="text-center">View more details</th>
              </tr>
            </thead>
            <tbody>
            @forelse($patents as $patent)
            <tr>
              <td><b>{{ $patent->str_patent_project_title }}</b></td>
              <td><b>{{ $patent->copyright->applicant->user->str_first_name }} {{ $patent->copyright->applicant->user->str_last_name }}</b> - <b>{{ $patent->copyright->applicant->char_applicant_type }}</b> </td>
              <td>{{ $patent->copyright->applicant->department->char_department_code }} - {{ $patent->copyright->applicant->department->college->char_college_code }} - {{ $patent->copyright->applicant->department->college->branch->str_branch_name }}</td>
              <td>
                @if($patent->created_at->diffInYears(Carbon\Carbon::now()) == 0)
                  @if($patent->created_at->diffInDays(Carbon\Carbon::now()) <= 3)
                    {{ $patent->created_at->format('M d - g:i A')}}
                  @else
                    {{ $patent->created_at->format('F d')}}
                  @endif
                @else
                  {{ $patent->created_at->format('M d, Y')}}
                @endif
              </td>
              <td class="text-center"><a href="/admin/transaction/patent/pend-request/{{ $patent->int_id }}" role="button" class="btn btn-info"><span class="fa fa-eye"></span>View</a></td>
            </tr>
            @empty
              <div class="alert alert-warning">
                There is no record yet.
              </div>
            @endforelse
            </tbody>
            <tfoot>

            </tfoot>
          </table>
        </div>
        <div class="tab-pane fade" id="college">
          <div class="row">
            <div class="col-md-6">
              <div class="tile">
                <div class="row">
                  <div class="col-md-9">
                    <h4 class="tile-title text-muted">
                      <a href="/admin/transaction/patents/pend-request/id/college">
                        CCIS - PUP Main
                      </a>
                    </h4>
                  </div>
                  <div class="col-md-3">
                    <a href="{{ route('admin.today') }}" class="btn btn-primary">
                      <i class="fa fa-eye"></i>Set Batch
                    </a>
                  </div>
                </div>
                <div class="tile-body">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-8">
                          <b>
                            <a href="#">
                            PIPMS
                            </a> - Marlon Niño
                          </b>(Student)
                        </div>
                        <div class="col-md-4">
                          Oct 7, 2:30 PM
                        </div>
                      </div><hr>
                      <div class="row">
                        <div class="col-md-8">
                          <b>
                            <a href="#">
                            PIPMS
                            </a> - Marlon Niño</b> <br>
                          Student
                          of BSIT-CCIS-PUP Main
                        </div>
                        <div class="col-md-4">
                          Time: Oct 7, 2:30 PM
                        </div>
                      </div><hr>  
                      <div class="row">
                        <div class="col-md-8">
                          <b>
                            <a href="#">
                            PIPMS
                            </a> - Marlon Niño</b> <br> 
                          Student
                          of BSIT-CCIS-PUP Main
                        </div>
                        <div class="col-md-4">
                          Time: Oct 7, 2:30 PM
                        </div>
                      </div><hr>  
                      <div class="row">
                        <div class="col-md-8">
                          <b>
                            <a href="#">
                            PIPMS
                            </a> - Marlon Niño</b> <br> 
                          Student
                          of BSIT-CCIS-PUP Main
                        </div>
                        <div class="col-md-4">
                          Time: Oct 7, 2:30 PM
                        </div>
                      </div><hr>  
                      <div class="row">
                        <div class="col-md-8">
                          <b>
                            <a href="#">
                            PIPMS
                            </a> - Marlon Niño</b> <br> 
                          Student
                          of BSIT-CCIS-PUP Main
                        </div>
                        <div class="col-md-4">
                          Time: Oct 7, 2:30 PM
                        </div>
                      </div><hr>  
                      <div class="row">
                        <div class="col-md-8">
                          <b>
                            <a href="#">
                            PIPMS
                            </a> - Marlon Niño</b> <br> 
                          Student
                          of BSIT-CCIS-PUP Main
                        </div>
                        <div class="col-md-4">
                          Time: Oct 7, 2:30 PM
                        </div>
                      </div><hr>    
                    </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="tile">
                <div class="row">
                  <div class="col-md-9">
                    <h4 class="tile-title text-muted">
                      CCIS - PUP Main
                    </h4>
                  </div>
                  <div class="col-md-3">
                    <a href="{{ route('admin.today') }}" class="btn btn-primary">
                      <i class="fa fa-eye"></i>Set Batch
                    </a>
                  </div>
                </div>
                <div class="tile-body">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-8">
                          <b>
                            <a href="#">
                            PIPMS
                            </a> - Marlon Niño
                          </b>(Student)
                        </div>
                        <div class="col-md-4">
                          Oct 7, 2:30 PM
                        </div>
                      </div><hr>
                      <div class="row">
                        <div class="col-md-8">
                          <b>
                            <a href="#">
                            PIPMS
                            </a> - Marlon Niño</b> <br>
                          Student
                          of BSIT-CCIS-PUP Main
                        </div>
                        <div class="col-md-4">
                          Time: Oct 7, 2:30 PM
                        </div>
                      </div><hr>  
                      <div class="row">
                        <div class="col-md-8">
                          <b>
                            <a href="#">
                            PIPMS
                            </a> - Marlon Niño</b> <br> 
                          Student
                          of BSIT-CCIS-PUP Main
                        </div>
                        <div class="col-md-4">
                          Time: Oct 7, 2:30 PM
                        </div>
                      </div><hr>  
                      <div class="row">
                        <div class="col-md-8">
                          <b>
                            <a href="#">
                            PIPMS
                            </a> - Marlon Niño</b> <br> 
                          Student
                          of BSIT-CCIS-PUP Main
                        </div>
                        <div class="col-md-4">
                          Time: Oct 7, 2:30 PM
                        </div>
                      </div><hr>  
                      <div class="row">
                        <div class="col-md-8">
                          <b>
                            <a href="#">
                            PIPMS
                            </a> - Marlon Niño</b> <br> 
                          Student
                          of BSIT-CCIS-PUP Main
                        </div>
                        <div class="col-md-4">
                          Time: Oct 7, 2:30 PM
                        </div>
                      </div><hr>  
                      <div class="row">
                        <div class="col-md-8">
                          <b>
                            <a href="#">
                            PIPMS
                            </a> - Marlon Niño</b> <br> 
                          Student
                          of BSIT-CCIS-PUP Main
                        </div>
                        <div class="col-md-4">
                          Time: Oct 7, 2:30 PM
                        </div>
                      </div><hr>    
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
<script>
  $(document).ready(function(){
    $('#li-transaction').addClass('is-expanded');
    $('a[href="/admin/transaction/patents/pend-request"]').addClass('active');
  });
</script>
@endsection