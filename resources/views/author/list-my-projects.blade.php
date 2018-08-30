@extends('author.layouts.app')

@section('pg-title')
<h1><i class="fa fa-book"></i> My Projects</h1>
	<p>A listing of my projects requested for copyright & patent</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item"><a href="/author/apply-patent-project">Patent Application</a></li>
@endsection
@section('content')


@endsection
@section('pg-specific-js')
<!-- Laravel ckeditor-->
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
<script>
$(document).ready(function(){
	$('a[href="/author/my-projects"]').addClass('active');
});
</script>
@endsection