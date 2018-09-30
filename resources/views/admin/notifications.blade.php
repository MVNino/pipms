@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-bell-o"></i> Notifications</h1>
	<p>Communicate with the faculties and clients</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item"><a href="{{ route('admin.notifications') }}">Notifications</a></li>
 @endsection
@section('content')
	THIS IS NOTIF!
@endsection