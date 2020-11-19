<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;


class DailyAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($sort, $order)
    {
        $date_limit = Carbon::now()->subDays(60);
        $dailyAttendance = DB::table('daily_attendances')->whereDate('date', '>=',  $date_limit)->orderBy($sort, $order)->paginate(10);
//->orderBy($sort, $order)->paginate(10)
    //
        return view('daily_attendance.index')->with('dailyAttendance', $dailyAttendance);
    }


     /**
     * Import function
     */
    public function import(Request $request)
    {
        if ($request->file('imported_file')) {
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($request->file('imported_file'));
$reader->setReadDataOnly(true);
//$reader->setLoadSheetsOnly('Logs');

            $spreadsheet = $reader->load($request->file('imported_file'));

            //no of sheets
            $numberOfsheets=$spreadsheet->getSheetCount();

            $sheetLog=$spreadsheet->getSheet('1');
            //date-year/month
            $year_month_full_string=$sheetLog->getCell('C3')->getValue();
            $year_month_arr=explode("~", $year_month_full_string);
            $year_month=$year_month_arr[0];
            $year_month_separated=explode("/", $year_month);
            $year=$year_month_separated[0];
            $month=$year_month_separated[1];

      for($i=2;$i<$numberOfsheets;$i++){
        $sheet = $spreadsheet->getSheet($i);

        //table 1
        $user_att_name=$sheet->getCell('J3')->getValue();
        //add unique username column to users table and replace name with username,give in instructions in add user/profile page to use username from fingerprint machine
        $user_att=DB::table('users')->where('name', '=', $user_att_name)->first();
        for($j=12;$j<43;$j++){
            //date-date
            $date_arr=explode(" ",$sheet->getCell('A'.$j)->getValue());
            $date=$date_arr[0];
            //date-year/month/date
            if($date!=null){
            $final_date_timestamp=strtotime($year.'-'.$month.'-'.$date);
            $final_date=date("Y-m-d", $final_date_timestamp);
            //in AM
            $in_am=null;
            $in_am_str=$sheet->getCell('B'.$j)->getValue();
            if($in_am_str!=null){
            $in_am_timestamp=strtotime($in_am_str);
            $in_am=date("h:i:s", $in_am_timestamp);
            }

            //out AM
            $out_am=null;
            $out_am_str=$sheet->getCell('D'.$j)->getValue();
            if($out_am_str!=null){
                $out_am_timestamp=strtotime($out_am_str);
                $out_am=date("h:i:s", $out_am_timestamp);
                }

            //in PM
            $in_pm=null;
            $in_pm_str=$sheet->getCell('G'.$j)->getValue();
            if($in_pm_str!=null or $in_pm_str!="Absence"){
                $in_pm_timestamp=strtotime($in_pm_str);
                $in_pm=date("h:i:s", $in_pm_timestamp);
                }

            //out PM
            $out_pm=null;
            $out_pm_str=$sheet->getCell('I'.$j)->getValue();
            if($out_pm_str!=null){
                $out_pm_timestamp=strtotime($out_pm_str);
                $out_pm=date("h:i:s", $out_pm_timestamp);
                }


                if($in_pm_str!="Absence"){
                    DB::table('daily_attendances')->insertOrIgnore([
                        [
                            'emp_id' =>$user_att->id,
                            'date' =>$final_date,
                            'in_am'=>$in_am,
                            'out_am' =>$out_am,
                            'in_pm'=>$in_pm,
                            'out_pm' =>$out_pm,
                            'status'=>'presence',
                            'created_at'=>now(),
                        ],
                    ]);
                }else{
                    $atten_id=$user_att->id;
                    $missing_att_record=DB::table('missing_attendance')->where('request_by', '=',  $atten_id)->where('status', '=', 'approved')->whereDate('date', '=',  $final_date)->first();
                    $leave_record=DB::table('leave_requests')->where('request_by', '=',  $atten_id)->where('status', '=', 'approved')->whereDate('date_', '=',  $final_date)->first();
                   
                    if($missing_att_record==null and $leave_record==null ){
                    DB::table('daily_attendances')->insertOrIgnore([
                        [
                            'emp_id' =>$user_att->id,
                            'date' =>$final_date,
                            'status'=>'Absence',
                            'created_at'=>now(),
                        ],
                    ]); 
                   }
                }
            }
        }

         //table 2
         $user_att_name=$sheet->getCell('Y3')->getValue();
         //add unique username column to users table and replace name with username,give in instructions in add user/profile page to use username from fingerprint machine
         $user_att=DB::table('users')->where('name', '=', $user_att_name)->first();
         for($j=12;$j<43;$j++){
             //date-date
             $date_arr=explode(" ",$sheet->getCell('P'.$j)->getValue());
             $date=$date_arr[0];
             if($date!=null){
             //date-year/month/date
             $final_date_timestamp=strtotime($year.'-'.$month.'-'.$date);
             $final_date=date("Y-m-d", $final_date_timestamp);
             //in AM
             $in_am=null;
             $in_am_str=$sheet->getCell('Q'.$j)->getValue();
             if($in_am_str!=null){
             $in_am_timestamp=strtotime($in_am_str);
             $in_am=date("h:i:s", $in_am_timestamp);
             }
 
             //out AM
             $out_am=null;
             $out_am_str=$sheet->getCell('S'.$j)->getValue();
             if($out_am_str!=null){
                 $out_am_timestamp=strtotime($out_am_str);
                 $out_am=date("h:i:s", $out_am_timestamp);
                 }
 
             //in PM
             $in_pm=null;
             $in_pm_str=$sheet->getCell('V'.$j)->getValue();
             if($in_pm_str!=null or $in_pm_str!="Absence"){
                 $in_pm_timestamp=strtotime($in_pm_str);
                 $in_pm=date("h:i:s", $in_pm_timestamp);
                 }
 
             //out PM
             $out_pm=null;
             $out_pm_str=$sheet->getCell('X'.$j)->getValue();
             if($out_pm_str!=null){
                 $out_pm_timestamp=strtotime($out_pm_str);
                 $out_pm=date("h:i:s", $out_pm_timestamp);
                 }
 
 
                 if($in_pm_str!="Absence"){
                     DB::table('daily_attendances')->insertOrIgnore([
                         [
                             'emp_id' =>$user_att->id,
                             'date' =>$final_date,
                             'in_am'=>$in_am,
                             'out_am' =>$out_am,
                             'in_pm'=>$in_pm,
                             'out_pm' =>$out_pm,
                             'status'=>'presence',
                             'created_at'=>now(),
                         ],
                     ]);
                 }else{
                    $atten_id=$user_att->id;
                    $missing_att_record=DB::table('missing_attendance')->where('request_by', '=',  $atten_id)->where('status', '=', 'approved')->whereDate('date', '=',  $final_date)->first();
                    $leave_record=DB::table('leave_requests')->where('request_by', '=',  $atten_id)->where('status', '=', 'approved')->whereDate('date_', '=',  $final_date)->first();
                   
                    if($missing_att_record==null and $leave_record==null ){
                     DB::table('daily_attendances')->insertOrIgnore([
                         [
                             'emp_id' =>$user_att->id,
                             'date' =>$final_date,
                             'status'=>'Absence',
                             'created_at'=>now(),
                         ],
                     ]); 
                        }
                 }
                }
         }

          //table 3
        $user_att_name=$sheet->getCell('AN3')->getValue();
        //add unique username column to users table and replace name with username,give in instructions in add user/profile page to use username from fingerprint machine
        $user_att=DB::table('users')->where('name', '=', $user_att_name)->first();
        for($j=12;$j<43;$j++){
            //date-date
            $date_arr=explode(" ",$sheet->getCell('AE'.$j)->getValue());
            $date=$date_arr[0];
            if($date!=null){
            //date-year/month/date
            $final_date_timestamp=strtotime($year.'-'.$month.'-'.$date);
            $final_date=date("Y-m-d", $final_date_timestamp);
            //in AM
            $in_am=null;
            $in_am_str=$sheet->getCell('AF'.$j)->getValue();
            if($in_am_str!=null){
            $in_am_timestamp=strtotime($in_am_str);
            $in_am=date("h:i:s", $in_am_timestamp);
            }

            //out AM
            $out_am=null;
            $out_am_str=$sheet->getCell('AH'.$j)->getValue();
            if($out_am_str!=null){
                $out_am_timestamp=strtotime($out_am_str);
                $out_am=date("h:i:s", $out_am_timestamp);
                }

            //in PM
            $in_pm=null;
            $in_pm_str=$sheet->getCell('AK'.$j)->getValue();
            if($in_pm_str!=null or $in_pm_str!="Absence"){
                $in_pm_timestamp=strtotime($in_pm_str);
                $in_pm=date("h:i:s", $in_pm_timestamp);
                }

            //out PM
            $out_pm=null;
            $out_pm_str=$sheet->getCell('AM'.$j)->getValue();
            if($out_pm_str!=null){
                $out_pm_timestamp=strtotime($out_pm_str);
                $out_pm=date("h:i:s", $out_pm_timestamp);
                }


                if($in_pm_str!="Absence"){
                    DB::table('daily_attendances')->insertOrIgnore([
                        [
                            'emp_id' =>$user_att->id,
                            'date' =>$final_date,
                            'in_am'=>$in_am,
                            'out_am' =>$out_am,
                            'in_pm'=>$in_pm,
                            'out_pm' =>$out_pm,
                            'status'=>'presence',
                            'created_at'=>now(),
                        ],
                    ]);
                }else{
                    $atten_id=$user_att->id;
                    $missing_att_record=DB::table('missing_attendance')->where('request_by', '=',  $atten_id)->where('status', '=', 'approved')->whereDate('date', '=',  $final_date)->first();
                    $leave_record=DB::table('leave_requests')->where('request_by', '=',  $atten_id)->where('status', '=', 'approved')->whereDate('date_', '=',  $final_date)->first();
                   
                    if($missing_att_record==null and $leave_record==null ){
                    DB::table('daily_attendances')->insertOrIgnore([
                        [
                            'emp_id' =>$user_att->id,
                            'date' =>$final_date,
                            'status'=>'Absence',
                            'created_at'=>now(),
                        ],
                    ]); 
                    }
                }
            }
        }
          
      }
            $val=$spreadsheet->getSheet('2')->getCell('B12')->getValue();
            
            session()->flash('val', $val==null);
            return redirect()->to('/dailyAttendance'); 
        }
    }


    /**
     * Export function
     */
    public function export_this_year()
    {
    $now  = Carbon::now();
        // CREATE A NEW SPREADSHEET + SET METADATA
$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()
->setTitle('Daily Attendance');
 
// NEW WORKSHEET
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Attendance all');
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Employee');
$sheet->setCellValue('C1', 'Date');
$sheet->setCellValue('D1', 'In');
$sheet->setCellValue('E1', 'Out');

$dailyAttendance = DB::table('daily_attendances')->get();
$i=2;
foreach($dailyAttendance as $row){
    $sheet->setCellValue('A'.$i, $row->id);
    $sheet->setCellValue('B'.$i, $row->emp_id);
    $sheet->setCellValue('C'.$i, $row->date);
    $sheet->setCellValue('D'.$i, $row->start);
    $sheet->setCellValue('E'.$i, $row->end);
    $i=$i+1;
}

// OUTPUT
$writer = new Xlsx($spreadsheet);
// OR FORCE DOWNLOAD
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="attendance.xlsx"');
header('Cache-Control: max-age=0');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: cache, must-revalidate');
header('Pragma: public');
$writer->save('php://output');
    }
 public function export()
    {
        // CREATE A NEW SPREADSHEET + SET METADATA
$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()
->setTitle('Daily Attendance');
 
// NEW WORKSHEET
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Attendance all');
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Employee');
$sheet->setCellValue('C1', 'Date');
$sheet->setCellValue('D1', 'In');
$sheet->setCellValue('E1', 'Out');

$dailyAttendance = DB::table('daily_attendances')->whereDate('date','>',$now->subDays(365))->get();
$i=2;
foreach($dailyAttendance as $row){
    $sheet->setCellValue('A'.$i, $row->id);
    $sheet->setCellValue('B'.$i, $row->emp_id);
    $sheet->setCellValue('C'.$i, $row->date);
    $sheet->setCellValue('D'.$i, $row->start);
    $sheet->setCellValue('E'.$i, $row->end);
    $i=$i+1;
}

// OUTPUT
$writer = new Xlsx($spreadsheet);
// OR FORCE DOWNLOAD
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="attendance.xlsx"');
header('Cache-Control: max-age=0');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: cache, must-revalidate');
header('Pragma: public');
$writer->save('php://output');
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DailyAttendance  $dailyAttendance
     * @return \Illuminate\Http\Response
     */
    public function show(DailyAttendance $dailyAttendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DailyAttendance  $dailyAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit(DailyAttendance $dailyAttendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DailyAttendance  $dailyAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DailyAttendance $dailyAttendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DailyAttendance  $dailyAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(DailyAttendance $dailyAttendance)
    {
        //
    }

}
