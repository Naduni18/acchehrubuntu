<?php

    namespace App\Http\Controllers;
    
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Http\Request;
    use Uuid;
    
    
    
    class TrainingScheduleController extends Controller
    {
        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct()
        {
            $this->middleware('auth');
        }
    
        /**
         * Show the application dashboard.
         *
         * @return \Illuminate\View\View
         */
        public function index()
        {
           
            $calender_events = DB::table('training_schedule')->get();
    
            $ce = $calender_events->toJson();
    
            $assignees_array = DB::table('users')->select('id','name')->get();
    
         
            $err=null;
           return view('training_schedule.index',  compact('ce','assignees_array','err'));
          
           
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
            
            $leav=DB::table('leave_requests')->where('request_by', '=',  $key)->where('status','=','approved')->whereDate('date_', '>=',  $request->start)->whereDate('date_', '<=',  $request->end)->first();
               if($leav=null){
            $assigned_to=strval($key).','.$assigned_to;
               $ret=0;
               }else{
               $ret=1;
               $userleave = DB::table('users')->where('id','=',$key)->first();
               $n=$userleave->name;
               $empnames = $empnames.$n.', ';
               }}
    
            }
        $leavc=DB::table('leave_requests')->where('request_by', '=',  $request->conducted_by)->where('status','=','approved')->whereDate('date_', '>=',  $request->start)->whereDate('date_', '<=',  $request->end)->first();
        if($leavc!=null){
        $ret=1;
               $userleave = DB::table('users')->where('id','=',$request->conducted_by)->first();
               $n=$userleave->name;
               $empnames = $empnames.$n.', ';
        }
            
        
         if($ret=0){
    //to do --------------add if else to prevent duplicate entry
            DB::table('training_schedule')->insertOrIgnore([
                [
                    'title' => $request->title,
                    'start' =>$request->start,
                    'end'=>$request->end,
                    'assigned_by'=>$id,
                    'conducted_by'=>$request->conducted_by,
                    'assigned_to'=>$assigned_to,
                    'location'=>$request->location,
                    'notes'=>$request->notes,
                    'created_at'=>now(),
                ],
            ]);
          
            return redirect()->to('/trainingSchedule'); 
           }else{
           $err = 'employees '.$empnames.' are in leave these days';
            return view('training_schedule.index',  compact('ce','assignees_array','err'));
           }
        
        }
    
        /**
         * Store new events.
         *
         * @return \Illuminate\View\View
         * @param  \App\Http\Request   $request
         */
        public function delete(Request $request)
        {
            $event_Id = $request->eventId;
    
            DB::table('training_schedule')->where('id', '=', $event_Id)->delete();
    
            return redirect()->to('/trainingSchedule'); 
            
        }
     
    }
    