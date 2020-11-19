<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        
        <!-- Brand -->
        <a class="navbar-brand pt-3" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" style="width:160px;height:200px;" alt="ACCHE Logo">
        </a>
        
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
           
            
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.edit') }}">
                        <i class="far fa-address-card text-primary"></i> {{ __('Profile') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-table text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('attendance', ['sort' => 'id','order'=>'asc','sort1' => 'id','order1'=>'asc']) }}">
                        <i class="fas fa-user-times text-primary"></i> {{ __('Missing Attendance') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('trainingSchedule') }}">
                        <i class="fas fa-calendar-alt text-primary"></i> {{ __('Training schedule') }}
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('expenseClaim', ['sort1' => 'reason','order1'=>'asc','sort2' => 'reason','order2'=>'asc','sort3' => 'reason','order3'=>'asc','sort4' => 'reason','order4'=>'asc']) }}">
                        <i class="fas fa-file-invoice-dollar text-primary"></i> {{ __('Expense claims') }}
                    </a>
                </li>
          
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('advance_payment')}}">
                        <i class="fas fa-hand-holding-usd text-primary"></i> {{ __('Advance payments') }}
                    </a>
                </li>
                
              
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('leave',['sort1' => 'reason','order1'=>'asc','sort2' => 'reason','order2'=>'asc']) }}">
                        <i class="fas fa-user-minus text-primary"></i> {{ __('Leave') }}
                    </a>
                </li>
            <li class="nav-item">
                    <a class="nav-link" href="{{ route('salary.index3',['year' => '0000','month'=>'non']) }}">
                        <i class="fas fa-money-check-alt text-primary"></i> {{ __('Salary') }}
                    </a>
                </li>
                @can('isAdmin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.create') }}">
                        <i class="fas fa-user-plus text-primary"></i> {{ __('Add Employee') }}
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.index') }}">
                        <i class="fas fa-users text-primary"></i> {{ __('View Employees') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dailyAttendance', ['sort' => 'id','order'=>'asc']) }}">
                        <i class="fas fa-clipboard-list text-primary"></i> {{ __('Attendance records') }}
                    </a>
                </li>
             <li class="nav-item">
                    <a class="nav-link" href="{{ route('salary', ['sort' => 'id','order'=>'asc']) }}">
                        <i class="fas fa-coins text-primary"></i> {{ __('Salary Management') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('skill_rating', ['sort1' => 'file_receivings','order1'=>'asc']) }}">
                        <i class="fas fa-star text-primary"></i> {{ __('rate employees') }}
                    </a>
                </li>
                @endcan
              @can('isManager')
               <li class="nav-item">
                    <a class="nav-link" href="#navbar-five" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-1">
                        <i class="fas fa-chalkboard-teacher text-primary"></i>{{ __('Mange Branch') }}</span>
                    </a>

                    <div class="collapse" id="navbar-five">
                      <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                    <a class="nav-link" href="{{ route('recruitment',['sort1' => 'name','order1'=>'asc']) }}">
                        <i class="fas fa-user-plus text-primary"></i> {{ __('Recruitment') }}
                    </a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('skill_rating', ['sort1' => 'file_receivings','order1'=>'asc']) }}">
                        <i class="fas fa-star text-primary"></i> {{ __('rate your employees') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dailyAttendance', ['sort' => 'id','order'=>'asc']) }}">
                        <i class="fas fa-clipboard-list text-primary"></i> {{ __('Attendance records') }}
                    </a>
                </li>
                    </ul>   
            </div>
               </li>
            @endcan
                
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('help') }}">
                        <i class="ni ni-support-16 text-Danger"></i> <font class="text-Danger">Help !</font>
                    </a>
                </li>
                
            </ul>
        </div>
    </div>
</nav>