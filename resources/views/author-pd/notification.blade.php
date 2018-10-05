@extends('author-pd.layouts.app')


@section('content')
<div class="card">
	<div class="card-body">
		<ul class="nav nav-tabs">
		    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#all">All</a></li>
		    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#unread">Unread</a></li>
		    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#read">Read</a></li>
		</ul>
		<div class="tab-content" id="myTabContent">
		    <div class="tab-pane fade active show" id="all">
		        <div class="bs-component">
		          <div class="list-group">
		            @forelse(auth()->user()->notifications as $notification)
			            @if($notification->created_at->diffInDays(Carbon\Carbon::now()) == 0)
	                      @if($notification->created_at->diffInHours(Carbon\Carbon::now()) > 0)
	                        @if($notification->created_at->diffInHours(Carbon\Carbon::now()) == 1)
	                        <label class="list-group-item list-group-item-action">
				            	<strong>An hour ago</strong> - {!! $notification->data['data'] !!}
				            </label>
	                        @else
	                        <label class="list-group-item list-group-item-action">
				            	<strong>{{ $notification->created_at->diffInHours(Carbon\Carbon::now()) }} hours ago</strong> - {!! $notification->data['data'] !!}
				            </label>
	                        @endif
	                      @else
	                        @if($notification->created_at->diffInMinutes(Carbon\Carbon::now()) <= 1)
	                        <label class="list-group-item list-group-item-action">
				            	<strong>A minute ago</strong> - {!! $notification->data['data'] !!}
				            </label>
	                        @else
	                        <label class="list-group-item list-group-item-action">
				            	<strong>{{ $notification->created_at->diffInMinutes(Carbon\Carbon::now()) }} minutes ago
				            	</strong> - {!! $notification->data['data'] !!}
				            </label>
	                        @endif
	                      @endif                    
	                    @elseif($notification->created_at->diffInDays(Carbon\Carbon::now()) == 1)
	                	<label class="list-group-item list-group-item-action">
			            	<strong>Yesterday, {{ $notification->created_at->format('h:i:A') }}</strong> - {!! $notification->data['data'] !!}
			            </label>
	                    @elseif($notification->created_at->diffInDays(Carbon\Carbon::now()) == 2)
	                    <label class="list-group-item list-group-item-action">
			            	<strong>2 days ago at {{ $notification->created_at->format('h:i:A') }}</strong> - {!! $notification->data['data'] !!}
				        </label>
	                    @else
	                    <label class="list-group-item list-group-item-action">
			            	<strong>{{ $notification->created_at->format('M d')}}</strong> - {!! $notification->data['data'] !!}
				        </label>  
	                    @endif
	 
		            @empty
		            <a class="list-group-item list-group-item-action disabled" href="#">
		            	There is no notification yet.
		            </a>
		            @endforelse
		          </div>
		        </div>
		    </div>
		    <div class="tab-pane fade" id="unread">
		        <div class="bs-component">
		          <div class="list-group">
		            @forelse(auth()->user()->unReadNotifications as $notification)
			            @if($notification->created_at->diffInDays(Carbon\Carbon::now()) == 0)
	                      @if($notification->created_at->diffInHours(Carbon\Carbon::now()) > 0)
	                        @if($notification->created_at->diffInHours(Carbon\Carbon::now()) == 1)
	                        <label class="list-group-item list-group-item-action">
				            	<strong>An hour ago</strong> - {!! $notification->data['data'] !!}
				            </label>
	                        @else
	                        <label class="list-group-item list-group-item-action">
				            	<strong>{{ $notification->created_at->diffInHours(Carbon\Carbon::now()) }} hours ago</strong> - {!! $notification->data['data'] !!}
				            </label>
	                        @endif
	                      @else
	                        @if($notification->created_at->diffInMinutes(Carbon\Carbon::now()) <= 1)
	                        <label class="list-group-item list-group-item-action">
				            	<strong>A minute ago</strong> - {!! $notification->data['data'] !!}
				            </label>
	                        @else
	                        <label class="list-group-item list-group-item-action">
				            	<strong>{{ $notification->created_at->diffInMinutes(Carbon\Carbon::now()) }} minutes ago
				            	</strong> - {!! $notification->data['data'] !!}
				            </label>
	                        @endif
	                      @endif                    
	                    @elseif($notification->created_at->diffInDays(Carbon\Carbon::now()) == 1)
	                	<label class="list-group-item list-group-item-action">
			            	<strong>Yesterday, {{ $notification->created_at->format('h:i:A') }}</strong> - {!! $notification->data['data'] !!}
			            </label>
	                    @elseif($notification->created_at->diffInDays(Carbon\Carbon::now()) == 2)
	                    <label class="list-group-item list-group-item-action">
			            	<strong>2 days ago at {{ $notification->created_at->format('h:i:A') }}</strong> - {!! $notification->data['data'] !!}
				        </label>
	                    @else
	                    <label class="list-group-item list-group-item-action">
			            	<strong>{{ $notification->created_at->format('M d')}}</strong> - {!! $notification->data['data'] !!}
				        </label>  
	                    @endif
	 
		            @empty
		            <label class="list-group-item list-group-item-action disabled" href="#">
		            	There is no notification yet.
		            </label>
			          		
		            @endforelse
		          </div>
		        </div>
		    </div>
		    <div class="tab-pane fade" id="read">
		        <div class="bs-component">
		          <div class="list-group">
		            @forelse(auth()->user()->readNotifications as $notification)
			            @if($notification->created_at->diffInDays(Carbon\Carbon::now()) == 0)
	                      @if($notification->created_at->diffInHours(Carbon\Carbon::now()) > 0)
	                        @if($notification->created_at->diffInHours(Carbon\Carbon::now()) == 1)
	                        <label class="list-group-item list-group-item-action">
				            	<strong>An hour ago</strong> - {!! $notification->data['data'] !!}
				            </label>
	                        @else
	                        <label class="list-group-item list-group-item-action">
				            	<strong>{{ $notification->created_at->diffInHours(Carbon\Carbon::now()) }} hours ago</strong> - {!! $notification->data['data'] !!}
				            </label>
	                        @endif
	                      @else
	                        @if($notification->created_at->diffInMinutes(Carbon\Carbon::now()) <= 1)
	                        <label class="list-group-item list-group-item-action">
				            	<strong>A minute ago</strong> - {!! $notification->data['data'] !!}
				            </label>
	                        @else
	                        <label class="list-group-item list-group-item-action">
				            	<strong>{{ $notification->created_at->diffInMinutes(Carbon\Carbon::now()) }} minutes ago
				            	</strong> - {!! $notification->data['data'] !!}
				            </label>
	                        @endif
	                      @endif                    
	                    @elseif($notification->created_at->diffInDays(Carbon\Carbon::now()) == 1)
	                	<label class="list-group-item list-group-item-action">
			            	<strong>Yesterday, {{ $notification->created_at->format('h:i:A') }}</strong> - {!! $notification->data['data'] !!}
			            </label>
	                    @elseif($notification->created_at->diffInDays(Carbon\Carbon::now()) == 2)
	                    <label class="list-group-item list-group-item-action">
			            	<strong>2 days ago at {{ $notification->created_at->format('h:i:A') }}</strong> - {!! $notification->data['data'] !!}
				        </label>
	                    @else
	                    <label class="list-group-item list-group-item-action">
			            	<strong>{{ $notification->created_at->format('M d')}}</strong> - {!! $notification->data['data'] !!}
				        </label>  
	                    @endif
	 
		            @empty
		            <label class="list-group-item list-group-item-action disabled" href="#">
		            	There is no notification yet.
		            </label>	
		            @endforelse
		          </div>
		        </div>
		    </div>
		</div>
	</div>
</div>
@endsection