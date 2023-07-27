<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserOtp;

class SendSmsService
{

    public function sendSmsOtp($mobile)
    {
        $otp = rand(1000, 9999);
        // send by SMS gateway
        $user_otp = new UserOtp();
        $user_otp->mobile  = $mobile;
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

    public function verifyOtp($otp)
    {
        $otp = UserOtp::whereOtp($otp)->first();
        if(!$otp)
        {
            return false;
        }

        $this->activateMobile($otp->mobile);
        $this->deleteOldOtpCode($otp->id);
        return true;
    }

    public function deleteOldOtpCode($id)
    {
        UserOtp::whereId($id)->delete();
    }

    public function activateMobile($mobile)
    {
        $user = User::whereMobile($mobile)->firstOrFail();
        $user->mobile_verified_at = now();
        $user->save();
    }




}
