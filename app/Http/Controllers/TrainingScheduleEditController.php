<?php

    namespace App\Http\Controllers;
    
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Http\Request;
    
    class TrainingScheduleEditController extends Controller
    {
        /**
         * Show the application dashboard.
         *
         * @return \Illuminate\View\View
         */
        public function index(Request $request)
        {
         
            $event_Id = $request->eventId;
            $event_old = DB::table('training_schedule')->where('id', '=', $event_Id)->first();
            $assignees = explode(",", $event_old->assigned_to);
            $assignees_string="";
            for($i=0;$i<sizeof($assignees)-1;$i++){
                $int_assignee = $assignees[$i];
                $user_detail = DB::table('users')->where('id', '=', $int_assignee )->first();
                $name = $user_detail->name;
                $email= $user_detail->email;
                $assignees_string=$name.' : '.$email.' , '.$assignees_string;
            }
           
            $assigned_by_value = DB::table('users')->where('id', '=', $event_old->assigned_by)->first();
            $assigned_by_detail = $assigned_by_value->name.' : '.$assigned_by_value->email;
            $conductor_val = DB::table('users')->where('id', '=', $event_old->conducted_by)->first();
            $conductor = $conductor_val->name.' : '.$conductor_val->email;
            $old_event=array(
                    'id'=>$event_old->id,
                    'title' => $event_old->title,
                    'startTime' =>$event_old->start,
                    'endTime'=>$event_old->end,
                    'assigned_by'=>$event_old->assigned_by,
                    'assigned_by_detail'=>$assigned_by_detail,
                    'assigned_to_string'=>$assignees_string,
                    'assigned_to_array'=>$assignees,
                    'conducted_by_string'=>$conductor,
                    'conducted_by'=>strval($event_old->conducted_by),
                    'location'=>$event_old->location,
                    'notes'=>$event_old->notes
            );
            $assignees_array = DB::table('users')->select('id','name')->get();
           return view('training_schedule.edit',compact('old_event','assignees_array'));
          
           
        }
    
        /**
         * Store new events.
         *
         * @return \Illuminate\View\View
         * @param  \App\Http\Request   $request
         */
        public function store(Request $request)
        {
            
           $id = auth()->id();
        $count=0;
       $ret=0;
        $empnames = '';
            $assigned_to='';
         $calender_events = DB::table('training_schedule')->get();
    
            $ce = $calender_events->toJson();
    
            $assignees_array = DB::table('users')->select('id','name')->get();
    
         
            
          
        
        if($request->assignesto!=null){
        
            foreach($request->assignesto as $key){
            
            $leav=DB::table('leave_requests')->where('request_by', '=',  $key)->where('status','=','approved')->whereDate('date', '>=',  $request->start)->whereDate('date', '<=',  $request->end)->first();
               if($leav=null){
            $assigned_to=strval($key).','.$assigned_to;
               }else{
               $ret=1;
               $userleave = DB::table('users')->where('id','=',$key)->first();
               $n=$userleave->name;
               $empnames = $empnames.$n.', ';
               }}
    
            }
        $leavc=DB::table('leave_requests')->where('request_by', '=',  $request->conducted_by)->where('status','=','approved')->whereDate('date', '>=',  $request->start)->whereDate('date', '<=',  $request->end)->first();
        if($leavc!=null){
        $ret=1;
               $userleave = DB::table('users')->where('id','=',$request->conducted_by)->first();
               $n=$userleave->name;
               $empnames = $empnames.$n.', ';
        }
            
        
        if($ret=0){
    //to do --------------add if else to prevent duplicate entry
            DB::table('training_schedule')->update(
            array(
                
                    'title' => $request->title,
                    'start' =>$request->startTime,
                    'end'=>$request->endTime,
                    'assigned_by'=>$id,
                    'conducted_by'=>$request->conducted_by,
                    'assigned_to'=>$assigned_to,
                    'location'=>$request->location,
                    'notes'=>$request->notes,
                    'updated_at'=>now(),
                ));
    
            
            return redirect()->to('/trainingSchedule'); 
           }else{
           $err = 'employees '.$empnames.' are in leave these days';
            return view('training_schedule.index',  compact('ce','assignees_array','err'));
           } 
        }
    
    }
    