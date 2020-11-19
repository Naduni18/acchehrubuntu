@extends('layouts.app')

@section('content')
    @include('users.partials.header', ['title' => __('Add/Edit leave requests')])
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card bg-white shadow">
                    <div class="card-body">

      <form id="addEventForm" method="post" enctype="multipart/form-data" action="{{ route('leave.store') }}" autocomplete="off">
                            @csrf
                            <div class="pl-lg-4">
                            <input type="text" name="leave_id_" id="input-leave_id" hidden>

                            <div class="form-group{{ $errors->has('leave_document') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-leave_document">{{ __('Document') }}</label>
                                    <input type="file" accept=".jpg, .png, .doc, .docx, .xls, .xlsx, .pdf, .txt, .rtf, .bmp, .tiff" name="leave_document" id="input-leave_document" class="form-control form-control-alternative{{ $errors->has('leave_document') ? ' is-invalid' : '' }}" >
                                </div>
                                <div class="form-group{{ $errors->has('reason') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-reason">{{ __('Reason') }}</label>
                                    <input type="text" name="reason" maxlength="255" id="input-reason" class="form-control form-control-alternative{{ $errors->has('reason') ? ' is-invalid' : '' }}" placeholder="{{ __('Reason') }}" required autofocus>

                                    @if ($errors->has('reason'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('reason') }}</strong>
                                        </span>
                                    @endif
                                </div>
                
                                <div class="form-group{{ $errors->has('date_') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-date_">{{ __('Date') }}</label>
                                    <input type="date" name="date_" id="input-date_" class="form-control form-control-alternative{{ $errors->has('date_') ? ' is-invalid' : '' }}" placeholder="{{ __('date') }}" autofocus>

                                    @if ($errors->has('date_'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('date_') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('start') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-start">{{ __('Start time') }}</label>
                                    <input type="time" name="start" id="input-start" class="form-control form-control-alternative{{ $errors->has('start') ? ' is-invalid' : '' }}" placeholder="{{ __('Start date') }}" autofocus>

                                    @if ($errors->has('start'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('start') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('end') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-end">{{ __('End time') }}</label>
                                    <input type="time" name="end" id="input-end" class="form-control form-control-alternative{{ $errors->has('end') ? ' is-invalid' : '' }}" placeholder="{{ __('End date') }}"  autofocus>

                                    @if ($errors->has('end'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('end') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('category') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-category">{{ __('Category') }}</label>
                                    
                                    <select name="category" id="input-category" class="form-control form-control-alternative{{ $errors->has('category') ? ' is-invalid' : '' }}" placeholder="{{ __('Category') }}"   autofocus>
  
                                    <option value="full day">Full day</option>
                                    <option value="half day">Half day</option>
                                    <option value="short leave">Short leave</option>
           
                                    </select>
                                    
                                    @if ($errors->has('category'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('category') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-type">{{ __('Type') }}</label>
                                    
                                    <select name="type" id="input-type" class="form-control form-control-alternative{{ $errors->has('type') ? ' is-invalid' : '' }}" placeholder="{{ __('Type') }}"   autofocus>
  
                                    <option value="no pay">No pay</option>
                                    <option value="sick">Sick</option>
                                    <option value="annual">Annual</option>
                 
                                    </select>
                                    
                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
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

    var leave_id = @json($leaveid);
    var val = @json('add');
    
    if(leave_id!=val){
        var values=@json($leave_req);
        $("#input-reason").val(values.reason);  
        $("#input-date_").val(values.date_);
        $("#input-start").val(values.start);
        $("#input-end").val(values.end);
        $("#input-category").val(values.category);
        $("#input-type").val(values.type);
       
       
    }
    $("#input-leave_id").val(leave_id);
      
});

</script>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')

    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

@endpush