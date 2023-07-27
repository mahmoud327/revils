<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserOtp;

class SendSmsService
{

    public function sendSmsOtp($mobile)
    {
        $otp = rand(100000, 999999);
        // send by SMS gateway
        UserOtp::create([
            'mobile' => $mobile,
            'otp' => $otp
        ]);
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

        $this->activateUser($otp->mobile);
        $this->deleteOldOtpCode($otp->id);
        return true;
    }

    public function deleteOldOtpCode($id)
    {
        UserOtp::whereId($id)->delete();
    }

    public function activateUser($mobile)
    {
        $user = User::whereMobile($mobile)->firstOrFail();
        $user->activation = 1;
        $user->save();
    }




}
