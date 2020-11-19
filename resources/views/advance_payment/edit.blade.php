@extends('layouts.app')

@section('content')
    @include('users.partials.header', ['title' => __('Add/Edit advance payment request')])
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card bg-white shadow">
                    <div class="card-body">

      <form id="addEventForm" method="post" enctype="multipart/form-data" action="{{ route('advance_payment.store') }}" autocomplete="off">
                            @csrf
                            <div class="pl-lg-4">
                            <input type="text" name="advance_id_" id="input-advance_id" hidden>

                            
                                <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-amount">{{ __('Amount') }}</label>
                                    <input type="number" step=".01" min="0" name="amount" id="input-amount" class="form-control form-control-alternative{{ $errors->has('amount') ? ' is-invalid' : '' }}" required autofocus>

                                    @if ($errors->has('amount'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('amount') }}</strong>
                                        </span>
                                    @endif
                                </div>
                
                                <div class="form-group{{ $errors->has('notes') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-notes">{{ __('Notes') }}</label>
                                    <input type="text" name="notes" maxlength="255" id="input-notes" class="form-control form-control-alternative{{ $errors->has('notes') ? ' is-invalid' : '' }}" placeholder="{{ __('notes') }}" autofocus>

                                    @if ($errors->has('notes'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('notes') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('for_year') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-for_year">{{ __('For year') }}</label>
                                    <input type="number" min="2020" name="for_year" id="input-for_year" class="form-control form-control-alternative{{ $errors->has('for_year') ? ' is-invalid' : '' }}" placeholder="{{ __('For year') }}" required autofocus>

                                    @if ($errors->has('for_year'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('for_year') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-group{{ $errors->has('for_month') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-for_month">{{ __('For month') }}</label>
                                    
                                    <select name="for_month" id="input-for_month" class="form-control form-control-alternative{{ $errors->has('for_month') ? ' is-invalid' : '' }}" required autofocus>
  
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                 
                                    </select>
                                    
                                    @if ($errors->has('for_month'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('for_month') }}</strong>
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

    var advance_id = @json($advanceid);
    var val = @json('add');
    
    if(advance_id!=val){
        var values=@json($advance_req);
        $("#input-amount").val(values.amount);     
        $("#input-notes").val(values.notes);
        $("#input-for_year").val(values.for_year);
        $("#input-for_month").val(values.for_month);
        
       
       
    }
    $("#input-advance_id").val(advance_id);
      
});

</script>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')

    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

@endpush