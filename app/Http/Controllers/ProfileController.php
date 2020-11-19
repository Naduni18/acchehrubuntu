<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user_skill_rating=null;
        $id = auth()->id();
        $user_skill_rating=DB::table('skill_rating')->where([['emp_id', '=', $id],])->first();
        return view('profile.edit',  compact('user_skill_rating'));
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
      
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);
   
        return back()->withPasswordStatus(__("Password successfully updated."));
    }

    public static function get_user_name($user_id)
    {
        $user_=DB::table('users')->select('name')->where([['id', '=', $user_id],])->first();
        
        return $user_;
    }
}
