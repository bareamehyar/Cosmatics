<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class notification_controller extends Controller
{
    //
    public function getNotificationByUser($phoneNumber){

        $query=DB::select("select * from notifications where notifications.user_id = (select id from users where `MobileNumber` = '$phoneNumber')");
        return response($query);
    }
}
