<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserOtp;

class SendSmsService
{

    public function __construct(public $mobile = null, public $otp = null){}
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    public function setOtp(int $otp)
    {
        $this->otp = $otp;
    }

    public function sendSmsOtp()
    {
        $otp = rand(1000, 9999);
        // send by SMS gateway
        $user_otp = new UserOtp();
        $user_otp->mobile  = $this->mobile;
        $user_otp->otp  = $otp;
        $user_otp->save();
    }

    public function message($otp)
    {
        if(app()->getLocale() == 'en')
        {
            return $otp." "."is your verification code for ".env('APP_NAME');
        }
        return env('APP_NAME')." هذا كود التفعيل الخاص بـ ".$otp;
    }

    public function verifyOtp() : bool
    {
        $otp = UserOtp::whereOtp($this->otp)->first();
        if(!$otp)
        {
            return false;
        }
        $this->activateMobile($otp->mobile);
        $this->deleteOldOtpCodes($otp->mobile);

        return true;
    }

    public function verifyRestPassOtp() : bool
    {
        $otp = UserOtp::whereOtp($this->otp)->first();
        if(!$otp)
        {
            return false;
        }
        return true;
    }

    public function deleteOldOtpCodes($mobile)
    {
        $oldOtps = $this->findMultipleOtps($mobile);
        if(!$oldOtps)
        {
            return false;
        }
        UserOtp::destroy($oldOtps);
    }

    public function activateMobile($mobile)
    {
        $user = User::whereMobile($mobile)->firstOrFail();
        $user->mobile_verified_at = now();
        $user->save();
    }

    public function findMultipleOtps($mobile)
    {
       $otps = UserOtp::whereMobile($mobile)->pluck('id');
       if($otps->isEmpty())
       {
           return false;
       }
       return $otps;
    }

    public function findSingleOtp($otp)
    {
        $otp = UserOtp::whereOtp($otp)->firstOrFail();
        return $otp;
    }


}
