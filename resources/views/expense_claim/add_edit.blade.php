@extends('layouts.app')

@section('content')
   @include('users.partials.header', ['title' => __('Add/Edit expense claim requests ')])
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card bg-white shadow">
                    <div class="card-body">
                    <form id="addEventForm" method="post" enctype="multipart/form-data" action="{{ route('expenseClaim.store') }}" autocomplete="off">
                            @csrf
                        <div class="pl-lg-4">
                            <input type="text" name="claim_id_" id="input-claim_id" hidden>
                            <div class="form-group{{ $errors->has('bill') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-bill">{{ __('Receipt/Bill') }}</label>
                                <input type="file" accept=".jpg, .png, .doc, .docx, .xls, .xlsx, .pdf, .txt, .rtf, .bmp, .tiff" name="bill" id="input-bill" class="form-control form-control-alternative{{ $errors->has('bill') ? ' is-invalid' : '' }}" required autofocus>
                            
                        </div>
                            <div class="form-group{{ $errors->has('reason') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-reason">{{ __('Reason') }}</label>
                                    <input type="text" name="reason" maxlength="255" id="input-reason" class="form-control form-control-alternative{{ $errors->has('reason') ? ' is-invalid' : '' }}" placeholder="{{ __('Reason') }}"  required autofocus>

                                    @if ($errors->has('reason'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('reason') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <div class="form-group{{ $errors->has('date_') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-date_">{{ __('Date') }}</label>
                                    <input type="date" name="date_"  id="input-date_" class="form-control form-control-alternative{{ $errors->has('date_') ? ' is-invalid' : '' }}" placeholder="{{ __('Date') }}" required autofocus>

                                    @if ($errors->has('date_'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('date_') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-amount">{{ __('Bill Amount') }}</label>
                                    <input type="number" step=".01" min="0" name="amount" id="input-amount" class="form-control form-control-alternative{{ $errors->has('amount') ? ' is-invalid' : '' }}" placeholder="{{ __('Bill amount') }}" required autofocus>

                                    @if ($errors->has('amount'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('amount') }}</strong>
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

    var claim_id = @json($claimid);
    var val = @json('add');
     if(claim_id!=val){ 
    var values=@json($claim_req);
       $("#input-reason").val(values.reason);
        $("#input-date_").val(values.date);
      $("#input-amount").val(values.amount);  
     }
 $("#input-claim_id").val(claim_id);        
      
});

</script>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')

    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

@endpush