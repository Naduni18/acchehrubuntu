@extends('layouts.app')

@section('content')
     @include('users.partials.header', ['title' => __('Salary Records')])
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
            
           
         
                <div class="card bg-white shadow">
                    <div class="card-body">
                    @if($rec!=null)
                    <table id="myTable" class="table align-items-center  table-bordered" >
            <thead>
            <tr>
             <td>Employee name:</td>
            <td>{{ $rec->name}}</td>
            </tr>
            <tr>
             <td>Employee designation:</td>
            <td>{{ $rec->designation}}</td>
            </tr>
           
            </thead>
                            </table>
                    @else
                    <br>
                    <br>
                    <p>Your salary details for this month isn't available yet.</p>
                    @endif
                </div></div>
            <br><br>
 <div class="card bg-white shadow">
                    <div class="card-body">
             
     <div style="padding:10px;">
                            <form action="" enctype="multipart/form-data">
                            <div class="form-group{{ $errors->has('for_year') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-for_year">{{ __('For year') }}</label>
                                    <input type="number" min="2000" max="2100" name="for_year" id="input-for_year" class="form-control form-control-alternative{{ $errors->has('for_year') ? ' is-invalid' : '' }}" required autofocus>

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
                               
                             <button formaction="{{ route('salary.payslip') }}" class="btn btn-primary mt-4" type="submit">Download monthly pay slip</button>
    </form>
                    </div>
                     </div>
            </div>
        </div>
    </div>

        @include('layouts.footers.auth')
    </div>

@endsection

@push('js')

    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

@endpush