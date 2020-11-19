<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Uuid;
use Carbon\Carbon;


class HomeController extends Controller
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
        $id = auth()->id();
   
        $calender_events = DB::table('calender_events')->where('assigned_by', '=', $id)->get();//assigned by user

        $calender_events2 = DB::table('calender_events')->where('assigned_to', 'like', '%'.$id.'%' )->where('assigned_by', '!=', $id)->get();//assigned to user

        $calender_events3 = DB::table('calender_events')->where('assigned_to', '=', null )->where('assigned_by', '!=', $id)->get();// not assigned to anyone

        $ce = $calender_events->toJson();
        $ce2 = $calender_events2->toJson();
        $ce3 = $calender_events3->toJson();

        $assignees_array = DB::table('users')->select('id','name')->where('id', '!=', $id)->get();
        $no_of_leaves=$this->no_of_leaves();
        $no_of_leaves_y=$this->no_of_leaves_y();
        $no_of_absent_days=$this->no_of_absent_days();
        $birthday_array=$this->birthdays();
        $anniversary_array=$this->anniversarys();
       return view('dashboard',  compact('ce','ce2','ce3','assignees_array','no_of_leaves','no_of_leaves_y','no_of_absent_days','birthday_array','anniversary_array'));
      
       
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
       $uuid = null;
       $days_Of_Week_array=null;

        
        $array = (array)$request->assignesto;
        if(count($array)!=0){
            $assigned_to='';
        foreach($request->assignesto as $key){

            $assigned_to=strval($key).','.$assigned_to;

        }
    }else{
        $assigned_to=null;
    }
        if($request->daysOfWeek!= null){
            $days_Of_Week='';
        foreach($request->daysOfWeek as $key){

            $days_Of_Week=strval($key).','.$days_Of_Week;

        }
        $days_Of_Week_array='['.$days_Of_Week.']';
    }
        if($request->startRecur!=null){
            $uuid = Uuid::generate()->string;
        }
    
//to do --------------add if else to prevent duplicate entry
        DB::table('calender_events')->insertOrIgnore([
            [
                'title' => $request->title,
                'description' =>$request->description,
                'start' =>$request->start,
                'end'=>$request->end,
                'startTime' =>$request->startTime,
                'endTime'=>$request->endTime,
                'startRecur' =>$request->startRecur,
                'endRecur'=>$request->endRecur,
                'daysOfWeek'=>$days_Of_Week_array,
                'groupId'=>$uuid,
                'assigned_by'=>$id,
                'assigned_to'=>$assigned_to,
                'location'=>$request->location,
                'notes'=>$request->notes,
                'created_at'=>now(),
            ],
        ]);

        return redirect()->to('/home'); 
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

        DB::table('calender_events')->where('id', '=', $event_Id)->delete();

        return redirect()->to('/home'); 
        
    }

    public function no_of_leaves()
    {
        $id = auth()->id();
        $now = Carbon::now();
        $leaves_fullDay = DB::table('leave_requests')->where('request_by', '=', $id )->where('status', '=', 'approved')->where('category', '=', 'full day')->whereYear('date_','=',$now)->whereMonth('date_', '=', $now->month)->count();
        $leaves_halfDay = DB::table('leave_requests')->where('request_by', '=', $id )->where('status', '=', 'approved')->where('category', '=', 'half day')->whereYear('date_','=',$now)->whereMonth('date_', '=', $now->month)->count();
        $leaves_shortLeave = DB::table('leave_requests')->where('request_by', '=', $id )->where('status', '=', 'approved')->where('category', '=', 'short leave')->whereYear('date_','=',$now)->whereMonth('date_', '=', $now->month)->count();
        
        $leave_balance = $leaves_fullDay +($leaves_halfDay/2)+($leaves_shortLeave/4);

        return $leave_balance;
    }
    public function no_of_leaves_y()
    {
        $id = auth()->id();
        $now = Carbon::now();
        $leave_balance_y = DB::table('leave_requests')->where('request_by', '=', $id )->where('status', '=', 'approved')->where('category', '=', 'full day')->whereYear('date_','=',$now)->count();

        return $leave_balance_y;
    }

    public function no_of_absent_days()
    {
        $id = auth()->id();
        $now = Carbon::now();
        $month_=$now->month;
        $last_month=$month_-1;

        $absent_days = DB::table('daily_attendances')->where('emp_id', '=', $id )->where('status', '=', 'Absence')->whereYear('date','=',$now)->whereMonth('date', '=', $last_month)->count();
         return $absent_days;  
    }
    public function birthdays()
    {
        $now = Carbon::now();
        $birthdays = DB::table('users')->whereDate('birthday', '=', $now)->get();
        return $birthdays;
    }

    public function anniversarys()
    {
        $now = Carbon::now();
        $anniversarys = DB::table('users')->whereDate('anniversary', '=', $now)->get();
        return $anniversarys;
    }
 
}
