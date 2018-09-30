@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-bell-o"></i> Notifications</h1>
	<p>Communicate with the faculties and clients</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item"><a href="{{ route('admin.notifications') }}">Notifications</a></li>
 @endsection
@section('content')
<div class="tile">
	<div class="tile-body">
		<ul class="nav nav-tabs">
		    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#all">All</a></li>
		    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#unread">Unread</a></li>
		    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#read">Read</a></li>
		</ul>
		<div class="tab-content" id="myTabContent">
		    <div class="tab-pane fade active show" id="all">
		      <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
		    </div>
		    <div class="tab-pane fade" id="unread">
		      <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit.</p>
		    </div>
		    <div class="tab-pane fade" id="read">
		    	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		    	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		    	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		    	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		    	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		    	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		    </div>
		</div>
	</div>
</div>
@endsection