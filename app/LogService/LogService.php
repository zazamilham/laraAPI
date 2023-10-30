<?php

namespace App\LogService;

use Illuminate\Support\Facades\Log;

trait LogService
{

    public function setLog($user_id, $message):void
    {
        Log::info('Showing the user profile for user: {$user_id}');
    }

}
