@extends('layouts.app')

@section('content')
     @include('users.partials.header', ['title' => __('Edit training event')])
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card bg-white shadow">
                    <div class="card-body">
                    <form id="addEventForm" method="post" action="{{ route('trainingScheduleEdit.store') }}" autocomplete="off">
                            @csrf
                            <div class="pl-lg-4">
                            <input type="number" name="eventId" id="input-eventId" value="{{ $old_event['id'] }}" style="visibility:hidden;">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Title') }}</label>
                                    <div class="row">
                                    <div class="col">
                                    <input type="text" name="title" maxlength="255" value={{ $old_event['title'] }} id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{ __('Title') }}" value="{{ $old_event['title'] }}" required autofocus>
                                    </div>
                                   
                                    </div>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                
                                <div class="form-group{{ $errors->has('startTime') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-startTime">{{ __('Start Time') }}</label>
                                    <div class="row">
                                    <div class="col">
                                    <input type="datetime-local" name="startTime"  id="input-startTime" class="form-control form-control-alternative{{ $errors->has('startTime') ? ' is-invalid' : '' }}" placeholder="{{ __('Start Time') }}" value="{{ old('startTime') }}" autofocus>
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
                                    <input type="datetime-local" name="endTime"  id="input-endTime" class="form-control form-control-alternative{{ $errors->has('endTime') ? ' is-invalid' : '' }}" placeholder="{{ __('End Time') }}" value="{{ old('endTime') }}" autofocus>
                                    </div>
                                    
                                    </div>
                                    @if ($errors->has('endTime'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('endTime') }}</strong>
                                        </span>
                                    @endif
                                </div>
                               
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
                                    
                                </div>

                                <div class="form-group{{ $errors->has('conducted_by') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-conducted_by">{{ __('Conducted by') }}</label>
                                    <div class="row">
                                    <div class="col">
                                    <select name="conducted_by" id="input-conducted_by" class="form-control form-control-alternative{{ $errors->has('conducted_by') ? ' is-invalid' : '' }}" placeholder="{{ __('conducted_by') }}"  required autofocus>

                                    @foreach($assignees_array as $key)
                                     
                                    <option value="{{ $key->id }}">{{ $key->name }}</option>

                                    @endforeach
                                    </select>
                                    </div>
                                    
                                    </div>
                                    
                                </div>
                                <div class="form-group{{ $errors->has('location') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-location">{{ __('location') }}</label>
                                    <div class="row">
                                    <div class="col">
                                    <input type="text" name="location" maxlength="255" value={{ $old_event['location'] }} id="input-location" class="form-control form-control-alternative{{ $errors->has('location') ? ' is-invalid' : '' }}" placeholder="{{ __('location') }}" value="{{ $old_event['location'] }}" required autofocus>
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
                                    <input type="text" name="notes" maxlength="255" value={{ $old_event['notes'] }} id="input-notes" class="form-control form-control-alternative{{ $errors->has('notes') ? ' is-invalid' : '' }}" placeholder="{{ __('notes') }}" value="{{ $old_event['notes'] }}" required autofocus>
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
           var dstart = old_event.startTime;
var dstart_split_array = dstart.split(" ");
var time_dstart = dstart_split_array[1].substring(0, 5);
var date_start = dstart_split_array[0]+"T"+time_dstart;
    
     $("#input-startTime").val(date_start);

   
var dend = old_event.endTime;
var dend_split_array = dend.split(" ");
var time_dend = dend_split_array[1].substring(0, 5);
var date_end = dend_split_array[0]+"T"+time_dend;
    
     $("#input-endTime").val(date_end); 
        
 $("#input-conducted_by option[value="+old_event.conducted_by+"]").prop("selected", true);
   
        for(i=0;i<old_event.assigned_to_array.length;i++){
$("#input-assignesto option[value="+old_event.assigned_to_array[i]+"]").prop("selected", true); 
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