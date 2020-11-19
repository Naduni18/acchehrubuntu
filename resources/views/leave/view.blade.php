@extends('layouts.app')

@section('content')
    @include('users.partials.header', ['title' => __('Leave requests')])
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
            @can('isManager')
            <div>
            <a class="btn btn-success" href="{{ route('leave.index3') }}">
            <i class="fas fa-chart-line"></i> {{ __('View Summarry') }}
           </a>     
            </div>
            @endcan
            @can('isAdmin')
            <div>
            <a class="btn btn-success" href="{{ route('leave.index4') }}">
            <i class="fas fa-chart-line"></i> {{ __('View Summarry') }}
           </a>     
            </div>
            @endcan
            </br>
                <div class="card bg-white shadow">
                    <div class="card-body">

                    <form  method="post">
                     @csrf
                                          
                    @method('post')
                    <div class="row">
                    <input type="text" name="requestId" id="input-requestId" value="add" style="visibility:hidden;">
                    </div>
                    <div class="row"> 
                    <div class="col d-flex justify-content-end">                  
                    <button formaction="{{ route('leave.index2') }}" name="add" type="submit" class="btn btn-primary" >
                    {{ __('Add new Request') }}
                    </button>
                    </div>
                    </div>
                    </form>
                    <br> 
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr><label style="text-align: center;">{{ __('Your requests') }}</label></tr>
                                <tr>
                                    <th scope="col"><p style='display:inline-block'>{{ __('Document') }}</p></th>
                                   <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'reason','order1'=>'asc','sort2' => 'reason','order2'=>'asc','sort3' => 'reason','order3'=>'asc','sort4' => 'reason','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Reason') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'reason','order1'=>'desc','sort2' => 'reason','order2'=>'desc','sort3' => 'reason','order3'=>'desc','sort4' => 'reason','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>

                                    <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'date_','order1'=>'asc','sort2' => 'date_','order2'=>'asc','sort3' => 'date_','order3'=>'asc','sort4' => 'date_','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Date') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'date_','order1'=>'desc','sort2' => 'date_','order2'=>'desc','sort3' => 'date_','order3'=>'desc','sort4' => 'date_','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                     
                                <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'start','order1'=>'asc','sort2' => 'start','order2'=>'asc','sort3' => 'start','order3'=>'asc','sort4' => 'start','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Start') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'start','order1'=>'desc','sort2' => 'start','order2'=>'desc','sort3' => 'start','order3'=>'desc','sort4' => 'start','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                    
                                    <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'end','order1'=>'asc','sort2' => 'end','order2'=>'asc','sort3' => 'end','order3'=>'asc','sort4' => 'end','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('End') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'end','order1'=>'desc','sort2' => 'end','order2'=>'desc','sort3' => 'end','order3'=>'desc','sort4' => 'end','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                   
                                   <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'status','order1'=>'asc','sort2' => 'status','order2'=>'asc','sort3' => 'status','order3'=>'asc','sort4' => 'status','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Status') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'status','order1'=>'desc','sort2' => 'status','order2'=>'desc','sort3' => 'status','order3'=>'desc','sort4' => 'status','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                    
                                  <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'category','order1'=>'asc','sort2' => 'category','order2'=>'asc','sort3' => 'category','order3'=>'asc','sort4' => 'category','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Category') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'category','order1'=>'desc','sort2' => 'category','order2'=>'desc','sort3' => 'category','order3'=>'desc','sort4' => 'category','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                   
                                   <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'type','order1'=>'asc','sort2' => 'type','order2'=>'asc','sort3' => 'type','order3'=>'asc','sort4' => 'type','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Type') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'type','order1'=>'desc','sort2' => 'type','order2'=>'desc','sort3' => 'type','order3'=>'desc','sort4' => 'type','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                   
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leave_requests as $leave_req)
                               
                                    <tr>
                                    @if($leave_req->document_id != null)
<td><a href="{{ route('leave.download_file',$leave_req->document_id) }}" >
<span class="btn-inner--icon"><img width="24" height="24" src="{{ asset('argon') }}/img/icons/common/file-download-solid.svg"></span></a></td>
@else
<td></td>
@endif
                                        <td>{{ $leave_req->reason}}</td>
                                        <td>{{ $leave_req->date_ }}</td>
                                        <td>{{ $leave_req->start }}</td>
                                        <td>{{ $leave_req->end }}</td>
                                        <td>{{ $leave_req->status }}</td>
                                        <td>{{ $leave_req->category }}</td>
                                        <td>{{ $leave_req->type }}</td>
                                        @if($leave_req->status === "pending")
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    
                                                <form  method="post">
                                                            @csrf
                                          
                                                            @method('post')
                                                            <input type="number" name="requestId" id="input-requestId" value="{{$leave_req->id}}" style="visibility:hidden;">
                                                            <button formaction="{{ route('leave.destroy') }}" name="delete" type="submit" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete?") }}') ? this.parentElement.submit() : ''" >
                                                                {{ __('Delete') }}
                                                            </button>
                                            
                                                            <button formaction="{{ route('leave.index2') }}" name="edit" type="submit" class="dropdown-item">
                                                                {{ __('Edit') }}
                                                            </button>
                                                        </form>   
                                                    
                                                </div>
                                            </div>
                                        </td>
                                        @else
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    
                                                <p style="font-size:14px;padding:10px;">You manager already {{ $leave_req->status }}ed this request</p>  
                                                    
                                                </div>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div></div>
                      </br></br></br></br>
                      <div class="card bg-white shadow">
                    <div class="card-body">
                      @can('isManager') 
                      <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr><label style="text-align: center;">{{ __('Requests from employees') }}</label></tr>
                                <tr>
                                    <th scope="col"><p style='display:inline-block'>{{ __('Document') }}</p></th>
                                    <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'reason','order1'=>'asc','sort2' => 'reason','order2'=>'asc','sort3' => 'reason','order3'=>'asc','sort4' => 'reason','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Reason') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'reason','order1'=>'desc','sort2' => 'reason','order2'=>'desc','sort3' => 'reason','order3'=>'desc','sort4' => 'reason','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>

                                    <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'date_','order1'=>'asc','sort2' => 'date_','order2'=>'asc','sort3' => 'date_','order3'=>'asc','sort4' => 'date_','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Date') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'date_','order1'=>'desc','sort2' => 'date_','order2'=>'desc','sort3' => 'date_','order3'=>'desc','sort4' => 'date_','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                     
                                <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'start','order1'=>'asc','sort2' => 'start','order2'=>'asc','sort3' => 'start','order3'=>'asc','sort4' => 'start','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Start') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'start','order1'=>'desc','sort2' => 'start','order2'=>'desc','sort3' => 'start','order3'=>'desc','sort4' => 'start','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                    
                                    <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'end','order1'=>'asc','sort2' => 'end','order2'=>'asc','sort3' => 'end','order3'=>'asc','sort4' => 'end','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('End') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'end','order1'=>'desc','sort2' => 'end','order2'=>'desc','sort3' => 'end','order3'=>'desc','sort4' => 'end','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                   
                                   <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'status','order1'=>'asc','sort2' => 'status','order2'=>'asc','sort3' => 'status','order3'=>'asc','sort4' => 'status','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Status') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'status','order1'=>'desc','sort2' => 'status','order2'=>'desc','sort3' => 'status','order3'=>'desc','sort4' => 'status','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                    
                                  <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'category','order1'=>'asc','sort2' => 'category','order2'=>'asc','sort3' => 'category','order3'=>'asc','sort4' => 'category','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Category') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'category','order1'=>'desc','sort2' => 'category','order2'=>'desc','sort3' => 'category','order3'=>'desc','sort4' => 'category','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                   
                                   <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'type','order1'=>'asc','sort2' => 'type','order2'=>'asc','sort3' => 'type','order3'=>'asc','sort4' => 'type','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Type') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('leave', ['sort1' => 'type','order1'=>'desc','sort2' => 'type','order2'=>'desc','sort3' => 'type','order3'=>'desc','sort4' => 'type','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                 
                                    <th scope="col"><p style='display:inline-block'>{{ __('Request by') }}</p></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($to_approve as $leave_req)
                               
                                    <tr>
                                    @if($leave_req->document_id != null)
                                    <td><a href="{{ route('leave.download_file',$leave_req->document_id) }}" >
<span class="btn-inner--icon"><img width="24" height="24" src="{{ asset('argon') }}/img/icons/common/file-download-solid.svg"></span></a></td>
@else
<td></td>
@endif
                                        <td>{{ $leave_req->reason}}</td>
                                        <td>{{ $leave_req->date_ }}</td>
                                        <td>{{ $leave_req->start }}</td>
                                        <td>{{ $leave_req->end }}</td>
                                        <td>{{ $leave_req->status }}</td>
                                        <td>{{ $leave_req->category }}</td>
                                        <td>{{ $leave_req->type }}</td>


                                        <td>@php
                                        $val =  \App\Http\Controllers\LeaveRequestController::get_user_name($leave_req->request_by);
                                        $jsonval =json_encode($val);
                                        $finalval = json_decode($jsonval, true);
                                        echo $finalval['name'];
                                        @endphp
                                        </td>
                                        @if($leave_req->status === "pending")
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    
                                                <form  method="post">
                                                            @csrf
                                          
                                                            @method('post')
                                                            <input type="number" name="requestId" id="input-requestId" value="{{$leave_req->id}}" style="visibility:hidden;">
                                                            <button formaction="{{ route('leave.reject') }}" name="reject" type="submit" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to reject?") }}') ? this.parentElement.submit() : ''">
                                                                {{ __('Reject') }}
                                                            </button>
                                                        
                                                            <button formaction="{{ route('leave.approve') }}" name="approve" type="submit" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to approve?") }}') ? this.parentElement.submit() : ''">
                                                                {{ __('Approve') }}
                                                            </button>
                                                        </form>   
                                                    
                                                </div>
                                            </div>
                                        </td>
                                        @else
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    
                                                <p style="font-size:14px;padding:10px;">You already {{ $leave_req->status }}ed this request</p>  
                                                    
                                                </div>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endcan



                    </div> 
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