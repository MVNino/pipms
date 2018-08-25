@extends('layouts.admin')

@section('content')
	<h3>{{ $title }}</h3>

<script>
	$(document).ready(function(){
		$('#sidebar-reports').addClass('active');
	});
</script>
@endsection
