<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','fname','mname','lname', 'email', 'password','NIC','avatar_id','current_job_position','birthday','anniversary','phone_home','phone_mobile',
        'address_permanent','address_temporary','branch','bank','bank_branch','bank_no','next_kin_name','next_kin_occupation',
        'next_kin_office_address','next_kin_phone_mobile','next_kin_phone_home','next_kin_address','user_role','supervisor_manager',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        
    ];

    public function getImageAttribute()
{
   return $this->avatar_id;
}
}
