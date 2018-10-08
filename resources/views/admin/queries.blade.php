@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-history"></i> Queries</h1>
  <p>System Queries</p>
@endsection

@section('breadcrumb-label')
<li class="breadcrumb-item">Queries</li>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<h3 class="tile-header">hehe</h3>
			<div class="tile-body">
				
			</div>
			<div class="tile-footer">
				wewew
			</div>
		</div>
	</div>
</div>
@endsection

@section('pg-specific-js')
<script>
    var pan = null;
    $(document).ready(function (){
        $('#query').addClass('active');
        $('#list1').DataTable({
            responsive: true,
            ordering: false
        });
        $('#list2').DataTable({
            responsive: true,
            ordering: false
        });
        $('#list3').DataTable({
            responsive: true,
            ordering: false
        });
        $('#list4').DataTable({
            responsive: true,
            ordering: false
        });
        $('#list5').DataTable({
            responsive: true,
        });
        $('#list6').DataTable({
            responsive: true,
        });
    });
    $('#queryId').on('change', function() {          
        if(pan!=null){
            $(pan).addClass('hidden');
        }
        pan = $('.pan'+$(this).val()).removeClass('hidden');
    });
</script>
@endsection