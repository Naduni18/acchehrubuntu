@extends('layouts.app')

@section('content')
   @include('users.partials.header', ['title' => __('Rate employees')])
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card bg-white shadow">
                    <div class="card-body">
                    @can('isManager')
                    <form id="addEventForm" method="post" action="{{ route('skill_rating.index2') }}" autocomplete="off">
                    @csrf
                                          
                    @method('post')
                    <div class="form-group{{ $errors->has('employeeTorate') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-employeeTorate">{{ __('Select employee to rate:') }}</label>
                                    <select  name="employeeTorate" id="input-employeeTorate" class="form-control form-control-alternative{{ $errors->has('employeeTorate') ? ' is-invalid' : '' }}" placeholder="{{ __('Assignes to') }}"  autofocus>

                                    @foreach($employees_array as $key)
                                     
                                    <option value="{{ $key->id }}">{{ $key->name }}</option>

                                    @endforeach
                                    </select>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary mt-4">{{ __('Rate') }}</button>
                                </div>
                            </div>
      </form>
      @endcan
      @can('isAdmin')
      <form id="addEventForm" method="post" action="{{ route('skill_rating.index2') }}" autocomplete="off">
                    @csrf
                                          
                    @method('post')
                    <div class="form-group{{ $errors->has('employeeTorate') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-employeeTorate">{{ __('Select employee to rate:') }}</label>
                                    <select  name="employeeTorate" id="input-employeeTorate" class="form-control form-control-alternative{{ $errors->has('employeeTorate') ? ' is-invalid' : '' }}" placeholder="{{ __('Assignes to') }}"  autofocus>

                                    @foreach($employees_array_all as $key)
                                     
                                    <option value="{{ $key->id }}">{{ $key->name }}</option>

                                    @endforeach
                                    </select>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary mt-4">{{ __('Rate') }}</button>
                                </div>
                            </div>
      </form>
      @endcan
      <br> 
                    <div class="table-responsive">
                    @can('isManager')
                        <table class="table align-items-center table-flush" id="empratetable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col">{{ __('File Receivings') }}</th>
                                    <th scope="col">{{ __('Offers') }}</th>
                                    <th scope="col">{{ __('Visa Grants') }}</th>
                                    <th scope="col">{{ __('IELTS Class Registrations') }}</th>
                                    <th scope="col">{{ __('IELTS Exam Registrations') }}</th>
                                    <th scope="col">{{ __('Total KPI points') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($emp_rating_array as $emp_rating)
                               
                                    <tr>
                                        <td>{{ $emp_rating['name']}}</td>
                                        <td>{{ $emp_rating['file_receivings'] }}</td>
                                        <td>{{ $emp_rating['offers'] }}</td>
                                        <td>{{ $emp_rating['visa_grants'] }}</td>
                                        <td>{{ $emp_rating['IELTS_class_registrations'] }}</td>
                                        <td>{{ $emp_rating['IELTS_exam_registrations'] }}</td>
                                        <td>{{ $emp_rating['total_kpi'] }}</td>
                                        
                                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endcan
      @can('isAdmin')

      <table class="table align-items-center table-flush" id="empratetable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col"><p style='display:inline-block'>{{ __('Name') }}</p></th>
                                    <th><a class="nav-link" style='display:inline-block' href="{{ route('skill_rating', ['sort1' => 'file_receivings','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>{{ __('File Receivings') }} </p>
            <a class="nav-link" style='display:inline-block' href="{{ route('skill_rating', ['sort1' => 'file_receivings','order1'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            
                                    <th><a class="nav-link" style='display:inline-block' href="{{ route('skill_rating', ['sort1' => 'offers','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>{{ __('Offers') }}</p>
            <a class="nav-link" style='display:inline-block' href="{{ route('skill_rating', ['sort1' => 'offers','order1'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
             <th><a class="nav-link" style='display:inline-block' href="{{ route('skill_rating', ['sort1' => 'visa_grants','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>{{ __('Visa Grants') }} </p>
            <a class="nav-link" style='display:inline-block' href="{{ route('skill_rating', ['sort1' => 'visa_grants','order1'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            
                  <th><a class="nav-link" style='display:inline-block' href="{{ route('skill_rating', ['sort1' => 'IELTS_class_registrations','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>{{ __('IELTS Class Registrations') }} </p>
            <a class="nav-link" style='display:inline-block' href="{{ route('skill_rating', ['sort1' => 'IELTS_class_registrations','order1'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            <th><a class="nav-link" style='display:inline-block' href="{{ route('skill_rating', ['sort1' => 'IELTS_exam_registrations','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>{{ __('IELTS Exam Registrations') }} </p>
            <a class="nav-link" style='display:inline-block' href="{{ route('skill_rating', ['sort1' => 'IELTS_exam_registrations','order1'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            <th><a class="nav-link" style='display:inline-block' href="{{ route('skill_rating', ['sort1' => 'total_kpi','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>{{ __('Total KPI points') }} </p>
            <a class="nav-link" style='display:inline-block' href="{{ route('skill_rating', ['sort1' => 'total_kpi','order1'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            
                                  
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employee_rating_all as $emp_rating)
                               
                                    <tr>
                                    <td>@php
                                        $val =  \App\Http\Controllers\SkillRatingController::get_user_name($emp_rating->emp_id);
                                        $jsonval =json_encode($val);
                                        $finalval = json_decode($jsonval, true);
                                        echo $finalval['name'];
                                        @endphp
                                        </td>
                                        <td>{{ $emp_rating->file_receivings }}</td>
                                        <td>{{ $emp_rating->offers }}</td>
                                        <td>{{ $emp_rating->visa_grants }}</td>
                                        <td>{{ $emp_rating->IELTS_class_registrations}}</td>
                                        <td>{{ $emp_rating->IELTS_exam_registrations }}</td>
                                        <td>{{ $emp_rating->total_kpi }}</td>
                                        
                                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

      @endcan
                        </div>
            <br><br>
            <!--table class="table align-items-center table-flush" id="empratetable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col"><p style='display:inline-block'>{{ __('Name') }}</p></th>
                                <th scope="col"><p style='display:inline-block'>{{ __('Traning sessions per month') }}</p></th>
                                <th scope="col"><p style='display:inline-block'>{{ __('Leaves per month') }}</p></th>
                                <th scope="col"><p style='display:inline-block'>{{ __('KPI') }}</p></th>
                                    </tr>
                            </thead>
                            <tbody>
                               @foreach ($emp_sum_array as $emp_rating)
                            <tr>
                            <td>{{ $emp_rating[0] }}</td>
                            <td>{{ $emp_rating[1] }}</td>
                            <td>{{ $emp_rating[2] }}</td>
             <td>{{ $emp_rating[3] }}</td>
                                        
                                   
                                    </tr>
                                @endforeach
                            </tbody-->
                        </table>                      
                    </div>
                </div>
            </div>
        </div>
<script>
document.addEventListener('DOMContentLoaded', function() {      
});
</script>
        @include('layouts.footers.auth')
    </div>
@endsection
@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush