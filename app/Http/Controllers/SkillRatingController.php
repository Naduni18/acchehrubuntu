<?php

    namespace App\Http\Controllers;
    
    use App\User;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Str;
    use Illuminate\Http\UploadedFile;
    use Illuminate\Support\Facades\Storage;
    use Uuid;
    use Carbon\Carbon;

    class SkillRatingController extends Controller
    {
        /**
         * Show the application dashboard.
         *
         * @return \Illuminate\View\View
         */
        public function index($sort1, $order1)
        {
            $id = auth()->id();
            $employees_array=DB::table('users')->where([['supervisor_manager', '=', $id],])->get();
 
            $emp_rating_array=array();
            foreach($employees_array as $u){
                $uid=$u->id;
                $uname=$u->name;

                $employee_rating=DB::table('skill_rating')->where([['emp_id', '=', $uid],])->first();
                if($employee_rating!=null){
                array_push($emp_rating_array,array(
                    'id'=>$uid,
                    'name'=>$uname,
                    'file_receivings' => $employee_rating->file_receivings,
                    'offers' => $employee_rating->offers,
                    'visa_grants'=> $employee_rating->visa_grants,
                    'IELTS_class_registrations'=> $employee_rating->IELTS_class_registrations,
                    'IELTS_exam_registrations'=> $employee_rating->IELTS_exam_registrations,
                    'total_kpi'=> $employee_rating->total_kpi,
                ));
            }
            }
      
            $employees_array_all=DB::table('users')->get();
            $employee_rating_all=DB::table('skill_rating')->orderBy($sort1, $order1)->paginate(10);
        
        $emp_sum_array=array();
         
            foreach($employees_array as $u){
        $now = Carbon::now();
        $uid=$u->id;
        $uname=$u->name;
        $lastMonth_s =  $now->subMonth()->format('F');
        $leave_count_full_day = DB::table('leave_requests')->where('request_by', '=', $uid )->where('status','=','approved')->where('category','=','full day')->count(); 
        $leave_count_this_month_full_day = DB::table('leave_requests')->where('request_by', '=', $uid  )->where('status','=','approved')->where('category','=','full day')->whereYear('date_','=',$now)->whereMonth('date_','=',$lastMonth_s)->count();
        $leave_count_half_day = DB::table('leave_requests')->where('request_by', '=', $uid )->where('status','=','approved')->where('category','=','half day')->count(); 
        $leave_count_this_month_half_day = DB::table('leave_requests')->where('request_by', '=', $uid  )->where('status','=','approved')->where('category','=','half day')->whereYear('date_','=',$now)->whereMonth('date_','=',$lastMonth_s)->count();
        $leave_count_short_leave = DB::table('leave_requests')->where('request_by', '=', $uid )->where('status','=','approved')->where('category','=','short leave')->count(); 
        $leave_count_this_month_short_leave = DB::table('leave_requests')->where('request_by', '=', $uid  )->where('status','=','approved')->where('category','=','short leave')->whereYear('date_','=',$now)->whereMonth('date_','=',$lastMonth_s)->count();
        $approved_leave_count=$leave_count_full_day + $leave_count_half_day/2 +$leave_count_short_leave/4;
        
        $approved_leave_count_this_month=$leave_count_this_month_full_day+$leave_count_this_month_half_day/2+$leave_count_this_month_short_leave/4;
            
        $KPI=DB::table('skill_rating')->where([['emp_id', '=', $uid],])->Count();
            
       $training_done_count_this_month = DB::table('training_schedule')->where('assigned_to', 'like', '%'.$uid.'%' )->whereYear('start','=',$now)->whereMonth('start','=',$lastMonth_s)->count();
       
       $emp_sum_array[0]=$uname;
            $emp_sum_array[1]=$training_done_count_this_month;
            $emp_sum_array[2]=$approved_leave_count_this_month;
            $emp_sum_array[3]=$KPI;
            
            
            }
        
        

            return view('skill_rating.index',  compact('employees_array','emp_rating_array','employee_rating_all','employees_array_all','emp_sum_array'));
          
           
        }
     
        public static function get_user_name($user_id)
    {
        $user_=DB::table('users')->select('name')->where([['id', '=', $user_id],])->first();
        
        return $user_;
    }
    
        public function index2(Request $request)
        {
            
            $emp_to_rate_id=$request->employeeTorate;
            
            
            $emp_to_rate = DB::table('skill_rating')->where('emp_id', '=', $emp_to_rate_id)->first();     
            
           
            
            return view('skill_rating.edit',compact('emp_to_rate','emp_to_rate_id'));
            
           
        }

        /**
         * Store new events.
         *
         * @return \Illuminate\View\View
         * @param  \App\Http\Request   $request
         */
        public function store(Request $request)
        {
            
          
            $ratedBy = auth()->id();
           
            $total_kpi_value=(2*($request->file_receivings))+(2*($request->offers))+(2*($request->visa_grants))+($request->IELTS_class_registrations)+($request->IELTS_exam_registrations);
             /*
             1 file_receiving =2 points
             1 offer =2 points
             1 visa_grant =2 points
             1 IELTS_class_registration =1 point
             1 IELTS_exam_registration =1 point
             */
            DB::table('skill_rating')->where('id', '=', $request->emp_to_rate_id_)->updateOrInsert(
                    array(   
                    'emp_id'=>$request->emp_to_rate_id_,
                    'file_receivings' => $request->file_receivings,
                    'offers' => $request->offers,
                    'visa_grants'=> $request->visa_grants,
                    'IELTS_class_registrations'=> $request->IELTS_class_registrations,
                    'IELTS_exam_registrations'=> $request->IELTS_exam_registrations,
                    'total_kpi'=> $total_kpi_value,
                    'rated_by'=>$ratedBy,
                    )
                );
        
    
            
           
            return redirect()->route('skill_rating')->withStatus(__('ratings successfully updated.'));
        }
    
    }
    