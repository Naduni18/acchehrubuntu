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
    use Carbon\Carbon;

    class AdvanceRequestsController extends Controller
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
            $thismonth=strval($now->format('F'));
            $lastMonth_s =  $now->subMonth()->format('F');
            $lastMonth =  strval($lastMonth_s);
            $advance_requests = DB::table('advance_requests')->where('request_by', '=', $id)->get();  
            $to_approve = DB::table('advance_requests')->get(); 
      
            $advance_requests_this_month_total=DB::table('advance_requests')->where('status', '=', 'approved')->whereYear('for_year', '=', $now->year )->whereMonth('for_month','=',$thismonth )->get(); 
            $advance_requests_last_month_total=DB::table('advance_requests')->where('status', '=', 'approved')->whereYear('for_year', '=', $now->year )->whereMonth('for_month','=',$lastMonth)->get(); 
            return view('advance_payment.index',  compact('advance_requests','to_approve','advance_requests_this_month_total','advance_requests_last_month_total'));
          
           
        }
        public static function get_user_name($user_id)
        {
            $user_=DB::table('users')->select('name')->where([['id', '=', $user_id],])->first();
            
            return $user_;
        }
    
        public static function reject(Request $request)
        {
            $advanceid=$request->requestId;
            DB::table('advance_requests')->where('id', '=',  $advanceid)->update(['status' =>'rejected']); 
    
            return redirect()->to('/advance_payment'); 
          
            
        }
        public static function approve(Request $request)
        {
            $advanceid=$request->requestId;
            DB::table('advance_requests')->where('id', '=',  $advanceid)->update(['status' => 'approved']);
    
            return redirect()->to('/advance_payment');    
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
          
            $manager_supervisor = DB::table('users')->where('id', '=', $id)->first();
           
            if($request->advance_id_=="add"){
          
            DB::table('advance_requests')->insert([
                [
                    
                    'amount' => $request->amount,
                    'notes' =>$request->notes,
                    'request_by'=>$id,
                    'approved_by'=>$manager_supervisor->supervisor_manager,
                    'status'=>"pending",
                    'for_year'=>$request->for_year,
                    'for_month'=>$request->for_month,
                    'created_at'=>now(),
                ],
            ]);
            }else{
                DB::table('advance_requests')->where('id', '=', $request->advance_id_)->update(
                    array(
                        
                    'amount' => $request->amount,
                    'notes' =>$request->notes,
                    'request_by'=>$id,
                    'approved_by'=>$manager_supervisor->supervisor_manager,
                    'status'=>"pending",
                    'for_year'=>$request->for_year,
                    'for_month'=>$request->for_month,
                    'created_at'=>now(),

                    )
                );
        
    
            }
           
            return redirect()->route('advance_payment')->withStatus(__('Leave request successfully updated.'));
        }
        public static function destroy(Request $request)
        {
            $advanceid=$request->requestId;
            DB::table('advance_requests')->where('id', '=',  $advanceid)->delete();
            return redirect()->to('/advance_payment'); 
        }
        
    
        public function index2(Request $request)
        {
            
            $advanceid=$request->requestId;
            
            if($advanceid=="add"){
                $advance_req =null;   
            }else{
                $advance_req = DB::table('advance_requests')->where('id', '=', $advanceid)->first();     
            }
           
            
            return view('advance_payment.edit',compact('advanceid','advance_req'));
           
        }
    
    }
    