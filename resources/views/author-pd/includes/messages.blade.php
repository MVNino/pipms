@if(count($errors) > 0)
	@foreach($errors->all() as $error)
		<div class="alert alert-dismissible alert-danger">
	        <button class="close" type="button" data-dismiss="alert">×</button>
			{{$error}}
		</div>
	@endforeach
@endif

@if(session('success'))
	<div class="alert alert-dismissible alert-success">
   		<button class="close" type="button" data-dismiss="alert">×</button>
		{{session('success')}}
	</div>
@endif

@if(session('error'))
	<div class="alert alert-dismissible alert-danger alert-rounded">
        <button class="close" type="button" data-dismiss="alert">×</button>
		{{session('error')}}
	</div>
@endif