<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DailyAttendanceSummaryController extends Controller
{
    /**
         * Show the application dashboard.
         *
         * @return \Illuminate\View\View
         */
        public function index()
        { 

        $id = auth()->id();

        $now = Carbon::now();
        $nowsting=$now->format('Y');
        $nowint=intval($nowsting);
        $thisYear=$now->year;
        $thisMonth=$now->month;
        $feb=28;

        $this_year_summary=array();
        $this_month_summary=array();

        $users=DB::table('users')->where('supervisor_manager', '=', $id)->get();
        $totalNumOfEmployees= count($users);
        ;
        $months=array(
            "01"=>"January", 
            "02"=>"February", 
            "03"=>"March",
            "04"=>"April",
            "05"=>"May",
            "06"=>"June", 
            "07"=>"July", 
            "08"=>"August",
            "09"=>"September",
            "10"=>"October",
            "11"=>"November",
            "12"=>"December",
         );
         
         if((($nowint % 4) == 0) && ((($nowint % 100) != 0) || (($nowint % 400) == 0))){
             $feb=29;
         }
         $daysPerMonth=array(
            "01"=>"31", 
            "02"=>$feb, 
            "03"=>"31",
            "04"=>"30",
            "05"=>"31",
            "06"=>"30", 
            "07"=>"31", 
            "08"=>"31",
            "09"=>"30",
            "10"=>"31",
            "11"=>"30",
            "12"=>"31",
         );
         $month_number=array('01','02','03','04','05','06','07','08','09','10','11','12');
//monthly average attendance
        array_push($this_year_summary,array("Month","Average presence ","Average absence "));
        foreach($month_number as $m){
            $noOfAbsence=0;
            $noOfPresence=0;
            $monthname=$months[$m];
        foreach($users as $u){

        $uid=$u->id;
        $presence_count = DB::table('daily_attendances')->whereYear('date','=',$now)->whereMonth('date','=',$m)->where('emp_id', '=', $uid )->where('status', '=', 'presence' )->count(); 
        $absence_count = DB::table('daily_attendances')->whereYear('date','=',$now)->whereMonth('date','=',$m)->where('emp_id', '=', $uid )->where('status', '=', 'Absence' )->count(); 

        $noOfAbsence=$noOfAbsence+$absence_count;
        $noOfPresence=$noOfPresence+$presence_count;

        }
        $avaragepresence=$noOfPresence/( $daysPerMonth[$m]+$totalNumOfEmployees);
        $avarageabsence=$noOfAbsence/($daysPerMonth[$m]+$totalNumOfEmployees);

        array_push($this_year_summary,array($monthname,$avaragepresence,$avarageabsence));
    }
        $sumYear= json_encode($this_year_summary);

//this month attendance per employee
array_push($this_month_summary,array("employee","presence count"));
foreach($users as $u){
    $uid=$u->id;
    $name=$u->name;
    $presence_count_pre_emp = DB::table('daily_attendances')->whereYear('date','=',$thisYear)->whereMonth('date','=',$thisMonth)->where('emp_id', '=', $uid )->where('status', '=', 'presence' )->count(); 
    
    array_push($this_month_summary,array($name,$presence_count_pre_emp));
}

$sumMonth= json_encode($this_month_summary);
        
        // $absence_count = DB::table('daily_attendances')->whereYear('date','=',$now)->whereMonth('date','=',$m)->where('emp_id', '=', $uid )->where('status', '=', 'Absence' )->count(); 
$this_month_daily_all_summary=array();
        array_push($this_month_daily_all_summary,array("date","presence count"));
for($i=1;$i<$daysPerMonth[$thisMonth]+1;$i++){

$presenceac = DB::table('daily_attendances')->whereYear('date','=',$now)->whereMonth('date','=',$thisMonth)->whereDay('date', $i)->where('status', '=', 'presence' )->count(); 
   array_push($this_month_daily_all_summary,array($i,$presenceac));    
}
        
        
       
       $sumMonthall=json_encode($this_month_daily_all_summary);
           return view('daily_attendance.progress',compact('sumYear','sumMonth','sumMonthall'));        
        }

}
