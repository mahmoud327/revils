<?php


namespace App\Repositories\Auth\RestPassword;
use App\Models\User;
use App\Services\SendSmsService;
use DB;
use Illuminate\Support\Facades\Hash;

class RestPasswordRepository implements RestPasswordRepositoryInterface
{
    public function __construct(public User $model){}

    public function sendOtp($request)
    {
        $sms = new SendSmsService();
        $sms->setMobile($request->mobile);
        $sms->sendSmsOtp();
    }

    public function verifyOtp($request) : bool
    {
        $sms = new SendSmsService();
        $sms->setOtp($request->otp);
        return $sms->verifyRestPassOtp();
    }

    public function changePassword($request) : bool
    {
        $smsService = new SendSmsService();
        $smsService->setOtp(otp: $request->code);
        $verificationUserCode = $smsService->verifyRestPassOtp();
        if(!$verificationUserCode)
        {
            return false;
        }
        $otp = $smsService->findSingleOtp(otp: $request->code);
        $user = User::whereMobile($otp->mobile)->firstOrFail();
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        $smsService->deleteOldOtpCodes($otp->mobile);
        return true;
    }
}
