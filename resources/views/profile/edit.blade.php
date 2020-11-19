@extends('layouts.app', ['title' => __('Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __('This is your profile page.'),
        'class' => 'col-lg-12'
    ])   
    <style>
* {box-sizing: border-box}

/* Style the tab */
.tab {
  float: left;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
  width: 30%;
  
}

/* Style the buttons that are used to open the tab content */
.tab button {
  display: block;
  background-color: inherit;
  color: black;
  padding: 22px 16px;
  width: 100%;
  border: none;
  outline: none;
  text-align: left;
  cursor: pointer;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current "tab button" class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  float: left;
  padding: 0px 12px;
  border: 1px solid #ccc;
  width: 70%;
  border-left: none;
 
}
.tables tr { line-height: 35px; }

</style>
    <div class="container-fluid mt--7" >
        <div class="row">
            <div class="col-xl-12 order-xl-2 mb-5 mb-xl-0" >
            
                <div class="card card-profile shadow" style="margin:10px" >
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
<a href='#'><img alt="Image placeholder" onerror="this.src='{{ asset('storage/uploads/avatars/default.png')}}'" src="{{ asset('storage/uploads/avatars/'.auth()->user()->avatar_id) }}"></a>

                       
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    </div>
                    <div class="card-body pt-0 pt-md-4" style="margin-top:70px">
                    <div  class="card-profile-stats d-flex justify-content-center mt-md-5">
                    

<div class="tab">
  <button class="tablinks" onclick="openTaby(event, 'Personal')" active >Personal Details</button>
  <button class="tablinks" onclick="openTaby(event, 'Bank')">Bank Details</button>
  <button class="tablinks" onclick="openTaby(event, 'Next_kin')">Next Kin Details</button>
  <button class="tablinks" onclick="openTaby(event, 'Work')">Work Details</button>
 <button class="tablinks" onclick="openTaby(event, 'Skill')">Skill Ratings</button>
</div>

<div id="Personal" class="tabcontent" style="display:block;">
  <table class="tables" style="width:80%;hight:100%;text-align:left">
                        <tr>
                        
                            <td>Username:   </td>
                            <td>{{ auth()->user()->name }}</td>
                        </tr>
                        
                        <tr>
                        
                        <td>First name:   </td>
                        <td>{{ auth()->user()->fname }}</td>
                    </tr>

                    <tr>
                        
                        <td>Middle name:   </td>
                        <td>{{ auth()->user()->mname }}</td>
                    </tr>

                    <tr>
                        
                        <td>Last name:   </td>
                        <td>{{ auth()->user()->lname }}</td>
                    </tr>
                        <tr>
                            <td>NIC:   </td>
                            <td>{{ auth()->user()->NIC }}</td>  
                        </tr>
                        <tr>
                            <td>E-Mail:   </td>
                            <td>{{ auth()->user()->email }}</td>
                        </tr>
                        <tr>
                            <td>Birthday:   </td>
                            <td>{{ auth()->user()->birthday }}</td>  
                        </tr>
                        <tr>
                            <td>Anniversary:   </td>
                            <td>{{ auth()->user()->anniversary }}</td>
                        </tr>
                        <tr>
                            <td>Phone (Home):   </td>
                            <td>{{ auth()->user()->phone_home }}</td>  
                        </tr>
                        <tr>
                            <td>Phone (Mobile):   </td>
                            <td>{{ auth()->user()->phone_mobile }}</td>
                        </tr>
                        <tr>
                            <td>Temporary address:   </td>
                            <td>{{ auth()->user()->address_temporary }}</td>
                        </tr>
                        <tr>
                            <td>Permanent address:   </td>
                            <td>{{ auth()->user()->address_permanent }}</td>
                        </tr>
                        
                        </table>

</div>

<div id="Bank" class="tabcontent" style="display:none;">
  
  <table class="tables" style="width:80%;hight:100%;text-align:left">
 
                        <tr>
                            <td>Bank:   </td>
                            <td>{{ auth()->user()->bank }}</td>  
                        </tr>
                        <tr>
                            <td>Bank:   </td>
                            <td>{{ auth()->user()->bank_branch }}</td>  
                        </tr>
                        <tr>
                            <td>Bank account number:   </td>
                            <td>{{ auth()->user()->bank_number }}</td>
                        </tr>
                        </table> 
</div>

<div id="Next_kin" class="tabcontent" style="display:none;">
  
  <table class="tables" style="width:80%;hight:100%;text-align:left">
  
                        <tr>
                            <td>Name:   </td>
                            <td>{{ auth()->user()->next_kin_name }}</td>  
                        </tr>
                        <tr>
                            <td>Job Position:   </td>
                            <td>{{ auth()->user()->next_kin_occupation }}</td>
                        </tr>
                        <tr>
                            <td>Office address: </td>
                            <td>{{ auth()->user()->next_kin_office_address }}</td>  
                        </tr>
                        <tr>
                            <td>Phone (Mobile):   </td>
                            <td>{{ auth()->user()->next_kin_phone_mobile }}</td>
                        </tr>
                        <tr>
                            <td>Phone (Home):   </td>
                            <td>{{ auth()->user()->next_kin_phone_home }}</td>  
                        </tr>
                        <tr>
                            <td>Address:   </td>
                            <td>{{ auth()->user()->next_kin_address }}</td>
                        </tr>
                        
                        </table>

</div>
<div id="Work" class="tabcontent" style="display:none;">
                        <table class="tables" style="width:80%;hight:100%;text-align:left">
                        <tr>
                            <td>Job Position:   </td>
                            <td>{{ auth()->user()->current_job_position }}</td>
                        </tr>
                        <tr>
                            <td>Branch:   </td>
                            <td>{{ auth()->user()->branch }}</td>
                        </tr>
                        <tr>
                            <td>Department:   </td>
                            <td>{{ auth()->user()->department }}</td>
                        </tr>
                        <tr>
                            <td>EPF number:   </td>
                            <td>{{ auth()->user()->EPF_number }}</td>
                        </tr>
                        <tr>
                            <td>Role:   </td>
                            <td>{{ auth()->user()->user_role }}</td>
                        </tr>
                        <tr>
                            <td>Supervisor/Manager:   </td>
                            <td>@php
                                        $val =  \App\Http\Controllers\ProfileController::get_user_name(auth()->user()->supervisor_manager);
                                        $jsonval =json_encode($val);
                                        $finalval = json_decode($jsonval, true);
                                        echo $finalval['name'];
                                        @endphp</td>
                        </tr>
                        </table>
</div>
                    <div id="Skill" class="tabcontent" style="display:none;">
                    <table class="tables" style="width:80%;hight:100%;text-align:left">
 
 <tr>
     <td>File receivings:   </td>
     @if(isset($user_skill_rating) && $user_skill_rating != null)
     <td>{{ $user_skill_rating->file_receivings }}</td> 
     @else
     <td></td>
     @endif 
 </tr>
 <tr>
     <td>Offers:   </td>
     @if(isset($user_skill_rating) && $user_skill_rating != null)
     <td>{{ $user_skill_rating->offers }}</td>
     @else
     <td></td>
     @endif 
 </tr>
 <tr>
     <td>Visa grants:   </td>
     @if(isset($user_skill_rating) && $user_skill_rating != null)
     <td>{{ $user_skill_rating->visa_grants }}</td> 
     @else
     <td></td>
     @endif  
 </tr>
 <tr>
     <td>IELTS class registrations:   </td>
     @if(isset($user_skill_rating) && $user_skill_rating != null)
     <td>{{ $user_skill_rating->IELTS_class_registrations }}</td>
     @else
     <td></td>
     @endif 
 </tr>
 <tr>
     <td>IELTS exam registrations:   </td>
     @if(isset($user_skill_rating) && $user_skill_rating != null)
     <td>{{ $user_skill_rating->IELTS_exam_registrations }}</td>
     @else
     <td></td>
     @endif   
 </tr>
 <tr>
     <td>Total KPI:   </td>
     @if(isset($user_skill_rating) && $user_skill_rating != null)
     <td>{{ $user_skill_rating->total_kpi }}</td>
     @else
     <td></td>
     @endif 
 </tr>
 </table> 
                    </div>
                    </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow" style="margin:10px">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Change password') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        
                        <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                            @csrf
                            @method('put')


                            @if (session('password_status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('password_status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-current-password">{{ __('Current Password') }}</label>
                                    <input type="password" name="old_password" id="input-current-password" class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                                    
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('New Password') }}</label>
                                    <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                                    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                                    <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm New Password') }}" value="" required>
                                </div>
                                        <span class="text-danger text-center">
                                            <strong style="font-size:11px;">Password must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters
                                            </strong>
                                        </span>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-Primary mt-4">{{ __('Change password') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection

<script>
function openTaby(evt, TabyName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(TabyName).style.display = "block";
  evt.currentTarget.className += " active";
}

</script>
   