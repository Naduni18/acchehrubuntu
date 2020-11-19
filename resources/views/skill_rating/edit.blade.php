@extends('layouts.app')

@section('content')
    @include('users.partials.header', ['title' => __('Edit employee ratings')])
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card bg-white shadow">
                    <div class="card-body">

      <form id="addEventForm" method="post" enctype="multipart/form-data" action="{{ route('skill_rating.store') }}" autocomplete="off">
                            @csrf
                            <div class="pl-lg-4">
                            <input type="text" name="emp_to_rate_id_" id="input-emp_to_rate_id" value={{$emp_to_rate_id}} hidden>

                            
                                <div class="form-group{{ $errors->has('file_receivings') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-file_receivings">{{ __('file_receivings') }}</label>
                                    <input type="number" min="0" name="file_receivings" id="input-file_receivings" class="form-control form-control-alternative{{ $errors->has('file_receivings') ? ' is-invalid' : '' }}" autofocus>

                                    @if ($errors->has('file_receivings'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('file_receivings') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('offers') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-offers">{{ __('offers') }}</label>
                                    <input type="number" min="0" name="offers" id="input-offers" class="form-control form-control-alternative{{ $errors->has('offers') ? ' is-invalid' : '' }}" autofocus>

                                    @if ($errors->has('offers'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('offers') }}</strong>
                                        </span>
                                    @endif
                                </div>
                
                                <div class="form-group{{ $errors->has('visa_grants') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-visa_grants">{{ __('visa_grants') }}</label>
                                    <input type="number" min="0" name="visa_grants" id="input-visa_grants" class="form-control form-control-alternative{{ $errors->has('visa_grants') ? ' is-invalid' : '' }}" autofocus>

                                    @if ($errors->has('visa_grants'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('visa_grants') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('IELTS_class_registrations') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-IELTS_class_registrations">{{ __('IELTS_class_registrations') }}</label>
                                    <input type="number" min="0" name="IELTS_class_registrations" id="input-IELTS_class_registrations" class="form-control form-control-alternative{{ $errors->has('IELTS_class_registrations') ? ' is-invalid' : '' }}" autofocus>

                                    @if ($errors->has('IELTS_class_registrations'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('IELTS_class_registrations') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('IELTS_exam_registrations') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-IELTS_exam_registrations">{{ __('IELTS_exam_registrations') }}</label>
                                    <input type="number" min="0" name="IELTS_exam_registrations" id="input-IELTS_exam_registrations" class="form-control form-control-alternative{{ $errors->has('IELTS_exam_registrations') ? ' is-invalid' : '' }}" autofocus>

                                    @if ($errors->has('IELTS_exam_registrations'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('IELTS_exam_registrations') }}</strong>
                                        </span>
                                    @endif
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
   
        var values=@json($emp_to_rate);

       // $("#input-emp_to_rate_id").val(values.id);

        $("#input-file_receivings").val(values.file_receivings);  
        $("#input-offers").val(values.offers); 
        $("#input-visa_grants").val(values.visa_grants);  
        $("#input-IELTS_class_registrations").val(values.IELTS_class_registrations); 
        $("#input-IELTS_exam_registrations").val(values.IELTS_exam_registrations);  
        $("#input-total_kpi").val(values.total_kpi);    
           
});

</script>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')

    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

@endpush