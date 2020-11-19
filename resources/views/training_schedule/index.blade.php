@extends('layouts.app')

@section('content')
     @include('users.partials.header', ['title' => __('Training Schedule')])
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
            @can('isManager')
            <div>
            <a class="btn btn-success" href="{{ route('trainingScheduleSummary.index') }}">
            <i class="fas fa-chart-line"></i> {{ __('View Summarry') }}
           </a>     
            </div>
            @endcan
            @can('isAdmin')
            <div>
            <a class="btn btn-success" href="{{ route('trainingScheduleSummary.index') }}">
            <i class="fas fa-chart-line"></i> {{ __('View Summarry') }}
           </a>     
            </div>
            @endcan
            </br>
        
                <div class="card bg-white shadow">
                
                    <div class="card-body">
                      <div id="calendar" style="height: 800px;"></div>  
                    </br>
                      <div id="color_legend">
                      <p id='erro'></p>
                    <table>
                    <tr>
                      <td>
                      <p><i class="fas fa-circle" style="color:#32b67a;"></i>&nbsp;Traning events &nbsp;&nbsp;</p><!--green-->
                      </td>
                    
                      <td>
                      <p><i class="fas fa-circle" style="color:#f7c027;"></i>&nbsp;Government holidays &nbsp;&nbsp;</p><!--yellow-->
                      </td>
                    </tr>
                    </table>
                    </div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
     
         <h4 class="modal-title font-bold text-primary" style="font-size:18px" ></h4>
      </div>
      <div class="modal-body">
      <div class="py-3 text-center" >
      <h1 id="holititle" class="font-italic text-primary"></h1>
      </div>
      <form id="editEventForm" method="post"  autocomplete="off">
       @csrf
      <table id="tableeve" class=" font-bold text-primary">
                    <tr>
                    <td>
                      <p>Event title :</p><!--green-->
                      </td>
                      <td>
                      <p id="event-title"></p><!--green-->
                      </td>
      </tr>
      <tr>
                    <td>
                      <p>Start date & time :</p><!--green-->
                      </td>
                      <td>
                      <p id="event-startdt"></p><!--green-->
                      </td>
      </tr>
      <tr>
                    <td>
                      <p>End date & time :</p><!--green-->
                      </td>
                      <td>
                      <p id="event-enddt"></p><!--green-->
                      </td>
      </tr>
      </table>
       
       
       <input type="number" name="eventId" id="input-eventId" style="visibility:hidden;">
      </div>
      <div class="modal-footer">
      @can('isManager')
        <button id="edit_btn"  type="submit" formaction="{{ route('trainingScheduleEdit') }}" name="edit" class="btn btn-primary" style="visibility:hidden;">Edit event</button>
        <button id="delete_btn" type="submit" name="delete" formaction="{{ route('trainingSchedule.delete') }}" class="btn btn-primary" style="visibility:hidden;">Delete Event</button>
        @endcan  
      @can('isAdmin')
        <button id="edit_btn"  type="submit" formaction="{{ route('trainingScheduleEdit') }}" name="edit" class="btn btn-primary" style="visibility:hidden;">Edit event</button>
        <button id="delete_btn" type="submit" name="delete" formaction="{{ route('trainingSchedule.delete') }}" class="btn btn-primary" style="visibility:hidden;">Delete Event</button>
        @endcan 
      <button id="close_btn" type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </form>
      </div>
    </div>

  </div>
</div>
<!-- Modal end -->

<!-- Modal -->
<div id="addEventModel" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add New Training Session</h4>
      </div>
      <div class="modal-body">
      <form id="addEventForm" method="post" action="{{ route('trainingSchedule.store') }}" autocomplete="off">
                            @csrf
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Title') }}</label>
                                    <input type="text" name="title"  maxlength="100" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{ old('title') }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                 
                                <div class="form-group{{ $errors->has('start') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-start">{{ __('Start') }}</label>
                                    <input type="datetime-local" name="start" id="input-start" class="form-control form-control-alternative{{ $errors->has('start') ? ' is-invalid' : '' }}" placeholder="{{ __('Start') }}" value="{{ old('start') }}" required autofocus>

                                    
                                </div>
                                <div class="form-group{{ $errors->has('end') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-end">{{ __('End') }}</label>
                                    <input type="datetime-local" name="end" id="input-end" class="form-control form-control-alternative{{ $errors->has('end') ? ' is-invalid' : '' }}" placeholder="{{ __('End') }}" value="{{ old('end') }}" required autofocus>

                                    
                                </div>
                               
                                <div class="form-group{{ $errors->has('assignesto') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-assignesto">{{ __('Assignes to') }}</label>
                                    <select multiple size="3" name="assignesto[]" id="input-assignesto" class="form-control form-control-alternative{{ $errors->has('assignesto') ? ' is-invalid' : '' }}" placeholder="{{ __('Assignes to') }}"   autofocus>

                                    @foreach($assignees_array as $key)
                                     
                                    <option value="{{ $key->id }}">{{ $key->name }}</option>

                                    @endforeach
                                    </select>
                                    
                                </div>
                                <div class="form-group{{ $errors->has('conducted_by') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-conducted_by">{{ __('Conducted by') }}</label>
                                    <select name="conducted_by" id="input-conducted_by" class="form-control form-control-alternative{{ $errors->has('conducted_by') ? ' is-invalid' : '' }}" placeholder="{{ __('Conducted by') }}"  autofocus>

                                    @foreach($assignees_array as $key)
                                     
                                    <option value="{{ $key->id }}">{{ $key->name }}</option>

                                    @endforeach
                                    </select>
                        
                                </div>
                                <div class="form-group{{ $errors->has('location') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-location">{{ __('location') }}</label>
                                    <input type="text"  maxlength="255" name="location" id="input-location" class="form-control form-control-alternative{{ $errors->has('location') ? ' is-invalid' : '' }}" placeholder="{{ __('location') }}" value="{{ old('location') }}"  autofocus>

                                    @if ($errors->has('location'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('location') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('notes') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-notes">{{ __('notes') }}</label>
                                    <input type="text"  maxlength="255" name="notes" id="input-notes" class="form-control form-control-alternative{{ $errors->has('notes') ? ' is-invalid' : '' }}" placeholder="{{ __('notes') }}" value="{{ old('notes') }}"  autofocus>

                                    @if ($errors->has('notes'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('notes') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <p id='test'></p>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                                    <button id="close" type="button" class="btn btn-primary mt-4" data-dismiss="modal">Close</button>
                                </div>
                            </div>
      </form>
      </div>
    </div>

  </div>
</div>
<!-- Modal end -->
                    </div> 
                    </div>
                </div>
            </div>
        </div>
        <script>


document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          googleCalendarApiKey: 'AIzaSyDTUBG88AAWMD3BOy-AwcgdeVqq3GpYDDk',
    plugins: [ 'dayGrid', 'timeGrid', 'list','interaction','bootstrap','rrule','moment','googleCalendar'  ],
    themeSystem: 'bootstrap',
    timeZone: 'Asia/Colombo',
    height: 'auto',
    fixedWeekCount:false,
    slotDuration: '00:15:00',
    slotLabelInterval:'01:00:00',
    navLinks:true,
    nowIndicator: true,
    selectable: true,
    selectMirror:true,
    slotLabelFormat:{
  hour: 'numeric',
  minute: '2-digit',
  omitZeroMinute: false,
  
},
businessHours: {
// days of week. an array of zero-based day of week integers (0=Sunday)
daysOfWeek: [ 1, 2, 3, 4, 5, 6 ], // Monday - saturday

startTime: '09:00', // a start time 
endTime: '16:00', // an end time 
},
    views: {
      listDay: { buttonText: 'Todays training sessions' },
      listWeek: { buttonText: 'This week training sessions' },
      listMonth: { buttonText: 'This month training sessions' }
    },
    footer:{
      center: 'listDay listWeek listMonth'
    },
    header: {
      left: 'prevYear,prev,next,nextYear today',
      center: 'title',
      right: 'addEventButton dayGridMonth,timeGridWeek,timeGridDay'
    },
   
eventSources: [
{
events:{!! $ce !!},
id:'personal',
color: '#32b67a',//green
},
{ 
googleCalendarId: 'en.lk#holiday@group.v.calendar.google.com',
id:'google',
color: '#f7c027',//yellow
}
],
customButtons: {
@can('isManager')
    addEventButton: {
      text: 'Add Training Session ',
      click: function() {
        $( "#addEventModel" ).modal('toggle');
      }
    }
 @endcan 
@can('isAdmin')
    addEventButton: {
      text: 'Add Training Session ',
      click: function() {
        $( "#addEventModel" ).modal('toggle');
      }
    }
 @endcan                           
  },
  eventLimit: true,
eventClick: function(info) {
info.jsEvent.preventDefault(); // don't let the browser navigate
if(info.event.source.id=='google'){
 
  $('.modal-title').html('Holiday/Public Event');
  $('#holititle').html(info.event.title);
$('#holititle').css('visibility', 'visible');
 $('#tableeve').css('visibility', 'hidden')
 $('#event-startdt').css('visibility', 'hidden')
 $('#event-enddt').css('visibility', 'hidden')
$('#edit_btn').css('visibility', 'hidden');
  $('#delete_btn').css('visibility', 'hidden');
  $( "#myModal" ).modal('toggle');
  
}else{
   $('.modal-title').html('User added Event');
  $('#edit_btn').val(info.event.id);
  $('#edit_btn').css('visibility', 'visible');
  $('#delete_btn').css('visibility', 'visible');
$('#holititle').css('visibility', 'hidden');
$('#tableeve').css('visibility', 'visible')
 $('#event-startdt').css('visibility', 'visible')
 $('#event-enddt').css('visibility', 'visible')
  $('#input-eventId').val(info.event.id);
  $('#event-title').html(info.event.title);
 $('#event-startdt').html(info.event.start);
 $('#event-enddt').html(info.event.end);
  $( "#myModal" ).modal('toggle');
}
},
}); 
     
calendar.render();

 $('input[type=datetime-local][name=start]').change(function() {
 if (this.value) {
 $('#input-end').prop('min', this.value);
 }
 });
var err =@json($err);
if(err!=null){
$('#erro').text(err);
}

});


</script>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')

    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

@endpush