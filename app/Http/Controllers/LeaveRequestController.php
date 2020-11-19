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

class LeaveRequestController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index($sort1, $order1,$sort2, $order2)
    {
        $id = auth()->id();
        $leave_requests = DB::table('leave_requests')->where('request_by', '=', $id)->orderBy($sort1, $order1)->paginate(10);
        $to_approve = DB::table('leave_requests')->where('approved_by', '=', $id)->orderBy($sort1, $order1)->paginate(10);
  
        return view('leave.view',  compact('leave_requests','to_approve'));
      
       
    }
    public static function get_user_name($user_id)
    {
        $user_=DB::table('users')->select('name')->where([['id', '=', $user_id],])->first();
        
        return $user_;
    }

    public static function reject(Request $request)
    {
        $leaveid=$request->requestId;
        DB::table('leave_requests')->where('id', '=',  $leaveid)->update(['status' =>'rejected']); 

        return redirect()->to('/leave'); 
      
        
    }
    public static function approve(Request $request)
    {
        $leaveid=$request->requestId;
        DB::table('leave_requests')->where('id', '=',  $leaveid)->update(['status' => 'approved']);

        $leave_record=DB::table('leave_requests')->where('id', '=',  $leaveid)->first();

        $leave_date=$leave_record->date_;
        $leave_empid=$leave_record->request_by;
        $leave_category=$leave_record->category;//'full day','half day','short leave'

        $dailyAttendance_record = DB::table('daily_attendances')->where('emp_id', '=',  $leave_empid)->whereDate('date', '=',  $leave_date)->first();

        if($dailyAttendance_record==null){

            DB::table('daily_attendances')->insertOrIgnore([
                [
                    'emp_id' =>$leave_empid,
                    'date' =>$leave_date,
                    'status'=>$leave_category,
                    'created_at'=>now(),
                ],
            ]);

        }else{

            $record_id=$dailyAttendance_record->id;
            DB::table('daily_attendances')->where('id', '=', $record_id)->update([
                [
                    'date' =>$leave_date,
                    'status'=>$leave_category,
                    'updated_at'=>now(),
                ],
            ]);
        }

        return redirect()->to('/leave');    
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
        $doc = $request->file('leave_document');
        $manager_supervisor = DB::table('users')->where('id', '=', $id)->first();
        if($doc!=null){
            $uuid = Uuid::generate()->string;
            $leave_doc_name = $uuid.'.'.$doc->getClientOriginalExtension();
            $folder = '/uploads/leave_documents/';
            $filePath = $folder . $leave_doc_name;
            $this->uploadOne($doc, $folder, 'public', $leave_doc_name);
        }else{
            $leave_doc_name =null;
        } 
        if($request->leave_id_=="add"){
      
        DB::table('leave_requests')->insert([
            [
                'document_id'=>$leave_doc_name,
                'reason' => $request->reason,
                'date_'=>$request->date_,
                'start' =>$request->start,
                'end'=>$request->end,
                'request_by'=>$id,
                'approved_by'=>$manager_supervisor->supervisor_manager,
                'status'=>"pending",
                'category'=>$request->category,
                'type'=>$request->type,
                'created_at'=>now(),
            ],
        ]);
        }else{
            DB::table('leave_requests')->where('id', '=', $request->leave_id_)->update(
                array(
                    'document_id'=>$leave_doc_name,
                    'reason' => $request->reason,
                    'date_'=>$request->date_,
                    'start' =>$request->start,
                    'end'=>$request->end,
                    'request_by'=>$id,
                    'approved_by'=>$manager_supervisor->supervisor_manager,
                    'category'=>$request->category,
                    'type'=>$request->type,
                    'updated_at'=>now(),
                )
            );
    

        }
       
        return redirect()->route('leave')->withStatus(__('Leave request successfully updated.'));
    }
    public static function destroy(Request $request)
    {
        $leaveid=$request->requestId;
        DB::table('leave_requests')->where('id', '=',  $leaveid)->delete();
        return redirect()->to('/leave'); 
    }
    

    public function index2(Request $request)
    {
        
        $leaveid=$request->requestId;
        
        if($leaveid=="add"){
            $leave_req =null;   
        }else{
            $leave_req = DB::table('leave_requests')->where('id', '=', $leaveid)->first();     
        }
       
        
        return view('leave.add_edit',compact('leaveid','leave_req'));
       
    }

     public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);

        $path =storage_path('uploads/leave_documents/'.$filename.'');

        if( Storage::exists($path)){
          
         Storage::disk('public')->delete('uploads/leave_documents/'.$filename.'');  
        }
        $file = $uploadedFile->storeAs($folder, $name, $disk);
      
        return $file;
    } 

      /**
     * Store new events.
     *
     * @return \Illuminate\View\View
     * 
     */
    public function download_file($file_name)
    {
        return response()->download(storage_path("app/public/uploads/leave_documents/{$file_name}"));
    }

}
