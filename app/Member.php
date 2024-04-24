<?php

namespace App;

use App\Notifications\MemberResetPassword;
use DateTime;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Member extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','school_id','status'
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
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MemberResetPassword($token));
    }



    public function getStudentId()
    {
        if(Auth::guard('member')->check())
        {
            $member_id = Auth::guard('member')->user()->id;

        }
        else
        {
            $member_id = null;
        }

        return $member_id;
    }

    public function getMemberId()
    {
        if(Auth::guard('member')->check())
        {
            $member_id = Auth::guard('member')->user()->id;
        }

        return $member_id;
    }

}
