<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class event_controller extends Controller
{
    //
    public function addEvent($phoneNumber, $eventType) {

        $query=DB::select("INSERT INTO `app_event`(`phone_number`, `event_type`) VALUES('$phoneNumber','$eventType')");
        return response("Added Successfully");
    }
}
