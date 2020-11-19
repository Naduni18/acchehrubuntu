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
    
    class ExpenseClaimRequestController extends Controller
{
        /**
         * Show the application dashboard.
         *
         * @return \Illuminate\View\View
         */
        public function index($sort1, $order1,$sort2, $order2,$sort3, $order3,$sort4, $order4)
        {
            $now = Carbon::now();
            $lastMonth_s =  $now->subMonth()->month;
            $lastMonth =  strval($lastMonth_s);
            $id = auth()->id();
        
            $expense_claim_requests = DB::table('expense_claim')->where('request_by', '=', $id)->orderBy($sort1, $order1)->paginate(10); 
            $to_approve = DB::table('expense_claim')->where('status', '=', 'pending')->orderBy($sort2, $order2)->paginate(10);
            $expense_claim_this_month_total = DB::table('expense_claim')->where('status', '=', 'approved')->whereMonth('date','=',$now)->orderBy($sort3, $order3)->paginate(10);;
            $expense_claim_last_month_total = DB::table('expense_claim')->where('status', '=', 'approved')->whereMonth('date','=',$lastMonth)->orderBy($sort4, $order4)->paginate(10);

           
            return view('expense_claim.view',  compact('expense_claim_requests','to_approve' ,'expense_claim_last_month_total','expense_claim_this_month_total' ));
          
           
        }
        public static function get_user_name($user_id)
        {
            $user_=DB::table('users')->select('name')->where([['id', '=', $user_id],])->first();
            
            return $user_;
        }
    
        public static function reject(Request $request)
        {
            $claimid=$request->requestId;
            DB::table('expense_claim')->where('claim_id', '=',  $claimid)->update(['status' =>'rejected']); 
    
            return redirect()->to('/expenseClaim'); 
          
            
        }
        public static function approve(Request $request)
        {
            $claimid=$request->requestId;
            DB::table('expense_claim')->where('claim_id', '=',  $claimid)->update(['status' => 'approved']);
    
            return redirect()->to('/expenseClaim');    
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
            $doc = $request->file('bill');
            $manager_supervisor = DB::table('users')->where('id', '=', $id)->first();
            if($doc!=null){
                $uuid = Uuid::generate()->string;
                $bill_doc_name = $uuid.'.'.$doc->getClientOriginalExtension();
                $folder = '/uploads/expense_claim/';
                $filePath = $folder . $bill_doc_name;
                $this->uploadOne($doc, $folder, 'public', $bill_doc_name);
            }else{
                $bill_doc_name =null;
            } 
            if($request->claim_id_=="add"){

                DB::table('expense_claim')->insert([
                    [

                        'bill_id'=>$bill_doc_name,
                        'reason' => $request->reason,
                        'date'=>$request->date_,
                        'amount'=>$request->amount,
                        'request_by'=>$id,
                        'approved_by'=>$manager_supervisor->supervisor_manager,
                        'status'=>"pending",
                        'created_at'=>now(),

                    ],
                    ]);
            }else{

                DB::table('expense_claim')->where('claim_id', '=', $request->claim_id_)->update(
                    array(

                        'bill_id'=>$bill_doc_name,
                        'reason' => $request->reason,
                        'date'=>$request->date_,
                        'amount'=>$request->amount,
                        'request_by'=>$id,
                        'approved_by'=>$manager_supervisor->supervisor_manager,
                        'status'=>"pending",
                        'updated_at'=>now(),

                        )
                    );

            }
        return redirect()->route('expenseClaim')->withStatus(__('Leave request successfully updated.'));
           
        }
        public static function destroy(Request $request)
        {
            $claimid=$request->requestId;
            DB::table('expense_claim')->where('claim_id', '=',  $claimid)->delete();
            return redirect()->to('/expenseClaim'); 
        }
        
    
        public function index2(Request $request)
        {
            
            $claimid=$request->requestId;

            if($claimid=="add"){
                $claim_req =null;
            }else{
                $claim_req = DB::table('expense_claim')->where('claim_id', '=', $claimid)->first(); 
            } 
            return view('expense_claim.add_edit',compact('claimid','claim_req'));
        }
    
         public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
        {
            $name = !is_null($filename) ? $filename : Str::random(25);
    
            $path =storage_path('uploads/expense_claim/'.$filename.'');
    
            if( Storage::exists($path)){
              
             Storage::disk('public')->delete('uploads/expense_claim/'.$filename.'');  
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
            return response()->download(storage_path("app/public/uploads/expense_claim/{$file_name}"));
        }
    
    }
    