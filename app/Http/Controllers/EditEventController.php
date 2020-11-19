<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Uuid;
use Carbon\Carbon;

class EditEventController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
     
        $event_Id = $request->eventId;
        $event_old = DB::table('calender_events')->where('id', '=', $event_Id)->first();
        $assignees = explode(",", $event_old->assigned_to);
        $assignees_string="";
        for($i=0;$i<sizeof($assignees)-1;$i++){
            $int_assignee = $assignees[$i];
            $user_detail = DB::table('users')->where('id', '=', $int_assignee )->first();
            $name = $user_detail->name;
            $email= $user_detail->email;
            $assignees_string=$name.' : '.$email.' , '.$assignees_string;
        }
        $daysofweekOriginalString=$event_old->daysOfWeek;
        $daysofweekFirstbracketremove=substr($daysofweekOriginalString, 1);
        $daysofweekSeconedbracketremove=substr($daysofweekFirstbracketremove, 0,-1);
        $daysofweekarray=explode(",",$daysofweekSeconedbracketremove);
        array_pop($daysofweekarray);
        $daysofweekfinalString="";
        for($i=0;$i<sizeof($daysofweekarray);$i++){
            switch ($i) {
                case 0:
                    $daysofweekfinalString='Sunday , '.$daysofweekfinalString;
                break;
                case 1:
                    $daysofweekfinalString='Monday , '.$daysofweekfinalString;
                break;   
                case 2:
                    $daysofweekfinalString='Tuesday , '.$daysofweekfinalString;
                break;
                case 3:
                    $daysofweekfinalString='Wednesday , '.$daysofweekfinalString;
                break;   
                case 4:
                    $daysofweekfinalString='Thursday , '.$daysofweekfinalString;
                break;  
                case 5:
                    $daysofweekfinalString='Friday , '.$daysofweekfinalString;
                break;
                case 6:
                    $daysofweekfinalString='Saturday , '.$daysofweekfinalString;
                break;   
            }
        }

        $assigned_by_value = DB::table('users')->where('id', '=', $event_old->assigned_by)->first();
        $assigned_by_detail = $assigned_by_value->name.' : '.$assigned_by_value->email;
        $old_event=array(
                'id'=>$event_old->id,
                'title' => $event_old->title,
                'description' =>$event_old->description,
                'start' =>$event_old->start,
                'end'=>$event_old->end,
                'startTime' =>$event_old->startTime,
                'endTime'=>$event_old->endTime,
                'startRecur' =>$event_old->startRecur,
                'endRecur'=>$event_old->endRecur,
                'daysOfWeek'=>$daysofweekfinalString,
                'groupId'=>$event_old->groupId,
                'assigned_by'=>$event_old->assigned_by,
                'assigned_by_detail'=>$assigned_by_detail,
                'assigned_to_string'=>$assignees_string,
                'assigned_to_array'=>$assignees,
                'location'=>$event_old->location,
                'notes'=>$event_old->notes
        );
        $assignees_array = DB::table('users')->select('id','name')->get();
       return view('editEvent',compact('old_event','assignees_array'));
      
       
    }

     /**
     * Store new events.
     *
     * @return \Illuminate\View\View
     * @param  \App\Http\Request   $request
     */
    public function store(Request $request)
    {
        $uuid = null;
        $id = auth()->id();
       $event_Id =$request->eventId;
if($request->assignesto!=null){
        $assigned_to='';
        foreach($request->assignesto as $key){

            $assigned_to=strval($key).','.$assigned_to;

        }
}
    $days_Of_Week='';
    $days_Of_Week_array=null;
        if($request->daysOfWeek!= null){
            
        foreach($request->daysOfWeek as $key){

            $days_Of_Week=strval($key).','.$days_Of_Week;

        }
        $days_Of_Week_array='['.$days_Of_Week.']';
    }

        if($request->startRecur!=null){
            $uuid = Uuid::generate()->string;
        }

        DB::table('calender_events')->where('id', '=', $event_Id)->update(
            array(
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
                'updated_at'=>now(),
            )
        );

        return redirect()->to('/home'); 
    }
}
