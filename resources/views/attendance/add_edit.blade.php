@extends('layouts.app')

@section('content')
     @include('users.partials.header', ['title' => __('Add/Edit missing attendance request')])
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card bg-white shadow">
                
                    <div class="card-body">

      <form id="addEventForm" method="post" action="{{ route('attendance.store') }}" autocomplete="off">
                            @csrf
                            <div class="pl-lg-4">
                            <input type="text" name="att_id_" id="input-att_id" hidden>

                                <div class="form-group{{ $errors->has('reason') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-reason">{{ __('Reason') }}</label>
                                    <input type="text" name="reason" maxlength="100" id="input-reason" class="form-control form-control-alternative{{ $errors->has('reason') ? ' is-invalid' : '' }}" placeholder="{{ __('Reason') }}" value="{{ old('reason') }}" required autofocus>

                                    @if ($errors->has('reason'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('reason') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('date') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-date">{{ __('Date') }}</label>
                                    <input type="date" name="date" id="input-date" class="form-control form-control-alternative{{ $errors->has('date') ? ' is-invalid' : '' }}" placeholder="{{ __('Date') }}" value="{{ old('date') }}" required autofocus>

                                    @if ($errors->has('date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('start') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-start">{{ __('Start(morning in)') }}</label>
                                    <input type="time" name="start" id="input-start" class="form-control form-control-alternative{{ $errors->has('start') ? ' is-invalid' : '' }}" placeholder="{{ __('Start') }}"  autofocus>

                                    @if ($errors->has('start'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('start') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            <div class="form-group{{ $errors->has('startmid') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-startmid">{{ __('Start(morning out)') }}</label>
                                    <input type="time" name="startmid" id="input-startmid" class="form-control form-control-alternative{{ $errors->has('startmid') ? ' is-invalid' : '' }}" placeholder="{{ __('Startmid') }}"  autofocus>

                                    @if ($errors->has('startmid'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('startmid') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('endmid') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-endmid">{{ __('End(afternoon in)') }}</label>
                                    <input type="time" name="endmid" id="input-endmid" class="form-control form-control-alternative{{ $errors->has('endmid') ? ' is-invalid' : '' }}" placeholder="{{ __('Endmid') }}" autofocus>

                                    @if ($errors->has('endmid'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('endmid') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('end') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-end">{{ __('End(afternoon out)') }}</label>
                                    <input type="time" name="end" id="input-end" class="form-control form-control-alternative{{ $errors->has('end') ? ' is-invalid' : '' }}" placeholder="{{ __('End') }}"  autofocus>

                                    @if ($errors->has('end'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('end') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div>
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

    var att_id = @json($attid);
    var val = @json('add');
 var values=@json($attendance_req);
     

$('#input-start').change(function() {
 if (this.value) {

 $('#input-startmid').prop('min', this.value);
 }
 });

 $('#input-startmid').change(function() {
 if (this.value) {

 $('#input-endmid').prop('min', this.value);
 
 }
 });

 $('#input-endmid').change(function() {
 if (this.value) {
 $('#input-end').prop('min', this.value);
 
 }
 });

$("#input-att_id").val(att_id);
    if(att_id!=val){
       
        $("#input-reason").val(values.reason);
        $("#input-date").val(values.date);
        $("#input-start").val(values.start);
         $("#input-startmid").val(values.startmid);
        $("#input-endmid").val(values.endmid);
        $("#input-end").val(values.end);
       
       
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