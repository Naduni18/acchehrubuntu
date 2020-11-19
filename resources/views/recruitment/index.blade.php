@extends('layouts.app')

@section('content')
   @include('users.partials.header', ['title' => __('Recruitments')])
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card bg-white shadow">
                    <div class="card-body">

                    <form  method="post">
                     @csrf
                                          
                    @method('post')
                    <div class="row">
                    <input type="text" name="candidateId" id="input-candidateId" value="add" style="visibility:hidden;">
                    </div>
                    <div class="row"> 
                    <div class="col d-flex justify-content-end">                  
                    <button formaction="{{ route('recruitment.index2') }}" name="add" type="submit" class="btn btn-primary" >
                    {{ __('Add new Candidate') }}
                    </button>
                    </div>
                    </div>
                    </form>
                    <br> 
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr><label style="text-align: center;">{{ __('Candidate List') }}</label></tr>
                                <tr>
                                    <th scope="col"><p style='display:inline-block'>{{ __('CV') }}</p></th>
                                    <th><a class="nav-link" style='display:inline-block' href="{{ route('recruitment', ['sort1' => 'name','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>{{ __('Name') }} </p>
            <a class="nav-link" style='display:inline-block' href="{{ route('recruitment', ['sort1' => 'name','order1'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            
                    <th><a class="nav-link" style='display:inline-block' href="{{ route('recruitment', ['sort1' => 'NIC','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>{{ __('NIC') }} </p>
            <a class="nav-link" style='display:inline-block' href="{{ route('recruitment', ['sort1' => 'NIC','order1'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            
                      <th><a class="nav-link" style='display:inline-block' href="{{ route('recruitment', ['sort1' => 'email','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>{{ __('Email') }} </p>
            <a class="nav-link" style='display:inline-block' href="{{ route('recruitment', ['sort1' => 'email','order1'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            <th><a class="nav-link" style='display:inline-block' href="{{ route('recruitment', ['sort1' => 'applied_job_position','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>{{ __('Applied Job Position') }} </p>
            <a class="nav-link" style='display:inline-block' href="{{ route('recruitment', ['sort1' => 'applied_job_position','order1'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            <th><a class="nav-link" style='display:inline-block' href="{{ route('recruitment', ['sort1' => 'first_interview_date','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>{{ __('First Interview') }} </p>
            <a class="nav-link" style='display:inline-block' href="{{ route('recruitment', ['sort1' => 'first_interview_date','order1'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            <th><a class="nav-link" style='display:inline-block' href="{{ route('recruitment', ['sort1' => 'second_interview_date','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>{{ __('Second Interview') }} </p>
            <a class="nav-link" style='display:inline-block' href="{{ route('recruitment', ['sort1' => 'second_interview_date','order1'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                <th scope="col"><p style='display:inline-block'>{{ __('interviewer') }}</p></th>
                                <th><a class="nav-link" style='display:inline-block' href="{{ route('recruitment', ['sort1' => 'notes','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>{{ __('Notes') }} </p>
            <a class="nav-link" style='display:inline-block' href="{{ route('recruitment', ['sort1' => 'notes','order1'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            <th><a class="nav-link" style='display:inline-block' href="{{ route('recruitment', ['sort1' => 'current_status','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
            <p style='display:inline-block'>{{ __('Current Status') }} </p>
            <a class="nav-link" style='display:inline-block' href="{{ route('recruitment', ['sort1' => 'current_status','order1'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
            
                                   
                                   
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recruitment_list as $recruitment_record)
                               
                                    <tr>
                                    @if($recruitment_record->cv_id != null)
<td><a href="{{ route('recruitment.download_file',$recruitment_record->cv_id) }}" >
<span class="btn-inner--icon"><img width="24" height="24" src="{{ asset('argon') }}/img/icons/common/file-download-solid.svg"></span></a></td>
@else
<td></td>
@endif
                                        <td>{{ $recruitment_record->name}}</td>
                                        <td>{{ $recruitment_record->NIC }}</td>
                                        <td>{{ $recruitment_record->email }}</td>
                                        <td>{{ $recruitment_record->applied_job_position }}</td>
                                        <td>{{ $recruitment_record->first_interview_date }}</td>
                                        <td>{{ $recruitment_record->second_interview_date }}</td>
                                        @if($recruitment_record->interviewer!=null)
                                         <td>@php
                                        $val =  \App\Http\Controllers\RecruitmentController::get_user_name($recruitment_record->interviewer);
                                        $jsonval =json_encode($val);
                                        $finalval = json_decode($jsonval, true);
                                        echo $finalval['name'];
                                        @endphp
                                        </td> 
                                        @else
                                        <td></td>
                                        @endif
                                        <td>{{ $recruitment_record->notes }}</td>
                                        <td>{{ $recruitment_record->current_status }}</td>
                                        
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    
                                                <form  method="post">
                                                            @csrf
                                          
                                                            @method('post')
                                                            <input type="number" name="candidateId" id="input-candidateId" value="{{$recruitment_record->id}}" style="visibility:hidden;">
                                                            <button formaction="{{ route('recruitment.destroy') }}" name="delete" type="submit" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete?") }}') ? this.parentElement.submit() : ''" >
                                                                {{ __('Delete') }}
                                                            </button>
                                            
                                                            <button formaction="{{ route('recruitment.index2') }}" name="edit" type="submit" class="dropdown-item">
                                                                {{ __('Edit') }}
                                                            </button>
                                                        </form>   
                                                    
                                                </div>
                                            </div>
                                        </td>
                                       
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div></div> 
              
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