@extends('layouts.app')

@section('content')
@include('users.partials.header', ['title' => __('Missing attendance requests')])

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
<button formaction="{{ route('attendance.index2') }}" name="add" type="submit" class="btn btn-primary" >
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
<th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'reason','order'=>'asc','sort1' => 'reason','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Reason') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'reason','order'=>'desc','sort1' => 'reason','order1'=>'asc']) }}"> <i class="fas fa-caret-down"></i></a></th>
<th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'date','order'=>'asc','sort1' => 'date','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Date') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'date','order'=>'desc','sort1' => 'date','order1'=>'asc']) }}"> <i class="fas fa-caret-down"></i></a></th>
<th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'start','order'=>'asc','sort1' => 'start','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Start AM') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'start','order'=>'desc','sort1' => 'start','order1'=>'asc']) }}"> <i class="fas fa-caret-down"></i></a></th>
<th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'startmid','order'=>'asc','sort1' => 'startmid','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('End AM') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'startmid','order'=>'desc','sort1' => 'startmid','order1'=>'asc']) }}"> <i class="fas fa-caret-down"></i></a></th>
<th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'endmid','order'=>'asc','sort1' => 'endmid','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Start PM') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'endmid','order'=>'desc','sort1' => 'endmid','order1'=>'asc']) }}"> <i class="fas fa-caret-down"></i></a></th>
<th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'end','order'=>'asc','sort1' => 'end','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('End PM') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'end','order'=>'desc','sort1' => 'end','order1'=>'asc']) }}"> <i class="fas fa-caret-down"></i></a></th>
<th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'status','order'=>'asc','sort1' => 'status','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Status') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'status','order'=>'desc','sort1' => 'status','order1'=>'asc']) }}"> <i class="fas fa-caret-down"></i></a></th>
<th scope="col"></th>
</tr>
</thead>
<tbody>
@foreach ($attendance_requests as $missing_att)

<tr>
<td>{{ $missing_att->reason}}</td>
<td>{{ $missing_att->date }}</td>
<td>{{ $missing_att->start }}</td>
<td>{{ $missing_att->startmid }}</td>
<td>{{ $missing_att->endmid }}</td>
<td>{{ $missing_att->end }}</td>
<td>{{ $missing_att->status }}</td>
@if($missing_att->status === "pending")
<td class="text-right">
<div class="dropdown">
<a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="fas fa-ellipsis-v"></i>
</a>
<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

<form  method="post">
@csrf

@method('post')
<input type="number" name="requestId" id="input-requestId" value="{{$missing_att->id}}" style="visibility:hidden;">
<button formaction="{{ route('attendance.destroy') }}" name="delete" type="submit" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete?") }}') ? this.parentElement.submit() : ''" >
{{ __('Delete') }}
</button>

<button formaction="{{ route('attendance.index2') }}" name="edit" type="submit" class="dropdown-item">
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

<p style="font-size:14px;padding:10px;">You manager already {{ $missing_att->status }}ed this request</p>  

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
<th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'reason','order'=>'asc','sort1' => 'reason','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Reason') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'reason','order'=>'asc','sort1' => 'reason','order1'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
<th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'date','order'=>'asc','sort1' => 'date','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Date') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'date','order'=>'asc','sort1' => 'date','order1'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
<th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'start','order'=>'asc','sort1' => 'start','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Start AM') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'start','order'=>'asc','sort1' => 'start','order1'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
<th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'startmid','order'=>'asc','sort1' => 'startmid','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('End AM') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'startmid','order'=>'asc','sort1' => 'startmid','order1'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
<th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'endmid','order'=>'asc','sort1' => 'endmid','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Start PM') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'endmid','order'=>'asc','sort1' => 'endmid','order1'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
<th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'end','order'=>'asc','sort1' => 'end','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('End PM') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'end','order'=>'asc','sort1' => 'end','order1'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>
<th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'status','order'=>'asc','sort1' => 'status','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Status') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'status','order'=>'asc','sort1' => 'status','order1'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>

<th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'request_by','order'=>'asc','sort1' => 'request_by','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Request by') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('attendance', ['sort' => 'request_by','order'=>'asc','sort1' => 'request_by','order1'=>'desc']) }}"> <i class="fas fa-caret-down"></i></a></th>

<th scope="col"></th>
</tr>
</thead>
<tbody>
@foreach ($to_approve as $missing_att)

<tr>
<td>{{ $missing_att->reason}}</td>
<td>{{ $missing_att->date }}</td>
<td>{{ $missing_att->start }}</td>
<td>{{ $missing_att->startmid }}</td>
<td>{{ $missing_att->endmid }}</td>
<td>{{ $missing_att->end }}</td>
<td>{{ $missing_att->status }}</td>


<td>@php
$val =  \App\Http\Controllers\MissingAttendanceController::get_user_name($missing_att->request_by);
$jsonval =json_encode($val);
$finalval = json_decode($jsonval, true);
echo $finalval['name'];
@endphp
</td>
@if($missing_att->status === "pending")
<td class="text-right">
<div class="dropdown">
<a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="fas fa-ellipsis-v"></i>
</a>
<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

<form  method="post">
@csrf

@method('post')
<input type="number" name="requestId" id="input-requestId" value="{{$missing_att->id}}" style="visibility:hidden;">
<button formaction="{{ route('attendance.reject') }}" name="reject" type="submit" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to reject?") }}') ? this.parentElement.submit() : ''">
{{ __('Reject') }}
</button>

<button formaction="{{ route('attendance.approve') }}" name="approve" type="submit" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to approve?") }}') ? this.parentElement.submit() : ''">
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

<p style="font-size:14px;padding:10px;">You already {{ $missing_att->status }}ed this request</p>  

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