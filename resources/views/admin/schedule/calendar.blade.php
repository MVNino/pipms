@extends('admin.layouts.app')

@section('pg-title')
<h1><i class="fa fa-calendar"></i> Calendar</h1>
	<p>Full calendar page for managing personal and organizational events</p>
@endsection
@section('breadcrumb-label')
<li class="breadcrumb-item"><a href="/admin/calendar">Calendar</a></li>
 @endsection
@section('content')
<div class="row">
  <div class="tile tile-body">
    {!! $calendar_details->calendar() !!}
  </div>
</div>
@endsection

@section('pg-specific-js')
<!-- Page specific javascripts-->
<script type="text/javascript" src="{{ asset('vali/js/plugins/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/jquery-ui.custom.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vali/js/plugins/fullcalendar.min.js') }}"></script>
{!! $calendar_details->script() !!}
<script type="text/javascript">



  $(document).ready(function() {
  
  	$('#external-events .fc-event').each(function() {
  
  		// store data so the calendar knows to render an event upon drop
  		$(this).data('event', {
  			title: $.trim($(this).text()), // use the element's text as the event title
  			stick: true // maintain when user navigates (see docs on the renderEvent method)
  		});
  
  		// make the event draggable using jQuery UI
  		$(this).draggable({
  			zIndex: 999,
  			revert: true,      // will cause the event to go back to its
  			revertDuration: 0  //  original position after the drag
  		});
  
  	});
  
  	$('#calendar').fullCalendar({
  		header: {
  			left: 'prev,next today',
  			center: 'title',
  			right: 'month,agendaWeek,agendaDay'
  		},
  		editable: true,
  		droppable: true, // this allows things to be dropped onto the calendar
  		drop: function() {
  			// is the "remove after drop" checkbox checked?
  			if ($('#drop-remove').is(':checked')) {
  				// if so, remove the element from the "Draggable Events" list
  				$(this).remove();
  			}
  		}
  	});  
  });
</script>

<!-- Page specific javascripts-->
<script>
  $(document).ready(function(){
    $('#li-schedule').addClass('is-expanded');
    $('a[href="{{ route('schedule.calendar') }}"]').addClass('active');
  });
</script>
@endsection