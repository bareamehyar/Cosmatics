<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class check_phone_number extends Controller
{
    //
    public function checkPhoneNumber($phone_number){

        $query = DB::select("select MobileNumber FROM users where MobileNumber = '$phone_number'");
        $row = count($query);

        if($row > 0){
            return response() -> json(["response" => true]);
        } else {
            return response() -> json(["response" => false]);

        }

    }

    public function getfisrtNamelastName($phoneNumber){

        $query=DB::select("select first_name,last_name FROM users where MobileNumber = '$phoneNumber'");

        return response($query);
    }

    public function updatePersonInfo($phoneNumber,$first_name,$last_name){

        $query=DB::select("UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name' WHERE MobileNumber = '$phoneNumber'");

        return response("updated successfully");
    }


    public function getAllAddresses($phoneNumber){

        $query=DB::select("SELECT * FROM `user_addresses` WHERE user_phone = '$phoneNumber'");

        return response($query);
    }

    public function addAddressManual($phoneNumber,$title,$area_name,$street_name,$building_number,$floor_number,$apartment_number,$lat,$long){

        $query=DB::select("INSERT INTO `user_addresses`(`user_phone`, `title`, `area_name`, `sub_local`, `building_number`, `floor_number`, `apartment_number`,`latitude`,`longitude`) VALUES('$phoneNumber','$title','$area_name','$street_name','$building_number','$floor_number','$apartment_number',$lat,$long)");

        return response("Added Successfully");
    }

    public function getAddressDetails($id){
        $query=DB::select("SELECT * FROM `user_addresses` WHERE id = $id");

        return response($query);
    }

    public function updateAddressDetails($title,$area_name,$street_name,$building_number,$floor_number,$apartment_number,$id){
        $query=DB::select("UPDATE `user_addresses` SET `title`= '$title',`area_name`= '$area_name',`sub_local`= '$street_name',`building_number`= '$building_number',`floor_number`= '$floor_number',`apartment_number`= '$apartment_number' WHERE id = $id");

        return response($query);
    }


}
