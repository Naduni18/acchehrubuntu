@extends('layouts.app')

@section('content')
    @include('users.partials.header', ['title' => __('Recruitment')])
    
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card bg-white shadow">
                <div class="card-body">
                    <form id="addCandidateForm" method="post" enctype="multipart/form-data" action="{{ route('recruitment.store') }}" autocomplete="off">
                            @csrf
                        <div class="pl-lg-4">
                            <input type="text" name="candidate_id_" id="input-candidate_id" hidden>
                            <div class="form-group{{ $errors->has('cv_document') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-cv_document">{{ __('CV') }}</label>
                                <input type="file" accept=".jpg, .png, .doc, .docx,.pdf, .txt, .rtf" name="cv_document" id="input-cv_document" class="form-control form-control-alternative{{ $errors->has('cv_document') ? ' is-invalid' : '' }}" required>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                <input type="text" name="name" maxlength="255" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" required  autofocus>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('NIC') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-NIC">{{ __('NIC') }}</label>
                                <input type="text" pattern="[0-9]{9}+[V]{1}|[0-9]{12}" name="NIC" id="input-NIC" class="form-control form-control-alternative{{ $errors->has('NIC') ? ' is-invalid' : '' }}" placeholder="{{ __('NIC') }}" required  autofocus>
                                @if ($errors->has('NIC'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('NIC') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" pattern="[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('applied_job_position') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-applied_job_position">{{ __('Applied Job Position') }}</label>
                                    <input type="text" maxlength="255" name="applied_job_position" id="input-applied_job_position" class="form-control form-control-alternative{{ $errors->has('applied_job_position') ? ' is-invalid' : '' }}" placeholder="{{ __('Applied Job Position') }}" autofocus>

                                    @if ($errors->has('applied_job_position'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('applied_job_position') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('first_interview_date') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-first_interview_date">{{ __('First Interview Date') }}</label>
                                    <input type="datetime-local" name="first_interview_date" id="input-first_interview_date" class="form-control form-control-alternative{{ $errors->has('first_interview_date') ? ' is-invalid' : '' }}" placeholder="{{ __('First interview date ') }}" autofocus>

                                    @if ($errors->has('first_interview_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('first_interview_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('second_interview_date') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-second_interview_date">{{ __('Second Interview Date') }}</label>
                                    <input type="datetime-local" name="second_interview_date" id="input-second_interview_date" class="form-control form-control-alternative{{ $errors->has('second_interview_date') ? ' is-invalid' : '' }}" placeholder="{{ __('Second Interview Date') }}"  autofocus>

                                    @if ($errors->has('second_interview_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('second_interview_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('interviewer') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-interviewer">{{ __('Interviewer') }}</label>
                                    <select  name="interviewer" id="input-interviewer" class="form-control form-control-alternative{{ $errors->has('interviewer') ? ' is-invalid' : '' }}"   autofocus>

                                    <option disabled selected value> -- select an option -- </option>
                                    @foreach($managers_array as $key) 
                                    <option value="{{ $key->id }}">{{ $key->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group{{ $errors->has('notes') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-notes">{{ __('Notes') }}</label>
                                    <input type="text" name="notes" maxlength="1000" id="input-notes" class="form-control form-control-alternative{{ $errors->has('notes') ? ' is-invalid' : '' }}" placeholder="{{ __('notes') }}" autofocus>

                                    @if ($errors->has('notes'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('notes') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('current_status') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-current_status">{{ __('Current Status') }}</label>
                                    
                                    <select name="current_status" id="input-current_status" class="form-control form-control-alternative{{ $errors->has('current_status') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Status') }}"  required autofocus>
  
                                    <option value="keeping_cv_for_future_vacancies">Keeping cv for future vacancies</option>
                                    <option value="cv_selected">CV selected</option>
                                    <option value="first_interview_passed">First interview passed</option>
                                    <option value="second_interview_passed">Second interview passed</option>
           
                                    </select>
                                    
                                    @if ($errors->has('current_status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('current_status') }}</strong>
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

    var candidate_id = @json($candidateid);
    var val = @json('add');
    
    if(candidate_id!=val){
        var values=@json($candidate_record);
       /*  $("#input-name").val(values.name);     
        $("#input-first_interview_date").val(values.first_interview_date);
        $("#input-second_interview_date").val(values.second_interview_date);
        $("#input-current_status").val(values.current_status); */
      
       
       
    }
    $("#input-candidate_id").val(candidate_id);
      
});

</script>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')

    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

@endpush