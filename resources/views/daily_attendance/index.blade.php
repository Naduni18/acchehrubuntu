@extends('layouts.app')

@section('content')
     @include('users.partials.header', ['title' => __('Daily attendances')])
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
            
            <div>
            <a class="btn btn-success" href="{{ route('dailyAttendanceSummary.index') }}">
            <i class="fas fa-chart-line"></i> {{ __('View Summarry') }}
           </a>     
            </div>
            
            </br>
                <div class="card bg-white shadow">
                    <div class="card-body">
                    @can('isAdmin')
                    <div class='row'>
                        <div class='col' style="padding:10px;">
                            <form id="upload_excel" method="post" enctype="multipart/form-data" action="{{ route('dailyAttendance.import') }}" autocomplete="off">
                                    @csrf                                                       
                                    @method('post')                                                               
                                    <input type="file" name="imported_file" accept=".xls" required>         
                            <button style="margin-left: 10px;" class="btn btn-info" type="submit">Upload attendance</button>  
                            <p style="color:red"> Only .xls files are acceptable </p>
                            </form>
                        </div>  
                        </div> 
                        <div class='row'>  
                        <div style="padding:10px;">
                            <form action="" enctype="multipart/form-data">
                                <button formaction="{{ route('dailyAttendance.export') }}" class="btn btn-primary mt-4" type="submit">Download all attendance</button>
                                
                            <button formaction="{{ route('dailyAttendance.export_this_year') }}" class="btn btn-primary mt-4" type="submit">Download This Year attendance</button>
                            </form> 
                        </div>
                    </div>
                    @endcan
                   
                    <br/>
<!-- implement search box to search by employee id/year/month -->


<div style="height:600px;overflow:auto;">
    
        <table id="myTable" class="table align-items-center table-flush">
            <thead>
            <tr>
                 <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('dailyAttendance', ['sort' => 'id','order'=>'asc','sort1' => 'id','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('ID') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('dailyAttendance', ['sort' => 'id','order'=>'desc','sort1' => 'id','order1'=>'asc']) }}"> <i class="fas fa-caret-down"></i></a></th>

               
               <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('dailyAttendance', ['sort' => 'emp_id','order'=>'asc','sort1' => 'emp_id','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Employee Id') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('dailyAttendance', ['sort' => 'emp_id','order'=>'desc','sort1' => 'emp_id','order1'=>'asc']) }}"> <i class="fas fa-caret-down"></i></a></th>

               <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('dailyAttendance', ['sort' => 'date','order'=>'asc','sort1' => 'date','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Date') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('dailyAttendance', ['sort' => 'date','order'=>'desc','sort1' => 'date','order1'=>'asc']) }}"> <i class="fas fa-caret-down"></i></a></th>
  <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('dailyAttendance', ['sort' => 'in_am','order'=>'asc','sort1' => 'in_am','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Morning In') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('dailyAttendance', ['sort' => 'in_am','order'=>'desc','sort1' => 'in_am','order1'=>'asc']) }}"> <i class="fas fa-caret-down"></i></a></th>

               
                <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('dailyAttendance', ['sort' => 'out_am','order'=>'asc','sort1' => 'out_am','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Morning out') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('dailyAttendance', ['sort' => 'out_am','order'=>'desc','sort1' => 'out_am','order1'=>'asc']) }}"> <i class="fas fa-caret-down"></i></a></th>

               
                 <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('dailyAttendance', ['sort' => 'in_pm','order'=>'asc','sort1' => 'in_pm','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Afternoon in') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('dailyAttendance', ['sort' => 'in_pm','order'=>'desc','sort1' => 'in_pm','order1'=>'asc']) }}"> <i class="fas fa-caret-down"></i></a></th>

               
             <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('dailyAttendance', ['sort' => 'out_pm','order'=>'asc','sort1' => 'out_pm','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Afternoon out') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('dailyAttendance', ['sort' => 'out_pm','order'=>'desc','sort1' => 'out_pm','order1'=>'asc']) }}"> <i class="fas fa-caret-down"></i></a></th>

                <th scope="col"><a class="nav-link" style='display:inline-block' href="{{ route('dailyAttendance', ['sort' => 'status','order'=>'asc','sort1' => 'status','order1'=>'asc']) }}"> <i class="fas fa-caret-up"></i></a>
<p style='display:inline-block'>{{ __('Status') }}</p>
<a class="nav-link" style='display:inline-block' href="{{ route('dailyAttendance', ['sort' => 'status','order'=>'desc','sort1' => 'status','order1'=>'asc']) }}"> <i class="fas fa-caret-down"></i></a></th>

               
            </tr>
            </thead>
            @if(count($dailyAttendance))
            @foreach($dailyAttendance as $record)
                <tr>
                    <td>{{$record->id}}</td>
                    <td>{{$record->emp_id}}</td>
                    <td>{{$record->date}}</td>
                    <td>{{$record->in_am}}</td>
                    <td>{{$record->out_am}}</td>
                    <td>{{$record->in_pm}}</td>
                    <td>{{$record->out_pm}}</td>
                    <td>{{$record->status}}</td>
                </tr>
            @endforeach
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
                </tr>
            @endif 
        </table>
      
    </div>
    
   
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