<?php

namespace App\Http\Services;

use App\Models\VerficationCode;

class VerificationServices 
{
    public function setVerificationCode($data)
    {
        $code = mt_rand(100000, 999999);
        $data['code'] = $code;
        VerficationCode::whereNotNull('user_id')->where(['user_id' => $data['user_id']])->delete();
        return VerficationCode::create($data);
    }
}
