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
    
    class RecruitmentController extends Controller
    {
        /**
         * Show the application dashboard.
         *
         * @return \Illuminate\View\View
         */
        public function index($sort1, $order1)
        {
            $id = auth()->id();
            $recruitment_list = DB::table('recruitment')->orderBy($sort1, $order1)->paginate(10); 
        
        
      
            return view('recruitment.index',  compact('recruitment_list'));
          
           
        }
        public static function get_user_name($user_id)
        {
            $user_=DB::table('users')->select('name')->where([['id', '=', $user_id],])->first();
            
            return $user_;
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
            $doc = $request->file('cv_document');
            if($doc!=null){
                $uuid = Uuid::generate()->string;
                $cv_doc_name = $uuid.'.'.$doc->getClientOriginalExtension();
                $folder = '/uploads/new_candidate_cvs/';
                $filePath = $folder . $cv_doc_name;
                $this->uploadOne($doc, $folder, 'public', $cv_doc_name);
            }else{
                $cv_doc_name =null;
            } 
            if($request->candidate_id_=="add"){
          
            DB::table('recruitment')->insert([
                [
                    'cv_id'=>$cv_doc_name,
                    'name'=>$request->name,
                    'NIC'=>$request->NIC,
                    'email'=>$request->email,
                    'applied_job_position'=>$request->applied_job_position,
                    'first_interview_date'=>$request->first_interview_date,
                    'second_interview_date'=>$request->second_interview_date,
                    'interviewer'=>$request->interviewer,
                    'notes'=>$request->notes,
                    'current_status'=>$request->current_status, 
                    'created_at'=>now(),
                ],
            ]);
            }else{
                DB::table('recruitment')->where('id', '=', $request->candidate_id_)->update(
                    array(
                        'cv_id'=>$cv_doc_name,
                        'name'=>$request->name,
                        'NIC'=>$request->NIC,
                        'email'=>$request->email,
                        'applied_job_position'=>$request->applied_job_position,
                        'first_interview_date'=>$request->first_interview_date,
                        'second_interview_date'=>$request->second_interview_date,
                        'interviewer'=>$request->interviewer,
                        'notes'=>$request->notes,
                        'current_status'=>$request->current_status,
                        'updated_at'=>now(),
                    )
                );
        
    
            }
           
            return redirect()->route('recruitment')->withStatus(__('Candidate details successfully updated.'));
        }
        public static function destroy(Request $request)
        {
            $candidateid=$request->candidateId;
            DB::table('recruitment')->where('id', '=',  $candidateid)->delete();
            return redirect()->to('/recruitment'); 
        }
        
    
        public function index2(Request $request)
        {
            
            $candidateid=$request->candidateId;
            
            if($candidateid=="add"){
                $candidate_record =null;   
            }else{
                $candidate_record = DB::table('recruitment')->where('id', '=', $candidateid)->first();     
            }
           
            $managers_array = DB::table('users')->select('id','name')->where('user_role', '=', 'manager')->get();
            return view('recruitment.edit',compact('candidateid','candidate_record','managers_array'));
           
        }
    
         public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
        {
            $name = !is_null($filename) ? $filename : Str::random(25);
    
            $path =storage_path('uploads/new_candidate_cvs/'.$filename.'');
    
            if( Storage::exists($path)){
              
             Storage::disk('public')->delete('uploads/new_candidate_cvs/'.$filename.'');  
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
            return response()->download(storage_path("app/public/uploads/new_candidate_cvs/{$file_name}"));
        }
    
    }
    