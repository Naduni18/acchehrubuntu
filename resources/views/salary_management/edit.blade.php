@extends('layouts.app')

@section('content')
    @include('users.partials.header', ['title' => __('Add/Edit Salary record')])
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card bg-white shadow">
                    <div class="card-body">
                        
                            <div style="overflow:auto;">
   

        <table id="myTable" class="table align-items-center  table-bordered" >
            <thead>
            <tr>
             <td>Employee name:</td>
            <td id="employee-name"></td>
            </tr>
            <tr>
             <td>Employee designation:</td>
            <td id="employee-designation"></td>
            </tr>
            <tr>
             <td>Employee branch:</td>
            <td id="employee-branch"></td>
            </tr>
            <tr>
             <td>Employee department:</td>
            <td id="employee-department"></td>
            </tr>
            <tr>
             <td>Bank:</td>
            <td id="bank"></td>
            </tr>
            <tr>
             <td>Bank branch:</td>
            <td id="branch"></td>
            </tr>
            <tr>
             <td>Epf number:</td>
            <td id="epf-number"></td>
            </tr>
            
            </thead>
                            </table>
             <br>
                            <div class="p-3 mb-2 bg-danger text-white"><strong>
                            Check whether bank account number,bank is uptodate or not before you adding new record. If they are not uptodate you should update them via edit user page before adding new salary records</strong></div>
                         
                         
                            </div>
                            </br>
      </br>
      <form id="addEventForm" method="post" enctype="multipart/form-data" action="{{ route('salary.store') }}" autocomplete="off">
                            @csrf
                            <div class="pl-lg-4">
                            <input type="number" name="id" id="input-id"  hidden>
                              <input type="number" name="empid" id="input-empid"  hidden>

    
                                <div class="form-group{{ $errors->has('for_year') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-for_year">{{ __('For year') }}</label>
                                    <input type="number" min="2018" max="2100" name="for_year" id="input-for_year" class="form-control form-control-alternative{{ $errors->has('for_year') ? ' is-invalid' : '' }}" autofocus>

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
                      <div class="form-group{{ $errors->has('datee') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-datee">{{ __('Date') }}</label>
                                    <input type="date" name="datee" id="input-datee" class="form-control form-control-alternative{{ $errors->has('datee') ? ' is-invalid' : '' }}" placeholder="{{ __('datee') }}" autofocus>

                                    @if ($errors->has('datee'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('datee') }}</strong>
                                        </span>
                                    @endif
                                </div>
                     <div class="form-group{{ $errors->has('basic_salary') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-basic_salary">{{ __('basic_salary') }}</label>
                                    <input type="number" min="0" step=".01" name="basic_salary" id="input-basic_salary" class="form-control form-control-alternative{{ $errors->has('basic_salary') ? ' is-invalid' : '' }}" placeholder="{{ __('basic_salary') }}" autofocus>

                                    @if ($errors->has('basic_salary'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('basic_salary') }}</strong>
                                        </span>
                                    @endif
                                </div>
                     <div class="form-group{{ $errors->has('variable_allowance') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-variable_allowance">{{ __('variable_allowance') }}</label>
                                    <input type="number" min="0" step=".01" name="variable_allowance" id="input-variable_allowance" class="form-control form-control-alternative{{ $errors->has('variable_allowance') ? ' is-invalid' : '' }}" placeholder="{{ __('variable_allowance') }}" autofocus>

                                    @if ($errors->has('variable_allowance'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('variable_allowance') }}</strong>
                                        </span>
                                    @endif
                                </div>
                    <div class="form-group{{ $errors->has('incentice') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-incentice">{{ __('incentice') }}</label>
                                    <input type="number" min="0" step=".01" name="incentice" id="input-incentice" class="form-control form-control-alternative{{ $errors->has('incentice') ? ' is-invalid' : '' }}" placeholder="{{ __('incentice') }}" autofocus>

                                    @if ($errors->has('incentice'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('incentice') }}</strong>
                                        </span>
                                    @endif
                                </div>
                     <div class="form-group{{ $errors->has('holiday_allowance') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-holiday_allowance">{{ __('holiday_allowance') }}</label>
                                    <input type="number" min="0" step=".01" name="holiday_allowance" id="input-holiday_allowance" class="form-control form-control-alternative{{ $errors->has('holiday_allowance') ? ' is-invalid' : '' }}" placeholder="{{ __('holiday_allowance') }}" autofocus>

                                    @if ($errors->has('holiday_allowance'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('holiday_allowance') }}</strong>
                                        </span>
                                    @endif
                                </div>
                     <div class="form-group{{ $errors->has('commission') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-commission">{{ __('commission') }}</label>
                                    <input type="number" min="0" step=".01" name="commission" id="input-commission" class="form-control form-control-alternative{{ $errors->has('commission') ? ' is-invalid' : '' }}" placeholder="{{ __('commission') }}" autofocus>

                                    @if ($errors->has('commission'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('commission') }}</strong>
                                        </span>
                                    @endif
                                </div>
                    <div class="form-group{{ $errors->has('phone_allowance') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-phone_allowance">{{ __('phone_allowance') }}</label>
                                    <input type="number" min="0" step=".01" name="phone_allowance" id="input-phone_allowance" class="form-control form-control-alternative{{ $errors->has('phone_allowance') ? ' is-invalid' : '' }}" placeholder="{{ __('phone_allowance') }}" autofocus>

                                    @if ($errors->has('phone_allowance'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone_allowance') }}</strong>
                                        </span>
                                    @endif
                                </div>

                    <div class="form-group{{ $errors->has('telephone_deduction') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-telephone_deduction">{{ __('telephone_deduction') }}</label>
                                    <input type="number" min="0" step=".01" name="telephone_deduction" id="input-telephone_deduction" class="form-control form-control-alternative{{ $errors->has('telephone_deduction') ? ' is-invalid' : '' }}" placeholder="{{ __('telephone_deduction') }}" autofocus>

                                    @if ($errors->has('telephone_deduction'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('telephone_deduction') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            <div class="form-group{{ $errors->has('no_pay') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-no_pay">{{ __('no pay') }}</label>
                                    <input type="number" min="0" step=".01" name="no_pay" id="input-no_pay" class="form-control form-control-alternative{{ $errors->has('no_pay') ? ' is-invalid' : '' }}" placeholder="{{ __('no_pay') }}" autofocus>

                                    @if ($errors->has('no_pay'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('no_pay') }}</strong>
                                        </span>
                                    @endif
                                </div>
                     
                    <div class="form-group{{ $errors->has('staff_loan') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-staff_loan">{{ __('staff_loan') }}</label>
                                    <input type="number" min="0" step=".01" name="staff_loan" id="input-staff_loan" class="form-control form-control-alternative{{ $errors->has('staff_loan') ? ' is-invalid' : '' }}" placeholder="{{ __('staff_loan') }}" autofocus>

                                    @if ($errors->has('staff_loan'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('staff_loan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                    <div class="form-group{{ $errors->has('paye_tax') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-paye_tax">{{ __('paye_tax') }}</label>
                                    <input type="number" min="0" step=".01" name="paye_tax" id="input-paye_tax" class="form-control form-control-alternative{{ $errors->has('paye_tax') ? ' is-invalid' : '' }}" placeholder="{{ __('paye_tax') }}" autofocus>

                                    @if ($errors->has('paye_tax'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('paye_tax') }}</strong>
                                        </span>
                                    @endif
                                </div>
                     <span class="text-Default text-center">
<strong style="font-size:12px;">Salary is calculte by assuming month start date as 1st and end date as 30/31/28/29 th accordingly.
                                            </strong>
                                        </span>
                            <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }}</button>
                                   </div>
      </div> 
      </form>
     <br><br>

</div> 
         <div class="card bg-white shadow">
                    <div class="card-body">
                    <h>No pay leave/Absence records</h>
        <table id="nopayt" class="table align-items-center  table-bordered" >
            <thead>
            
            <tr>
             <td>No pay full day leave count:</td>
            <td id="epf-number">{{ $leavefull }}</td>
            </tr>
            <tr>
             <td>No pay half day leave count:</td>
            <td id="epf-number">{{ $leavehalf }}</td>
            </tr>
            <tr>
             <td>No pay short leave count:</td>
            <td id="epf-number">{{ $leaveshort }}</td>
            </tr>
            <tr>
             <td>Absence days without a leave request count:</td>
            <td id="epf-number">{{ $Absence }}</td>
            </tr>
            </thead>
            <table>
            
                    </div>
                </div>
                    </div>
                </div>
            </div>
        </div>
        <script>


document.addEventListener('DOMContentLoaded', function() {
   
       

// var d = typeof(values.date).toString();

var salID = @json($salID);
 
 var values_ = @json($employee_);
    


     if(salID!=0){ 
 var val=@json($sal_to_edit);
    
 $("#input-id").val(val.id);
$("#input-for_month").val(val.for_month);
$("#input-for_year").val(val.for_year);
$("#input-datee").val(val.date);
$("#input-basic_salary").val(val.basic_salary);
$("#input-variable_allowance").val(val.variable_allowance); 
$("#input-incentice").val(val.incentice);
$("#input-holiday_allowance").val(val.holiday_allowance);
$("#input-commission").val(val.commission);
$("#input-phone_allowance").val(val.phone_allowance);
$("#input-telephone_deduction").val(val.telephone_deduction);
$("#input-no_pay").val(val.no_pay);
$("#input-staff_loan").val(val.staff_loan);
$("#input-paye_tax").val(val.paye_tax);

      $('#input-for_month').prop('disabled', true); 
      $('#input-for_year').prop('disabled', true); 
     }else{
     $("#input-id").val("0");
     }
$("#input-empid").val(values_.id);
$( "#employee-name" ).text( values_.name);
$( "#employee-designation" ).text( values_.current_job_position);
$( "#employee-branch" ).text( values_.branch);
$( "#employee-department" ).text( values_.department);
$( "#bank" ).text( values_.bank);
$( "#branch" ).text( values_.bank_branch);
$( "#epf-number" ).text( values_.EPF_number); 
});

</script>
        @include('layouts.footers.auth')
    
    </div>
@endsection

@push('js')

    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

@endpush