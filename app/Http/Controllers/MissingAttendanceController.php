<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MissingAttendanceController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index($sort,$order,$sort1,$order1)
    {
        $id = auth()->id();
    
     $count = DB::table('missing_attendance')->where('request_by', '=', $id)->count();
    if($count<10){
        $attendance_requests = DB::table('missing_attendance')->where('request_by', '=', $id)->orderBy($sort, $order)->get();  
    }else{
     $attendance_requests = DB::table('missing_attendance')->where('request_by', '=', $id)->orderBy($sort, $order)->paginate(10);
    }
    $count = DB::table('missing_attendance')->where('manger_to_approve', '=', $id)->count();
    if($count<10){
    
        $to_approve = DB::table('missing_attendance')->where('manger_to_approve', '=', $id)->orderBy($sort1, $order1)->get();
   }else{
    $to_approve = DB::table('missing_attendance')->where('manger_to_approve', '=', $id)->orderBy($sort1, $order1)->paginate(10);
    }
        return view('attendance.view',  compact('attendance_requests','to_approve'));
      
       
    }
    public static function get_user_name($user_id)
    {
        $user_=DB::table('users')->select('name')->where('id', '=', $user_id)->first();
        
        return $user_;
    }

    public static function reject(Request $request)
    {
        $attid=$request->requestId;
        DB::table('missing_attendance')->where('id', '=',  $attid)->update(['status' =>'rejected']); 

        return redirect()->to('/attendance'); 
      
        
    }
    public static function approve(Request $request)
    {
        $attid=$request->requestId;
        DB::table('missing_attendance')->where('id', '=',  $attid)->update(['status' => 'approved']);

        $missing_att_record=DB::table('missing_attendance')->where('id', '=',  $attid)->first();

        $missing_att_date=$missing_att_record->date;
        $missing_att_in=$missing_att_record->start;
        $missing_att_inmid=$missing_att_record->startmid;
        $missing_att_outmid=$missing_att_record->endmid;
        $missing_att_out=$missing_att_record->end;
        $missing_att_empid=$missing_att_record->request_by;

        $dailyAttendance_record = DB::table('daily_attendances')->where('emp_id', '=',  $missing_att_empid)->whereDate('date', '=',  $missing_att_date)->first();

        if($dailyAttendance_record==null){

            DB::table('daily_attendances')->insertOrIgnore([
                [
                    'emp_id' =>$missing_att_empid,
                    'date' =>$missing_att_date,
                    'in_am'=>$missing_att_in,
                    'out_am'=>$missing_att_inmid,
                    'in_pm'=>$missing_att_outmid,
                    'out_pm' =>$missing_att_out,
                    'status'=>'presence',
                    'created_at'=>now(),
                ],
            ]);

        }else{

            $record_id=$dailyAttendance_record->id;
            DB::table('daily_attendances')->where('id', '=', $record_id)->update([
                [
                    'date' =>$missing_att_date,
                    'in_am'=>$missing_att_in,
                    'out_am'=>$missing_att_inmid,
                    'in_pm'=>$missing_att_outmid,
                    'out_pm' =>$missing_att_out,
                    'status'=>'presence',
                    'updated_at'=>now(),
                ],
            ]);
        }
        return redirect()->to('/attendance');    
    }

    /**
     * Store new events.
     *
     * @return \Illuminate\View\View
     * @param  \App\Http\Request   $request
     */
    public function store(Request $request)
    {
        if($request->att_id_=="add"){
        
        $id = auth()->id();
        

        DB::table('missing_attendance')->insert([
            [
                'reason' => $request->reason,
                'date'=>$request->date,
                'start' =>$request->start,
                'startmid' =>$request->startmid,
                'endmid'=>$request->endmid,
                'end'=>$request->end,
                'request_by'=>auth()->id(),
                'manger_to_approve'=>auth()->user()->supervisor_manager,
                'created_at'=>now(),
            ],
        ]);
        }else{
            DB::table('missing_attendance')->where('id', '=', $request->att_id_)->update(
                array(
                'reason' => $request->reason,
                'date'=>$request->date,
                'start' =>$request->start,
                'startmid' =>$request->startmid,
                'endmid'=>$request->endmid,
                'end'=>$request->end,
                'request_by'=>auth()->id(),
                'manger_to_approve'=>auth()->user()->supervisor_manager,
                'updated_at'=>now(),
                )
            );
    

        }
       
        return redirect()->to('/attendance'); 
    }
    public static function destroy(Request $request)
    {
        $attid=$request->requestId;
        DB::table('missing_attendance')->where('id', '=',  $attid)->delete();
        return redirect()->to('/attendance'); 
    }
    

    public function index2(Request $request)
    {
        
        $attid=$request->requestId;
        
        if($attid=="add"){
            $attendance_req =null;
            return view('attendance.add_edit',compact('attid','attendance_req'));
            
        }else{
            $attendance_req = DB::table('missing_attendance')->where('id', '=', $attid)->first(); 
           
            return view('attendance.add_edit',compact('attid','attendance_req'));
        }
       
        
      
       
    }

}
