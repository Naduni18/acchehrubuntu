<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TrainingScheduleSummarryController extends Controller
{
   
        /**
         * Show the application dashboard.
         *
         * @return \Illuminate\View\View
         */
        public function index()
        { 

        $id = auth()->id();
        $summary=array();
        $users=DB::table('users')->where('supervisor_manager', '=', $id)->get();

        array_push($summary,array("employee","# of total training sessions ","# of training sessions in current month","KPI value of the employee"));
        foreach($users as $u){

        $now = Carbon::now();
        $uid=$u->id;
        $uname=$u->name;
        $employee_rating=DB::table('skill_rating')->where([['emp_id', '=', $uid],])->first();
        if($employee_rating!=null){
        $kpival=$employee_rating->total_kpi;
        }else{
        $kpival=null;
        }
        $training_done_count = DB::table('training_schedule')->where('assigned_to', 'like', '%'.$uid.'%' )->count(); 
        $training_done_count_this_month = DB::table('training_schedule')->where('assigned_to', 'like', '%'.$uid.'%' )->whereYear('start','=',$now)->whereMonth('start','=',$now)->count();
        array_push($summary,array($uname,$training_done_count,$training_done_count_this_month,$kpival));

        }
        
        $sum= json_encode($summary);
           return view('training_schedule.progress',compact('sum'));        
        }

        
}
