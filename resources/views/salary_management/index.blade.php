@extends('layouts.app')

@section('content')
     @include('users.partials.header', ['title' => __('Salary Management')])
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
            
           
         
                <div class="card bg-white shadow">
                    <div class="card-body">
                     
                            
                         
                         
                         
                            
                    <div >
                    <form  method="post">
                     @csrf
                                          
                    @method('post')
                    
                     <input type="number" name="SalId" value ="0" id="input-SalId" style="visibility:hidden;" >
                    
                    
                    <div class="row "> 
                     <div class="col">
                                    <label class="form-control-label" for="input-employeetoadd">{{ __('Select employee to add new record:') }}</label>
                     </div>
                    <div class="col-5">  
                                    <select  name="employeetoadd" id="input-employeetoadd" class="form-control form-control-alternative{{ $errors->has('employeetoadd') ? ' is-invalid' : '' }}" placeholder="{{ __('employeetoadd') }}"  autofocus>

                                    @foreach($employees_array as $key)
                                     
                                    <option value="{{ $key->id }}">{{ $key->name }}</option>

                                    @endforeach
                                    </select>
                                    
                                </div>
                    <div class="col">                  
                    <button formaction="{{ route('salary.edit') }}" name="add" type="submit" class="btn btn-primary" >
                    {{ __('Add new Record') }}
                    </button>
                    </div>
                    
                    </form>
                    </div>
                    <br><br>
            <p class="bg-danger text-white" id="error1" style="visibility:hidden;" ></p>
                    </div>
                </div>
               
            <br><br>
 <div class="card bg-white shadow">
                    <div class="card-body">
  <h>Salary records for this month onwords</h>
<div class="table-responsive">
 

          
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
            <tr>
            <!--td>@sortablelink('id')</td-->
            <th> <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'id','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>Id</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'id','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'emp_id','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>Employee id</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'emp_id','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'name','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>Name</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'name','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'designation','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>designation</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'designation','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'branch','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>branch</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'branch','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'department','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>department</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'department','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'for_year','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>for_year</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'for_year','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>	
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'for_month','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>for_month</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'for_month','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>	
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'date','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>date</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'date','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>	
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'basic_salary','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>basic_salary</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'basic_salary','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'variable_allowance','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>variable_allowance</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'variable_allowance','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'incentice','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>incentice</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'incentice','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'holiday_allowance','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>holiday_allowance</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'holiday_allowance','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>	
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'commission','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>commission</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'commission','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>	
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'phone_allowance','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>phone_allowance</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'phone_allowance','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>	
           
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'gross_salary','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>gross salary</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'gross_salarye','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>	
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'epf_employe_cont','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>epf_employe_cont</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'epf_employe_cont','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>	
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'salary_advanc','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>salary_advance</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'salary_advanc','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'telephone_deduction','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>telephone_deduction</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'telephone_deduction','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'no_pay','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>no_pay</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'no_pay','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'staff_loan','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>staff_loan</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'staff_loan','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>	
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'paye_tax','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>paye_tax</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'paye_tax','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>	
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'total_deductions','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>total deductions</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'total_deductions','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>	
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'net_salary','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>net salary</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'net_salary','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>	
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'epf_company_cont','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>epf_company_cont</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'epf_company_cont','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>	
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'etf_company_cont','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>etf_company_cont</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'etf_company_cont','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>	
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'remitted_amount','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>remitted_amount</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'remitted_amount','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>	
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'remitted_account_no','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>remitted_account_no</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'remitted_account_no','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>	
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'bank','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>bank</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'bank','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'bank_branch','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>bank_branch</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'bank_branch','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>	
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'EPF_number','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>EPF_number</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'EPF_number','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>	
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'created_at','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>created_at</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'created_at','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>	
            
            <th><a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'updated_at','order'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>updated_at</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('salary', ['sort' => 'updated_at','order'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a> </th>
            <th><p style='display:inline-block'>Edit</p></th>
                
            </tr>
            </thead>
            @if(count($salary))
            @foreach($salary as $record)
                <tr >
                    <td>{{$record->id}}</td>
                    <td>{{$record->emp_id}}</td>
                <td>{{$record->name}}</td>		
                <td>{{$record->designation}}</td>	
                <td>{{$record->branch}}</td>	
                <td>{{$record->department}}</td>	
                <td>{{$record->for_year}}</td>	
                <td>{{$record->for_month}}</td>	
                <td>{{$record->date}}</td>	
                <td>{{$record->basic_salary}}</td>	
                <td>{{$record->variable_allowance}}</td>	
                <td>{{$record->incentice}}</td>	
                <td>{{$record->holiday_allowance}}</td>	
                <td>{{$record->commission}}</td>	
                <td>{{$record->phone_allowance}}</td>
                <td>{{$record->gross_salary}}</td>
                <td>{{$record->epf_employe_cont}}</td>	
                <td>{{$record->salary_advance}}</td>	
                <td>{{$record->telephone_deduction}}</td>	
                <td>{{$record->no_pay}}</td>	
                <td>{{$record->staff_loan}}</td>	
                <td>{{$record->paye_tax}}</td>	
                <td>{{$record->total_deductions}}</td>	
                <td>{{$record->net_salary}}</td>	
                <td>{{$record->epf_company_cont}}</td>	
                <td>{{$record->etf_company_cont}}</td>	
                <td>{{$record->remitted_amount}}</td>	
                <td>{{$record->remitted_account_no}}</td>	
                <td>{{$record->bank}}</td>	
                <td>{{$record->bank_branch}}</td>	
                <td>{{$record->EPF_number}}</td>	
                <td>{{$record->created_at}}</td>	
                <td>{{$record->updated_at}}</td>
                <td class="text-left">
                 @can('isAdmin')
                   <form id="editEventForm" method="post"  autocomplete="off">
       @csrf
      
       
       <input type="number" name="SalId" value ="<?=$record->id?>" id="input-SalId" style="visibility:hidden;" >
      
      <div>
     
        <button id="edit_btn"  type="submit" formaction="{{ route('salary.edit') }}" name="edit" class="btn btn-icon btn-primary" ><i class="fas fa-edit"></i></button>
                </div>
                </form>
                @endcan
                </td>
    
                    
                </tr>
            @endforeach
        @if(count($salary)>10)
       {{ $salary->links() }}
        @endif
            @else
            <tr>
                    <td></td>
                    <td></td>
            <td></td>
            
                    <td></td>
            <td></td>
                    <td></td>
            <td></td>
                    <td></td>
            <td></td>
                    <td></td>
            <td></td>
                    <td></td>
            <td></td>
                    <td></td>
            <td></td>
                    <td></td>
            <td></td>
                    <td></td>
            <td></td>
                    <td></td>
            <td></td>
                    <td></td>
            <td></td>
                    <td></td>
            <td></td>
                    <td></td>
            <td></td>
                    <td></td>
            <td></td>
            <td></td>
                    <td></td>
            <td></td>
                    
                    
                </tr>
            @endif 
        </table>

    </div>
                    </div>
                </div>
                <br><br>
 <div class="card bg-white shadow">
                    <div class="card-body">
                    </br>
    
    <div style="padding:10px;">
    <form action="" enctype="multipart/form-data">
     <button formaction="{{ route('salary.export') }}" class="btn btn-primary mt-4" type="submit">Download all this year salary records</button>
    </form>
                    </div>
                    </br>
                </div>
                </div>
        <br><br>
 <div class="card bg-white shadow">
                    <div class="card-body">
             
     <div style="padding:10px;">
                            <form action="" enctype="multipart/form-data">
                            <div class="form-group{{ $errors->has('for_year') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-for_year">{{ __('For year') }}</label>
                                    <input type="number" min="2000" max="2100" name="for_year" id="input-for_year" class="form-control form-control-alternative{{ $errors->has('for_year') ? ' is-invalid' : '' }}" autofocus>

                                    @if ($errors->has('for_year'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('for_year') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                 <div class="form-group{{ $errors->has('for_month') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-for_month">{{ __('For month') }}</label>
                                    
                                    <select name="for_month" id="input-for_month" class="form-control form-control-alternative{{ $errors->has('for_month') ? ' is-invalid' : '' }}" autofocus>
  
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
                               
                             <button formaction="{{ route('salary.export_month') }}" class="btn btn-primary mt-4" type="submit">Download monthly salary records</button>
    </form>
                    </div>
                     </div>
            </div>
                </div>
            </div>
        </div>
<script>
document.addEventListener('DOMContentLoaded', function() {

var err = @json($error_);

     if(err!=null){ 
 $("#error1").css('visibility', 'visible');
 $("#error1").text(err);
     
     }
     });
</script>
    </div>

        @include('layouts.footers.auth')
    </div>

@endsection

@push('js')

    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

@endpush