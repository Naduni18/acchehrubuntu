<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;
use Kyslik\ColumnSortable\Sortable;
use App;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
//use Sortable;
class SalaryController extends Controller
{
    public function index($sort,$order)
    {
    
    
    //public $sortable = ['id','companyname','price','created_at','updated_at'];
    $error_=null;
    
        $now = Carbon::now();
    $nowmonthname=$now->format('F');
    $id = auth()->id();
            $employees_array=DB::table('users')->get();
    $salary =null;
   
   $count = DB::table('salary')->where('for_year','=',$now->year)->where('for_month','=',$nowmonthname)->count();
    if($count<10){
   $salary = DB::table('salary')->where('for_year','=',$now->year)->where('for_month','=',$nowmonthname)->orderBy($sort, $order)->get();
   // $salary = DB::table('salary')->whereColumn('for_year','=',$now->year)->whereColumn('for_month','=',$nowmonthname)->orderBy('id', 'desc')->get();
    }else{
// $salary = DB::table('salary')->where('for_year','=',$now->year)->where('for_month','=',$nowmonthname)->sortable()->paginate(10);
    $salary = DB::table('salary')->where('for_year','=',$now->year)->where('for_month','=',$nowmonthname)->orderBy($sort, $order)->paginate(10);
    
   
    }
   
        return view('salary_management.index',compact('salary','employees_array','error_'));
    }

 public function Edit(Request $request)
    {
 
  $now = Carbon::now();
  $salID = $request->SalId;
  

            if($salID=="0"){
             
            $employeetoadd = $request->employeetoadd;
            $employee_=DB::table('users')->where('id', '=',$employeetoadd )->first();
           
            $sal_to_edit=null;
            
            }else{
             $sal_to_edit = DB::table('salary')->where('id', '=', $salID)->first(); 
             $employee_=DB::table('users')->where('id', '=',$sal_to_edit->emp_id )->first();
            }
 $leavefull = DB::table('leave_requests')->where('request_by', '=', $employee_->id )->where('type','=','no pay')->where('status','=','approved')->where('category','=','full day')->whereYear('date_','=',$now)->whereMonth('date_','=',$now)->count();
 $leavehalf = DB::table('leave_requests')->where('request_by', '=', $employee_->id  )->where('type','=','no pay')->where('status','=','approved')->where('category','=','half day')->whereYear('date_','=',$now)->whereMonth('date_','=',$now)->count();
 $leaveshort = DB::table('leave_requests')->where('request_by', '=', $employee_->id  )->where('type','=','no pay')->where('status','=','approved')->where('category','=','short leave')->whereYear('date_','=',$now)->whereMonth('date_','=',$now)->count();
 $Absence = DB::table('daily_attendances')->whereYear('date','=',$now->year)->whereMonth('date','=',$now->month)->where('emp_id', '=', $employee_->id )->where('status', '=', 'Absence' )->count(); 
        

 return view('salary_management.edit',compact('sal_to_edit','employee_','salID','leavefull','leavehalf','leaveshort','Absence'));
 
 
   
 }
 public function store(Request $request)
        {
       
 $now = Carbon::now();     
          
 $addedBy = auth()->id();
 $inputID = $request->id;
 $enptoadd = $request->empid;
 $now = Carbon::now();
 $thismonth=strval($now->format('F'));
 
  $employee_=DB::table('users')->where('id', '=',$enptoadd )->first();
 
 $grosssal = ($request->basic_salary)+($request->variable_allowance)+($request->incentice)+($request->holiday_allowance)+($request->commission)+($request->phone_allowance);
 $val1 =($request->basic_salary)-($request->no_pay);
 $EPFemp =$val1*0.08;
  
 $advance=DB::table('advance_requests')->where('request_by', '=', $enptoadd)->where('status', '=', 'approved')->whereYear('for_year', '=', $now->year )->whereMonth('for_month','=',$thismonth )->first();         
 if($advance!=null){
 $advancereq= $advance->amount;
 }else{
 $advancereq=0;
 }

 $totDiduc = $EPFemp+$advancereq+($request->telephone_deduction)+($request->no_pay)+($request->staff_loan)+($request->paye_tax);
 $netsal = $grosssal-$totDiduc;
 $EPFcomp=$val1+0.12;
 $ETFcomp = ($request->basic_salary)*0.03;
$error_=null;
 if($inputID== 0){   
 
 $salaryexist = DB::table('salary')->where('emp_id','=',$enptoadd)->where('for_year','=',$request->for_year)->where('for_month','=',$request->for_month)->first();
 if($salaryexist!=null){
 $error_='      you already added record for that employee for selected month-year';
 }else{
            DB::table('salary')->insert(
                    array(   
                    'emp_id'=>$enptoadd,
                    'name'=>$employee_->name,
                    'designation'=>$employee_->current_job_position,
                    'branch'=>$employee_->branch,
                    'department'=>$employee_->department,
                    'bank'=>$employee_->bank,
                    'bank_branch'=>$employee_->bank_branch,
                    'remitted_account_no'=>$employee_->bank_number,
                    'EPF_number'=>$employee_->EPF_number,
                    'for_year'=>$request->for_year,
                    'for_month'=>$request->for_month,
                    'date'=>$request->datee,
                    'basic_salary'=>$request->basic_salary,
                    'variable_allowance'=>$request->variable_allowance,
                    'incentice'=>$request->incentice,
                    'holiday_allowance'=>$request->holiday_allowance,
                    'commission'=>$request->commission,
                    'phone_allowance'=>$request->phone_allowance,
                    'gross_salary'=>$grosssal,
                    'epf_employe_cont'=>$EPFemp,
                    'salary_advance'=>$advancereq,
                    'telephone_deduction'=>$request->telephone_deduction,
                    'no_pay'=>$request->no_pay,
                    'staff_loan'=>$request->staff_loan,
                    'paye_tax'=>$request->paye_tax,
                    'total_deductions'=>$totDiduc,
                    'net_salary'=>$netsal,
                    'epf_company_cont'=>$EPFcomp,
                    'etf_company_cont'=>$ETFcomp,
                    'remitted_amount'=>$netsal,
                    'created_at'=>$now,
                    'updated_at'=>$now,
                    )
                );
 }
         }else{
         
          DB::table('salary')->update(
                    array(   
                    'date'=>$request->datee,
                    'basic_salary'=>$request->basic_salary,
                    'variable_allowance'=>$request->variable_allowance,
                    'incentice'=>$request->incentice,
                    'holiday_allowance'=>$request->holiday_allowance,
                    'commission'=>$request->commission,
                    'phone_allowance'=>$request->phone_allowance,
                    'gross_salary'=>$grosssal,
                    'epf_employe_cont'=>$EPFemp,
                    'salary_advance'=>$advancereq,
                    'telephone_deduction'=>$request->telephone_deduction,
                    'no_pay'=>$request->no_pay,
                    'staff_loan'=>$request->staff_loan,
                    'paye_tax'=>$request->paye_tax,
                    'total_deductions'=>$totDiduc,
                    'net_salary'=>$netsal,
                    'epf_company_cont'=>$EPFcomp,
                    'etf_company_cont'=>$ETFcomp,
                    'remitted_amount'=>$netsal,
                    'updated_at'=>$now,
                    )
                );
         
         }
 
    $nowmonthname=$now->format('F');
    $id = auth()->id();
            $employees_array=DB::table('users')->get();
    $salary =null;
   
   $count = DB::table('salary')->where('for_year','=',$now->year)->where('for_month','=',$nowmonthname)->count();
    if($count<10){
   $salary = DB::table('salary')->where('for_year','=',$now->year)->where('for_month','=',$nowmonthname)->orderBy('id', 'asc')->get();
   // $salary = DB::table('salary')->whereColumn('for_year','=',$now->year)->whereColumn('for_month','=',$nowmonthname)->orderBy('id', 'desc')->get();
    }else{
// $salary = DB::table('salary')->where('for_year','=',$now->year)->where('for_month','=',$nowmonthname)->sortable()->paginate(10);
    $salary = DB::table('salary')->where('for_year','=',$now->year)->where('for_month','=',$nowmonthname)->orderBy('id', 'asc')->paginate(10);
    
   
    }
   
        return view('salary_management.index',compact('salary','employees_array','error_'));
    

        }
public function export()
    {
$now = Carbon::now();
        // CREATE A NEW SPREADSHEET + SET METADATA
$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()
->setTitle('Salary');
 
// NEW WORKSHEET
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Salary this year');
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Employee ID');
$sheet->setCellValue('C1', 'Updated at');
$sheet->setCellValue('D1', 'Created at');
$sheet->setCellValue('E1', 'remitted_amount');
$sheet->setCellValue('F1', 'name');
$sheet->setCellValue('G1', 'designation');
$sheet->setCellValue('H1', 'Branch');
$sheet->setCellValue('I1', 'department');
$sheet->setCellValue('J1', 'bank');
$sheet->setCellValue('K1', 'bank_branch');
$sheet->setCellValue('L1', 'remitted_account_no');
$sheet->setCellValue('M1', 'EPF_number');
$sheet->setCellValue('N1', 'for_year');
$sheet->setCellValue('O1', 'for_month');
$sheet->setCellValue('P1', 'date');
$sheet->setCellValue('Q1', 'basic_salary');
$sheet->setCellValue('R1', 'variable_allowance');
$sheet->setCellValue('S1', 'incentice');
$sheet->setCellValue('T1', 'holiday_allowance');
$sheet->setCellValue('U1', 'commission');
$sheet->setCellValue('V1', 'phone_allowance');
$sheet->setCellValue('W1', 'epf_employe_cont');
$sheet->setCellValue('X1', 'salary_advance');
$sheet->setCellValue('Y1', 'telephone_deduction');
$sheet->setCellValue('Z1', 'no_pay');
$sheet->setCellValue('AA1', 'staff_loan');
$sheet->setCellValue('BB1', 'paye_tax');
$sheet->setCellValue('CC1', 'epf_company_cont');
$sheet->setCellValue('DD1', 'etf_company_cont');
$sheet->setCellValue('EE1', 'gross_salary');
$sheet->setCellValue('FF1', 'total_deductions');
$sheet->setCellValue('GG1', 'net_salary');


$dailyAttendance = DB::table('salary')->where('for_year','=',$now->year)->get();
$i=2;
foreach($dailyAttendance as $row){
    $sheet->setCellValue('A'.$i, $row->id);
    $sheet->setCellValue('B'.$i, $row->emp_id);

                   $sheet->setCellValue('C'.$i, $row->updated_at);

                    $sheet->setCellValue('D'.$i, $row->created_at);
$sheet->setCellValue('E'.$i, $row->remitted_amount);
    $sheet->setCellValue('F'.$i, $row->name);
                   $sheet->setCellValue('G'.$i, $row->designation);
                  $sheet->setCellValue('H'.$i, $row->branch);
                 $sheet->setCellValue('I'.$i, $row->department);
                    $sheet->setCellValue('J'.$i, $row->bank);
                   $sheet->setCellValue('K'.$i, $row->bank_branch);
                    $sheet->setCellValue('L'.$i, $row->remitted_account_no);
                  $sheet->setCellValue('M'.$i, $row->EPF_number);
                   $sheet->setCellValue('N'.$i, $row->for_year);
                    $sheet->setCellValue('O'.$i, $row->for_month);
                   $sheet->setCellValue('P'.$i, $row->date);
                  $sheet->setCellValue('Q'.$i, $row->basic_salary);
                  $sheet->setCellValue('R'.$i, $row->variable_allowance);
                    $sheet->setCellValue('S'.$i, $row->incentice);
                   $sheet->setCellValue('T'.$i, $row->holiday_allowance);
                  $sheet->setCellValue('U'.$i, $row->commission);
                   $sheet->setCellValue('V'.$i, $row->phone_allowance);
                   $sheet->setCellValue('W'.$i, $row->epf_employe_cont);
                   $sheet->setCellValue('X'.$i, $row->salary_advance);
                   $sheet->setCellValue('Y'.$i, $row->telephone_deduction);
                    $sheet->setCellValue('Z'.$i, $row->no_pay);
                   $sheet->setCellValue('AA'.$i, $row->staff_loan);
                $sheet->setCellValue('BB'.$i, $row->paye_tax);
                    $sheet->setCellValue('CC'.$i, $row->epf_company_cont);
                   $sheet->setCellValue('DD'.$i, $row->etf_company_cont);
                    $sheet->setCellValue('EE'.$i, $row->gross_salary);
                    $sheet->setCellValue('FF'.$i, $row->total_deductions);
                   $sheet->setCellValue('GG'.$i, $row->net_salary);
                   

    $i=$i+1;
}

// OUTPUT
$writer = new Xlsx($spreadsheet);
// OR FORCE DOWNLOAD
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="salary.xlsx"');
header('Cache-Control: max-age=0');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: cache, must-revalidate');
header('Pragma: public');
$writer->save('php://output');
    }
public function export_month(Request $request)
    {
$now = Carbon::now();
        // CREATE A NEW SPREADSHEET + SET METADATA
$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()
->setTitle('Salary');
 
// NEW WORKSHEET
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Salary this year');
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Employee ID');
$sheet->setCellValue('C1', 'Updated at');
$sheet->setCellValue('D1', 'Created at');
$sheet->setCellValue('E1', 'remitted_amount');
$sheet->setCellValue('F1', 'name');
$sheet->setCellValue('G1', 'designation');
$sheet->setCellValue('H1', 'Branch');
$sheet->setCellValue('I1', 'department');
$sheet->setCellValue('J1', 'bank');
$sheet->setCellValue('K1', 'bank_branch');
$sheet->setCellValue('L1', 'remitted_account_no');
$sheet->setCellValue('M1', 'EPF_number');
$sheet->setCellValue('N1', 'for_year');
$sheet->setCellValue('O1', 'for_month');
$sheet->setCellValue('P1', 'date');
$sheet->setCellValue('Q1', 'basic_salary');
$sheet->setCellValue('R1', 'variable_allowance');
$sheet->setCellValue('S1', 'incentice');
$sheet->setCellValue('T1', 'holiday_allowance');
$sheet->setCellValue('U1', 'commission');
$sheet->setCellValue('V1', 'phone_allowance');
$sheet->setCellValue('W1', 'epf_employe_cont');
$sheet->setCellValue('X1', 'salary_advance');
$sheet->setCellValue('Y1', 'telephone_deduction');
$sheet->setCellValue('Z1', 'no_pay');
$sheet->setCellValue('AA1', 'staff_loan');
$sheet->setCellValue('BB1', 'paye_tax');
$sheet->setCellValue('CC1', 'epf_company_cont');
$sheet->setCellValue('DD1', 'etf_company_cont');
$sheet->setCellValue('EE1', 'gross_salary');
$sheet->setCellValue('FF1', 'total_deductions');
$sheet->setCellValue('GG1', 'net_salary');



$dailyAttendance = DB::table('salary')->where('for_year','=',$request->for_year)->where('for_month','=',$request->for_month)->get();
$i=2;
foreach($dailyAttendance as $row){
    $sheet->setCellValue('A'.$i, $row->id);
    $sheet->setCellValue('B'.$i, $row->emp_id);

                   $sheet->setCellValue('C'.$i, $row->updated_at);

                    $sheet->setCellValue('D'.$i, $row->created_at);
$sheet->setCellValue('E'.$i, $row->remitted_amount);
    $sheet->setCellValue('F'.$i, $row->name);
                   $sheet->setCellValue('G'.$i, $row->designation);
                  $sheet->setCellValue('H'.$i, $row->branch);
                 $sheet->setCellValue('I'.$i, $row->department);
                    $sheet->setCellValue('J'.$i, $row->bank);
                   $sheet->setCellValue('K'.$i, $row->bank_branch);
                    $sheet->setCellValue('L'.$i, $row->remitted_account_no);
                  $sheet->setCellValue('M'.$i, $row->EPF_number);
                   $sheet->setCellValue('N'.$i, $row->for_year);
                    $sheet->setCellValue('O'.$i, $row->for_month);
                   $sheet->setCellValue('P'.$i, $row->date);
                  $sheet->setCellValue('Q'.$i, $row->basic_salary);
                  $sheet->setCellValue('R'.$i, $row->variable_allowance);
                    $sheet->setCellValue('S'.$i, $row->incentice);
                   $sheet->setCellValue('T'.$i, $row->holiday_allowance);
                  $sheet->setCellValue('U'.$i, $row->commission);
                   $sheet->setCellValue('V'.$i, $row->phone_allowance);
                   $sheet->setCellValue('W'.$i, $row->epf_employe_cont);
                   $sheet->setCellValue('X'.$i, $row->salary_advance);
                   $sheet->setCellValue('Y'.$i, $row->telephone_deduction);
                    $sheet->setCellValue('Z'.$i, $row->no_pay);
                   $sheet->setCellValue('AA'.$i, $row->staff_loan);
                $sheet->setCellValue('BB'.$i, $row->paye_tax);
                    $sheet->setCellValue('CC'.$i, $row->epf_company_cont);
                   $sheet->setCellValue('DD'.$i, $row->etf_company_cont);
                   $sheet->setCellValue('EE'.$i, $row->gross_salary);
                    $sheet->setCellValue('FF'.$i, $row->total_deductions);
                   $sheet->setCellValue('GG'.$i, $row->net_salary);
                   

    $i=$i+1;
}

// OUTPUT
$writer = new Xlsx($spreadsheet);
// OR FORCE DOWNLOAD
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="salary.xlsx"');
header('Cache-Control: max-age=0');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: cache, must-revalidate');
header('Pragma: public');
$writer->save('php://output');
    }
public function payslip(Request $request)
    {
$now = Carbon::now();
 $id = auth()->id();
$dailyAttendance = DB::table('salary')->where('for_year','=',$request->for_year)->where('for_month','=',$request->for_month)->where('emp_id','=','$id')->first();
        // CREATE A NEW SPREADSHEET + SET METADATA
$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()
->setTitle('Pay slip');
 

// NEW WORKSHEET
$sheet = $spreadsheet->getActiveSheet();
$sheet->getStyle('A1:A51')->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
$sheet->getStyle('F1:F51')->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
$sheet->getStyle('H1:H51')->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
$sheet->getStyle('M1:M51')->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
$sheet->getStyle('G1:G51')->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('B51:M51')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
$sheet->getStyle('E30')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE);
$sheet->getStyle('L30')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DOUBLE);
$sheet->getStyle('E29')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->getStyle('L29')->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$sheet->mergeCells('C1:E1');
$sheet->mergeCells('J1:L1');
$sheet->mergeCells('C5:E5');
$sheet->mergeCells('J5:L5');
$sheet->mergeCells('C50:E50');
$sheet->mergeCells('J50:L50');
$sheet->mergeCells('D45:F45');
$sheet->mergeCells('K45:M45');
$sheet->getStyle("A1:N53")->getFont()->setName('Book Antiqua');
$sheet->getStyle("C1")->getFont()->setSize(16)->setBold(true)->setItalic(true)->setUnderline(true);
$sheet->getStyle("J1")->getFont()->setSize(16)->setBold(true)->setItalic(true)->setUnderline(true);
$sheet->getStyle("C1")->getAlignment()->setHorizontal('left');
$sheet->getStyle("J1")->getAlignment()->setHorizontal('left');
$sheet->getStyle("C3")->getFont()->setSize(11);
$sheet->getStyle("J3")->getFont()->setSize(11);
$sheet->getStyle("C3")->getAlignment()->setHorizontal('left');
$sheet->getStyle("J3")->getAlignment()->setHorizontal('left');
$sheet->getStyle("C5")->getFont()->setSize(10.5)->setBold(true)->setItalic(true);
$sheet->getStyle("J5")->getFont()->setSize(10.5)->setBold(true)->setItalic(true);
$sheet->getStyle("C5")->getAlignment()->setHorizontal('center');
$sheet->getStyle("J5")->getAlignment()->setHorizontal('center');
$sheet->getStyle("C8:E12")->getFont()->setSize(10)->setBold(true);
$sheet->getStyle("C8:E12")->getAlignment()->setHorizontal('left');
$sheet->getStyle("J8:L12")->getFont()->setSize(10)->setBold(true);
$sheet->getStyle("J8:L12")->getAlignment()->setHorizontal('left');
$sheet->getStyle("C14:E19")->getFont()->setSize(11);
$sheet->getStyle("J14:L19")->getFont()->setSize(11);
$sheet->getStyle("C23:E29")->getFont()->setSize(11);
$sheet->getStyle("J23:L29")->getFont()->setSize(11);
$sheet->getStyle("C32:C33")->getFont()->setSize(11);
$sheet->getStyle("J32:J33")->getFont()->setSize(11);
$sheet->getStyle("C50")->getFont()->setSize(11);
$sheet->getStyle("J50")->getFont()->setSize(11);
$sheet->getStyle("C32:E33")->getFont()->setSize(11);
$sheet->getStyle("J32:L33")->getFont()->setSize(11);
$sheet->getStyle("C45:E46")->getFont()->setSize(11);
$sheet->getStyle("J45:L46")->getFont()->setSize(11);
$sheet->getStyle("C50")->getAlignment()->setHorizontal('center');
$sheet->getStyle("J50")->getAlignment()->setHorizontal('center');
$sheet->getStyle("C36:E39")->getFont()->setSize(10);
$sheet->getStyle("J36:L39")->getFont()->setSize(10);
$sheet->getStyle("C22")->getFont()->setSize(11.5)->setBold(true)->setUnderline(true);
$sheet->getStyle("J22")->getFont()->setSize(11.5)->setBold(true)->setUnderline(true);
$sheet->getStyle("C20")->getFont()->setSize(11.5)->setBold(true);
$sheet->getStyle("J20")->getFont()->setSize(11.5)->setBold(true);
$sheet->getStyle("C30")->getFont()->setSize(11.5)->setBold(true);
$sheet->getStyle("J30")->getFont()->setSize(11.5)->setBold(true);
$sheet->getColumnDimension('B')->setWidth(2);
$sheet->getColumnDimension('D')->setWidth(2);
$sheet->getColumnDimension('F')->setWidth(2);
$sheet->getColumnDimension('G')->setWidth(2);
$sheet->getColumnDimension('H')->setWidth(2);
$sheet->getColumnDimension('I')->setWidth(2);
$sheet->getColumnDimension('K')->setWidth(2);
$sheet->getColumnDimension('M')->setWidth(2);
$sheet->getColumnDimension('C')->setWidth(20);
$sheet->getColumnDimension('E')->setWidth(20);
$sheet->getColumnDimension('J')->setWidth(20);
$sheet->getColumnDimension('L')->setWidth(20);
$sheet->getColumnDimension('A')->setWidth(8.43);
$sheet->setCellValue('C3','Year '. $request->for_year);
$sheet->setCellValue('J3', 'Year '. $request->for_year);
$sheet->setCellValue('C1', 'ACCHE (Pvt) Ltd');
$sheet->setCellValue('J1', 'ACCHE (Pvt) Ltd');
$sheet->setCellValue('C5','Pay Advise for the month of   '.$request->for_month .' '.$request->for_year);
$sheet->setCellValue('J5','Pay Advise for the month of   '.$request->for_month .' '.$request->for_year);
$sheet->setCellValue('C8','Name');
$sheet->setCellValue('C9','EPF No');
$sheet->setCellValue('C10','Designation');
$sheet->setCellValue('C11','Department');
$sheet->setCellValue('C12','Branch');
$sheet->setCellValue('J8','Name');
$sheet->setCellValue('J9','EPF No');
$sheet->setCellValue('J10','Designation');
$sheet->setCellValue('J11','Department');
$sheet->setCellValue('J12','Branch');
$sheet->setCellValue('D8',':');
$sheet->setCellValue('D9',':');
$sheet->setCellValue('D10',':');
$sheet->setCellValue('D11',':');
$sheet->setCellValue('D12',':');
$sheet->setCellValue('K8',':');
$sheet->setCellValue('K9',':');
$sheet->setCellValue('K10',':');
$sheet->setCellValue('K11',':');
$sheet->setCellValue('K12',':');
$sheet->setCellValue('C14','Basic Salary');
$sheet->setCellValue('J14','Basic Salary');
$sheet->setCellValue('C15','Variable Allowance');
$sheet->setCellValue('J15','Variable Allowance');
$sheet->setCellValue('C16','Incentice');
$sheet->setCellValue('J16','Incentice');
$sheet->setCellValue('C17','Holiday Allowance');
$sheet->setCellValue('J17','Holiday Allowance');
$sheet->setCellValue('C18','Commission');
$sheet->setCellValue('J18','Commission');
$sheet->setCellValue('C19','Phone Allowance');
$sheet->setCellValue('J19','Phone Allowance');
$sheet->setCellValue('C20','Gross Salary');
$sheet->setCellValue('J20','Gross Salary');
$sheet->setCellValue('C22','Deductions');
$sheet->setCellValue('J22','Deductions');
$sheet->setCellValue('C23','EPF Employe Cont. (8%)');
$sheet->setCellValue('J23','EPF Employe (8%)');
$sheet->setCellValue('C24','Salary Advance');
$sheet->setCellValue('J24','Salary Advance');
$sheet->setCellValue('C25','Telephone Deduction');
$sheet->setCellValue('J25','Telephone Deduction');
$sheet->setCellValue('C26','No Pay');
$sheet->setCellValue('J26','No Pay');
$sheet->setCellValue('C27','Staff Loan');
$sheet->setCellValue('J27','Staff Loan');
$sheet->setCellValue('C28','Paye Tax');
$sheet->setCellValue('J28','Paye Tax');
$sheet->setCellValue('C29','Total Deductions');
$sheet->setCellValue('J29','Total Deductions');
$sheet->setCellValue('C30','Net Salary');
$sheet->setCellValue('J30','Net Salary');
$sheet->setCellValue('C32','EPF Company Cont. (12%)');
$sheet->setCellValue('J32','EPF  (12%)');
$sheet->setCellValue('C33','ETF Company Cont. (3%)');
$sheet->setCellValue('J33','ETF  (3%)');
$sheet->setCellValue('C36','Remitted Amount');
$sheet->setCellValue('J36','Remitted Amount');
$sheet->setCellValue('C37','Remitted Account No');
$sheet->setCellValue('J37','Remitted Account No');
$sheet->setCellValue('C38','Bank');
$sheet->setCellValue('J38','Bank');
$sheet->setCellValue('C39','Branch');
$sheet->setCellValue('J39','Branch');
$sheet->setCellValue('D36',':');
$sheet->setCellValue('D37',':');
$sheet->setCellValue('D38',':');
$sheet->setCellValue('D39',':');
$sheet->setCellValue('K36',':');
$sheet->setCellValue('K37',':');
$sheet->setCellValue('K38',':');
$sheet->setCellValue('K39',':');
$sheet->setCellValue('C45','Date :……………….');
$sheet->setCellValue('J45','Date :……………….');
$sheet->setCellValue('D45','Signature:……………….…');
$sheet->setCellValue('K45','Signature:……………….…');
$sheet->setCellValue('E46','Employee');
$sheet->setCellValue('L46','Accountant');
$sheet->setCellValue('C50','-Thank You -');
$sheet->setCellValue('J50','-Thank You -');











// OUTPUT
$writer = new Xlsx($spreadsheet);
// OR FORCE DOWNLOAD
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="payslip.xlsx"');
header('Cache-Control: max-age=0');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: cache, must-revalidate');
header('Pragma: public');
$writer->save('php://output');
    }
public function index3($year,$month)
  {
$now = Carbon::now();
    
    $id = auth()->id();
if($year="0000"){
$year_=$now->year;
$month_=$now->format('F');
}else{
$year_=$year;
$month_=$month;
}

$rec = DB::table('salary')->where('for_year','=',$year_)->where('for_month','=',$month_)->where('emp_id','=',$id)->first();

  return view('salary_management.payslip',compact('rec'));
  }
}
  
    /**
    

}
