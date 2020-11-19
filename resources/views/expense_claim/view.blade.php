@extends('layouts.app')

@section('content')
    @include('users.partials.header', ['title' => __('Expense claim requests')])
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
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
                    <button formaction="{{ route('expenseClaim.index2') }}" name="add" type="submit" class="btn btn-primary" >
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
                                    <th scope="col"><p style='display:inline-block'>{{ __('Bill') }}</p></th>
                                    <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'reason','order1'=>'asc','sort2' => 'reason','order2'=>'asc','sort3' => 'reason','order3'=>'asc','sort4' => 'reason','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Reason') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'reason','order1'=>'desc','sort2' => 'reason','order2'=>'desc','sort3' => 'reason','order3'=>'desc','sort4' => 'reason','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>

                                    <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'date','order1'=>'asc','sort2' => 'date','order2'=>'asc','sort3' => 'date','order3'=>'asc','sort4' => 'date','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Date') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'date','order1'=>'desc','sort2' => 'date','order2'=>'desc','sort3' => 'date','order3'=>'desc','sort4' => 'date','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                    <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'amount','order1'=>'asc','sort2' => 'amount','order2'=>'asc','sort3' => 'amount','order3'=>'asc','sort4' => 'amount','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Amount') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'amount','order1'=>'desc','sort2' => 'amount','order2'=>'desc','sort3' => 'amount','order3'=>'desc','sort4' => 'amount','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                 <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'status','order1'=>'asc','sort2' => 'status','order2'=>'asc','sort3' => 'status','order3'=>'asc','sort4' => 'status','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Status') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'status','order1'=>'desc','sort2' => 'status','order2'=>'desc','sort3' => 'status','order3'=>'desc','sort4' => 'status','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expense_claim_requests as $expense_claim_req)
                               
                                    <tr>
                                    @if($expense_claim_req->bill_id != null)
<td><a href="{{ route('expenseClaim.download_file',$expense_claim_req->bill_id) }}" >
<span class="btn-inner--icon"><img width="24" height="24" src="{{ asset('argon') }}/img/icons/common/file-download-solid.svg"></span></a></td>
@else
<td></td>
@endif
                                        <td>{{ $expense_claim_req->reason}}</td>
                                        <td>{{ $expense_claim_req->date }}</td>
                                        <td>{{ $expense_claim_req->amount }}</td>
                                        <td>{{ $expense_claim_req->status }}</td>
                                        
                                        @if($expense_claim_req->status === "pending")
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    
                                                <form  method="post">
                                                            @csrf
                                          
                                                            @method('post')
                                                            <input type="number" name="requestId" id="input-requestId" value="{{$expense_claim_req->claim_id}}" style="visibility:hidden;">
                                                            <button formaction="{{ route('expenseClaim.destroy') }}" name="delete" type="submit" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete?") }}') ? this.parentElement.submit() : ''" >
                                                                {{ __('Delete') }}
                                                            </button>
                                            
                                                            <button formaction="{{ route('expenseClaim.index2') }}" name="edit" type="submit" class="dropdown-item">
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
                                                    
                                                <p style="font-size:14px;padding:10px;">You manager already {{ $expense_claim_req->status }}ed this request</p>  
                                                    
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
                            <tr><label style="text-align: center;">{{ __('Pending requests from employees') }}</label></tr>
                                <tr>
                                    <th scope="col"><p style='display:inline-block'>{{ __('Bill') }}</p></th>
                                    <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'reason','order1'=>'asc','sort2' => 'reason','order2'=>'asc','sort3' => 'reason','order3'=>'asc','sort4' => 'reason','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Reason') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'reason','order1'=>'desc','sort2' => 'reason','order2'=>'desc','sort3' => 'reason','order3'=>'desc','sort4' => 'reason','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>

                                    <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'date','order1'=>'asc','sort2' => 'date','order2'=>'asc','sort3' => 'date','order3'=>'asc','sort4' => 'date','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Date') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'date','order1'=>'desc','sort2' => 'date','order2'=>'desc','sort3' => 'date','order3'=>'desc','sort4' => 'date','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                    <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'amount','order1'=>'asc','sort2' => 'amount','order2'=>'asc','sort3' => 'amount','order3'=>'asc','sort4' => 'amount','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Amount') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'amount','order1'=>'desc','sort2' => 'amount','order2'=>'desc','sort3' => 'amount','order3'=>'desc','sort4' => 'amount','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                 <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'status','order1'=>'asc','sort2' => 'status','order2'=>'asc','sort3' => 'status','order3'=>'asc','sort4' => 'status','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Status') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'status','order1'=>'desc','sort2' => 'status','order2'=>'desc','sort3' => 'status','order3'=>'desc','sort4' => 'status','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                    <th scope="col"><p style='display:inline-block'>{{ __('Request by') }}</p></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($to_approve!=null)
                                @foreach ($to_approve as $expense_claim_req)
                               
                                    <tr>
                                    @if($expense_claim_req->bill_id != null)
                                    <td><a href="{{ route('expenseClaim.download_file',$expense_claim_req->bill_id) }}" >
<span class="btn-inner--icon"><img width="24" height="24" src="{{ asset('argon') }}/img/icons/common/file-download-solid.svg"></span></a></td>
@else
<td></td>
@endif
                                        <td>{{ $expense_claim_req->reason}}</td>
                                        <td>{{ $expense_claim_req->date }}</td>
                                        <td>{{ $expense_claim_req->amount }}</td>
                                        <td>{{ $expense_claim_req->status }}</td>


                                        <td>@php
                                        $val =  \App\Http\Controllers\ExpenseClaimRequestController::get_user_name($expense_claim_req->request_by);
                                        $jsonval =json_encode($val);
                                        $finalval = json_decode($jsonval, true);
                                        echo $finalval['name'];
                                        @endphp
                                        </td>
                                        @if($expense_claim_req->status === "pending")
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    
                                                <form  method="post">
                                                            @csrf
                                          
                                                            @method('post')
                                                            <input type="number" name="requestId" id="input-requestId" value="{{$expense_claim_req->claim_id}}" style="visibility:hidden;">
                                                            <button formaction="{{ route('expenseClaim.reject') }}" name="reject" type="submit" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to reject?") }}') ? this.parentElement.submit() : ''">
                                                                {{ __('Reject') }}
                                                            </button>
                                                        
                                                            <button formaction="{{ route('expenseClaim.approve') }}" name="approve" type="submit" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to approve?") }}') ? this.parentElement.submit() : ''">
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
                                                    
                                                <p style="font-size:14px;padding:10px;">You already {{ $expense_claim_req->status }}ed this request</p>  
                                                    
                                                </div>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                        
                        @endcan
                      @can('isAdmin') 
                      <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr><label style="text-align: center;">{{ __('Pending requests from employees') }}</label></tr>
                                <tr>
                                    <th scope="col">{{ __('Bill') }}</th>
                                     <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'reason','order1'=>'asc','sort2' => 'reason','order2'=>'asc','sort3' => 'reason','order3'=>'asc','sort4' => 'reason','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Reason') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'reason','order1'=>'desc','sort2' => 'reason','order2'=>'desc','sort3' => 'reason','order3'=>'desc','sort4' => 'reason','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>

                                    <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'date','order1'=>'asc','sort2' => 'date','order2'=>'asc','sort3' => 'date','order3'=>'asc','sort4' => 'date','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Date') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'date','order1'=>'desc','sort2' => 'date','order2'=>'desc','sort3' => 'date','order3'=>'desc','sort4' => 'date','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                    <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'amount','order1'=>'asc','sort2' => 'amount','order2'=>'asc','sort3' => 'amount','order3'=>'asc','sort4' => 'amount','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Amount') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'amount','order1'=>'desc','sort2' => 'amount','order2'=>'desc','sort3' => 'amount','order3'=>'desc','sort4' => 'amount','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                 <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'status','order1'=>'asc','sort2' => 'status','order2'=>'asc','sort3' => 'status','order3'=>'asc','sort4' => 'status','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Status') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'status','order1'=>'desc','sort2' => 'status','order2'=>'desc','sort3' => 'status','order3'=>'desc','sort4' => 'status','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                    <th scope="col">{{ __('Request by') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($to_approve!=null)
                                @foreach ($to_approve as $expense_claim_req)
                               
                                    <tr>
                                    @if($expense_claim_req->bill_id != null)
                                    <td><a href="{{ route('expenseClaim.download_file',$expense_claim_req->bill_id) }}" >
<span class="btn-inner--icon"><img width="24" height="24" src="{{ asset('argon') }}/img/icons/common/file-download-solid.svg"></span></a></td>
@else
<td></td>
@endif
                                        <td>{{ $expense_claim_req->reason}}</td>
                                        <td>{{ $expense_claim_req->date }}</td>
                                        <td>{{ $expense_claim_req->amount }}</td>
                                        <td>{{ $expense_claim_req->status }}</td>


                                        <td>@php
                                        $val =  \App\Http\Controllers\ExpenseClaimRequestController::get_user_name($expense_claim_req->request_by);
                                        $jsonval =json_encode($val);
                                        $finalval = json_decode($jsonval, true);
                                        echo $finalval['name'];
                                        @endphp
                                        </td>
                                        @if($expense_claim_req->status === "pending")
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    
                                                <form  method="post">
                                                            @csrf
                                          
                                                            @method('post')
                                                            <input type="number" name="requestId" id="input-requestId" value="{{$expense_claim_req->claim_id}}" style="visibility:hidden;">
                                                            <button formaction="{{ route('expenseClaim.reject') }}" name="reject" type="submit" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to reject?") }}') ? this.parentElement.submit() : ''">
                                                                {{ __('Reject') }}
                                                            </button>
                                                        
                                                            <button formaction="{{ route('expenseClaim.approve') }}" name="approve" type="submit" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to approve?") }}') ? this.parentElement.submit() : ''">
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
                                                    
                                                <p style="font-size:14px;padding:10px;">You already {{ $expense_claim_req->status }}ed this request</p>  
                                                    
                                                </div>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <br><br>
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr><label style="text-align: center;">{{ __('This month approved requests') }}</label></tr>
                                <tr>
                                
                                    <th scope="col">{{ __('Employee') }}</th>
                                    <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'reason','order1'=>'asc','sort2' => 'reason','order2'=>'asc','sort3' => 'reason','order3'=>'asc','sort4' => 'reason','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Reason') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'reason','order1'=>'desc','sort2' => 'reason','order2'=>'desc','sort3' => 'reason','order3'=>'desc','sort4' => 'reason','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>

                                    <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'date','order1'=>'asc','sort2' => 'date','order2'=>'asc','sort3' => 'date','order3'=>'asc','sort4' => 'date','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Date') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'date','order1'=>'desc','sort2' => 'date','order2'=>'desc','sort3' => 'date','order3'=>'desc','sort4' => 'date','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                    <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'amount','order1'=>'asc','sort2' => 'amount','order2'=>'asc','sort3' => 'amount','order3'=>'asc','sort4' => 'amount','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Amount') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'amount','order1'=>'desc','sort2' => 'amount','order2'=>'desc','sort3' => 'amount','order3'=>'desc','sort4' => 'amount','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                      
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                            @foreach ($expense_claim_this_month_total as $expense_claims)
                            <td>@php
                                        $val =  \App\Http\Controllers\ExpenseClaimRequestController::get_user_name($expense_claims->request_by);
                                        $jsonval =json_encode($val);
                                        $finalval = json_decode($jsonval, true);
                                        echo $finalval['name'];
                                        @endphp
                            </td>
                            <td>{{ $expense_claims->reason}}</td>
                            <td>{{ $expense_claims->date }}</td>
                            <td>{{ $expense_claims->amount }}</td>
                            
                            @endforeach
                            </tr>
                            </tbody>
                        </table>
                        <br><br>
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr><label style="text-align: center;">{{ __('Last month approved requests') }}</label></tr>
                                <tr>
                                    <th scope="col">{{ __('Employee') }}</th>
                                    <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'reason','order1'=>'asc','sort2' => 'reason','order2'=>'asc','sort3' => 'reason','order3'=>'asc','sort4' => 'reason','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Reason') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'reason','order1'=>'desc','sort2' => 'reason','order2'=>'desc','sort3' => 'reason','order3'=>'desc','sort4' => 'reason','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>

                                    <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'date','order1'=>'asc','sort2' => 'date','order2'=>'asc','sort3' => 'date','order3'=>'asc','sort4' => 'date','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Date') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'date','order1'=>'desc','sort2' => 'date','order2'=>'desc','sort3' => 'date','order3'=>'desc','sort4' => 'date','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                    <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'amount','order1'=>'asc','sort2' => 'amount','order2'=>'asc','sort3' => 'amount','order3'=>'asc','sort4' => 'amount','order4'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Amount') }}</p><a class="nav-link" style='display:inline-block' href="{{ route('expenseClaim', ['sort1' => 'amount','order1'=>'desc','sort2' => 'amount','order2'=>'desc','sort3' => 'amount','order3'=>'desc','sort4' => 'amount','order4'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
                                      
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                            @foreach ($expense_claim_last_month_total as $expense_claims)
                            <td>@php
                                        $val =  \App\Http\Controllers\ExpenseClaimRequestController::get_user_name($expense_claims->request_by);
                                        $jsonval =json_encode($val);
                                        $finalval = json_decode($jsonval, true);
                                        echo $finalval['name'];
                                        @endphp
                            </td>
                            <td>{{ $expense_claims->reason}}</td>
                            <td>{{ $expense_claims->date }}</td>
                            <td>{{ $expense_claims->amount }}</td>
                            
                            @endforeach
                            </tr>
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