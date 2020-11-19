<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EditUserController extends Controller
{
     /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Request   $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
         $image = $request->file('avatar');
    if($image!=null){
        $avatar_name = $request->get('NIC').'.'.$image->getClientOriginalExtension();
        $folder = '/uploads/avatars/';
       // $filePath = $folder . $avatar_name;
        $this->uploadOne($image, $folder, 'public', $avatar_name);
    }else{
        $avatar_name = null;  
    } 
    DB::table('users')->where('id', '=', $request->user_id_)->update(
        array(
            'avatar_id' => $avatar_name,
            'name'=>$request->name,
            'fname'=>$request->fname,
            'mname'=>$request->mname,
            'lname'=>$request->lname,
            'NIC'=>$request->NIC,
            'email'=>$request->email,
            'current_job_position'=>$request->current_job_position,
            'birthday'=>$request->birthday,
            'anniversary'=>$request->anniversary,
            'phone_home'=>$request->phone_home,
            'phone_mobile'=>$request->phone_mobile,
            'address_permanent'=>$request->address_permanent,
            'address_temporary'=>$request->address_temporary,
            'branch'=>$request->branch,
            'department'=>$request->department,
            'bank'=>$request->bank,
            'bank_branch'=>$request->bank_branch,
            'bank_number'=>$request->bank_number,
            'EPF_number'=>$request->EPF_number,
            'user_role'=>$request->user_role,
            'supervisor_manager'=>$request->supervisor_manager,
            'next_kin_name'=>$request->next_kin_name,
            'next_kin_occupation'=>$request->next_kin_occupation,
            'next_kin_address'=>$request->next_kin_address,
            'next_kin_office_address'=>$request->next_kin_office_address,
            'next_kin_phone_mobile'=>$request->next_kin_phone_mobile,
            'next_kin_phone_home'=>$request->next_kin_phone_home,
            'updated_at'=>now()

        )
    );
        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

     /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Request   $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        
        $image = $request->file('avatar');
        $pass = Hash::make($request->password);
    if($image!=null){

        $avatar_name = $request->get('NIC').'.'.$image->getClientOriginalExtension();
        $folder = '/uploads/avatars/';
       // $filePath = $folder . $avatar_name;
        $this->uploadOne($image, $folder, 'public', $avatar_name);

        DB::table('users')->insert([
            [
            'avatar_id' => $avatar_name,   
            'name'=>$request->name,
            'fname'=>$request->fname,
            'mname'=>$request->mname,
            'lname'=>$request->lname,
            'NIC'=>$request->NIC,
            'email'=>$request->email,
            'password'=>$pass,
            'current_job_position'=>$request->current_job_position,
            'birthday'=>$request->birthday,
            'anniversary'=>$request->anniversary,
            'phone_home'=>$request->phone_home,
            'phone_mobile'=>$request->phone_mobile,
            'address_permanent'=>$request->address_permanent,
            'address_temporary'=>$request->address_temporary,
            'branch'=>$request->branch,
            'department'=>$request->department,
            'bank'=>$request->bank,
            'bank_branch'=>$request->bank_branch,
            'bank_number'=>$request->bank_number,
            'EPF_number'=>$request->EPF_number,
            'user_role'=>$request->user_role,
            'supervisor_manager'=>$request->supervisor_manager,
            'next_kin_name'=>$request->next_kin_name,
            'next_kin_occupation'=>$request->next_kin_occupation,
            'next_kin_address'=>$request->next_kin_address,
            'next_kin_office_address'=>$request->next_kin_office_address,
            'next_kin_phone_mobile'=>$request->next_kin_phone_mobile,
            'next_kin_phone_home'=>$request->next_kin_phone_home,
            'created_at'=>now(),
            ],
        ]);  
 
    }else{
        DB::table('users')->insert([
            [
            'name'=>$request->name,
            'fname'=>$request->fname,
            'mname'=>$request->mname,
            'lname'=>$request->lname,
            'NIC'=>$request->NIC,
            'email'=>$request->email,
            'password'=>$pass,
            'current_job_position'=>$request->current_job_position,
            'birthday'=>$request->birthday,
            'anniversary'=>$request->anniversary,
            'phone_home'=>$request->phone_home,
            'phone_mobile'=>$request->phone_mobile,
            'address_permanent'=>$request->address_permanent,
            'address_temporary'=>$request->address_temporary,
            'branch'=>$request->branch,
            'department'=>$request->department,
            'bank'=>$request->bank,
            'bank_branch'=>$request->bank_branch,
            'bank_number'=>$request->bank_number,
            'EPF_number'=>$request->EPF_number,
            'user_role'=>$request->user_role,
            'supervisor_manager'=>$request->supervisor_manager,
            'next_kin_name'=>$request->next_kin_name,
            'next_kin_occupation'=>$request->next_kin_occupation,
            'next_kin_address'=>$request->next_kin_address,
            'next_kin_office_address'=>$request->next_kin_office_address,
            'next_kin_phone_mobile'=>$request->next_kin_phone_mobile,
            'next_kin_phone_home'=>$request->next_kin_phone_home,
            'created_at'=>now(),
            ],
        ]);  
        }
        $nic=$request->NIC;
$emp = DB::table('users')->where([['NIC', '=', $nic],])->first();
$emp_id =$emp->id;
        DB::table('skill_rating')->insert([
            [
                'emp_id'=>$emp_id,
                'rated_by'=>$request->supervisor_manager,
            ],
            ]); 
    return redirect()->route('user.index')->withStatus(__('User successfully created.'));
    }

    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);

        $path =storage_path('uploads/avatars/'.$filename.'');

        if( Storage::exists($path)){
          
         Storage::disk('public')->delete('uploads/avatars/'.$filename.'');  
        }
        $file = $uploadedFile->storeAs($folder, $name, $disk);
        return $file;
    }

}
