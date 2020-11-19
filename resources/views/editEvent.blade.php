@extends('layouts.app')

@section('content')
   
     @include('users.partials.header', ['title' => __('Edit event')]) 
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card bg-white shadow">
                    <div class="card-body">
                    <form id="addEventForm" method="post" action="{{ route('editEvent.store') }}" autocomplete="off">
                            @csrf
                            <div class="pl-lg-4">
                            <input type="number" name="eventId" id="input-eventId" value="{{ $old_event['id'] }}" style="visibility:hidden;">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Title') }}</label>
                                    <div class="row">
                                    <div class="col">
                                    <input type="text" name="title" maxlength="100" value="{{ $old_event['title'] }}" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}"  required autofocus>
                                    </div>
                                    
                                    </div>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                    <div class="row">
                                    <div class="col">
                                    <input type="text" name="description" maxlength="255" id="input-description" class="form-control form-control-alternative{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" value="{{ $old_event['description'] }}" required autofocus>
                                    </div>
                                    
                                    </div>
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                 
                                
                                <fieldset style="border:groove;padding:5px;" id="one">
                                <legend style="font-size:12px;">  &nbsp&nbsp&nbsp&nbsp One day event </legend>
                                
                                <div class="form-group{{ $errors->has('start') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-start">{{ __('Start') }}</label>
                                    <div class="row">
                                    <div class="col">
                                    <input type="datetime-local" name="start" id="input-start" class="form-control form-control-alternative{{ $errors->has('start') ? ' is-invalid' : '' }}" placeholder="{{ __('Start') }}" required autofocus>
                                    </div>
                                    
                                    </div>
                                    @if ($errors->has('start'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('start') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('end') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-end">{{ __('End') }}</label>
                                    <div class="row">
                                    <div class="col">
                                    <input type="datetime-local" name="end" id="input-end" class="form-control form-control-alternative{{ $errors->has('end') ? ' is-invalid' : '' }}" placeholder="{{ __('End') }}"  required autofocus>
                                    </div>
                                    
                                    </div>
                                    @if ($errors->has('end'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('end') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                </fieldset>
                                <fieldset style="border:groove;padding:5px;" id="rec">
                                <legend style="font-size:12px;">  &nbsp&nbsp&nbsp&nbsp Recurring event </legend>
                                <div class="form-group{{ $errors->has('startTime') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-startTime">{{ __('Start Time') }}</label>
                                    <div class="row">
                                    <div class="col">
                                    <input type="time" name="startTime" id="input-startTime" class="form-control form-control-alternative{{ $errors->has('startTime') ? ' is-invalid' : '' }}" placeholder="{{ __('Start Time') }}" value="{{ old('startTime') }}" required autofocus>
                                    </div>
                                    
                                    </div>
                                    @if ($errors->has('startTime'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('startTime') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('endTime') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-endTime">{{ __('End Time') }}</label>
                                    <div class="row">
                                    <div class="col">
                                    <input type="time" name="endTime" id="input-endTime" class="form-control form-control-alternative{{ $errors->has('endTime') ? ' is-invalid' : '' }}" placeholder="{{ __('End Time') }}" value="{{ old('endTime') }}" required autofocus>
                                    </div>
                                    
                                    </div>
                                    @if ($errors->has('endTime'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('endTime') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div  class="form-group{{ $errors->has('startRecur') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-startRecur">{{ __('Start Recurring') }}</label>
                                    <div class="row">
                                    <div class="col">
                                    <input type="date"  name="startRecur" id="input-startRecur" class="form-control form-control-alternative{{ $errors->has('startRecur') ? ' is-invalid' : '' }}" placeholder="{{ __('Start Recurring') }}" value="{{ old('startRecur') }}" required autofocus>
                                    </div>
                                    
                                    </div>
                                    @if ($errors->has('startRecur'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('startRecur') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('endRecur') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-endRecur">{{ __('End Recurring') }}</label>
                                    <div class="row">
                                    <div class="col">
                                    <input type="date" name="endRecur" id="input-endRecur" class="form-control form-control-alternative{{ $errors->has('endRecur') ? ' is-invalid' : '' }}" placeholder="{{ __('End Recurring') }}" value="{{ old('endRecur') }}" required autofocus>
                                    </div>
                                    
                                    </div>
                                    @if ($errors->has('endRecur'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('endRecur') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('daysOfWeek') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-daysOfWeek">{{ __('Days of week') }}</label>
                                    <div class="row">
                                    <div class="col">
                                    <select multiple size="7" name="daysOfWeek[]" id="input-daysOfWeek" class="form-control form-control-alternative{{ $errors->has('daysOfWeek') ? ' is-invalid' : '' }}" placeholder="{{ __('days Of Week') }}" required  autofocus>
  
                                    <option value="0">Sunday</option>
                                    <option value="1">Monday</option>
                                    <option value="2">Tuesday</option>
                                    <option value="3">Wednesday</option>
                                    <option value="4">Thursday</option>
                                    <option value="5">Friday</option>
                                    <option value="6">Saturday</option>

                                    
                                    </select>
                                    </div>
                                   
                                    </div>
                                    @if ($errors->has('daysOfWeek'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('daysOfWeek') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                </fieldset>
                                <div class="form-group{{ $errors->has('assignesto') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-assignesto">{{ __('assignes to') }}</label>
                                    <div class="row">
                                    <div class="col">
                                    <select multiple size="3" name="assignesto[]" id="input-assignesto" class="form-control form-control-alternative{{ $errors->has('assignesto') ? ' is-invalid' : '' }}" placeholder="{{ __('assignesto') }}"  required autofocus>

                                    @foreach($assignees_array as $key)
                                     
                                    <option value="{{ $key->id }}">{{ $key->name }}</option>

                                    @endforeach
                                    </select>
                                    </div>
                                    
                                    </div>
                                    @if ($errors->has('assignesto'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('assignesto') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('location') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-location">{{ __('location') }}</label>
                                    <div class="row">
                                    <div class="col">
                                    <input type="text" name="location" maxlength="255"id="input-location" class="form-control form-control-alternative{{ $errors->has('location') ? ' is-invalid' : '' }}" placeholder="{{ __('location') }}" value="{{ $old_event['location'] }}" required autofocus>
                                    </div>
                                    
                                    </div>
                                    @if ($errors->has('location'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('location') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('notes') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-notes">{{ __('notes') }}</label>
                                    <div class="row">
                                    <div class="col">
                                    <input type="text" name="notes" maxlength="255" id="input-notes" class="form-control form-control-alternative{{ $errors->has('notes') ? ' is-invalid' : '' }}" placeholder="{{ __('notes') }}" value="{{ $old_event['notes'] }}" required autofocus>
                                    </div>
                                    
                                    </div>
                                    @if ($errors->has('notes'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('notes') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('notes') ? ' has-danger' : '' }}">
                                    
                                    <p style="font-size:14px;padding: 10px;">Event created by: {{ $old_event['assigned_by_detail'] }}</p>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                                    
                                </div>
                            </div>
      </form>
  
                    </div> 
                    </div>
                </div>
            </div>
        </div>
         <script>


document.addEventListener('DOMContentLoaded', function() {

    var old_event = @json($old_event);
if(old_event.start == null){
$('#one').remove();
 $('#input-startTime').change(function() {
 if (this.value) {

 $('#input-endTime').prop('min',this.value );
 }
 });
 $('#input-startRecur').change(function() {
 if (this.value) {
 $('#input-endRecur').prop('min', this.value);
 }
 });  


$("#input-startTime").val(old_event.startTime);
$("#input-endTime").val(old_event.endTime);
$("#input-startRecur").val(old_event.startRecur);
$("#input-endRecur").val(old_event.endRecur);
if(old_event.daysOfWeek.includes("Sunday")){
$("#input-daysOfWeek option[value='0']").prop("selected", true);
}else if(old_event.daysOfWeek.includes("Monday")){
       $("#input-daysOfWeek option[value='1']").prop("selected", true);  
         }else if(old_event.daysOfWeek.includes("Tuesday")){
       $("#input-daysOfWeek option[value='2']").prop("selected", true);  
         }else if(old_event.daysOfWeek.includes("Wednesday")){
       $("#input-daysOfWeek option[value='3']").prop("selected", true);  
         }else if(old_event.daysOfWeek.includes("Thursday")){
       $("#input-daysOfWeek option[value='4']").prop("selected", true);  
         }else if(old_event.daysOfWeek.includes("Friday")){
       $("#input-daysOfWeek option[value='5']").prop("selected", true);  
         }else if(old_event.daysOfWeek.includes("Saturday")){
       $("#input-daysOfWeek option[value='6']").prop("selected", true);  
         }
for(i=0;i<old_event.assigned_to_array.length;i++){
$("#input-assignesto option[value="+old_event.assigned_to_array[i]+"]").prop("selected", true); 
}
}else{
 $('#rec').remove();
 $('#input-start').change(function() {
 if (this.value) {
 $('#input-end').prop('min', this.value);
 }
 });
      
      
       
var dstart = old_event.start;
var dstart_split_array = dstart.split(" ");
var time_dstart = dstart_split_array[1].substring(0, 5);
var date_start = dstart_split_array[0]+"T"+time_dstart;
    
     $("#input-start").val(date_start);

   
var dend = old_event.end;
var dend_split_array = dend.split(" ");
var time_dend = dend_split_array[1].substring(0, 5);
var date_end = dend_split_array[0]+"T"+time_dend;
    
     $("#input-end").val(date_end);
for(i=0;i<old_event.assigned_to_array.length;i++){
$("#input-assignesto option[value="+old_event.assigned_to_array[i]+"]").prop("selected", true); 
}
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