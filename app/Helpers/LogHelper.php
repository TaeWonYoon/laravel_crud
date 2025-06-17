<?php

namespace App\Helpers;

use App\Models\LoginLog;
use Illuminate\Support\Facades\Auth;

class LogHelper
{
    public static function storeLoginLog($request)
    {
        LoginLog::create([
            'user_id'    => Auth::id(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'logged_at'  => now(),
        ]);
    }
}

?>