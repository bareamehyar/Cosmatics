<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class vendor_controller extends Controller
{
    //
    public function gelAllItems(){

        $query=DB::select("SELECT * FROM `items_list`");

        return response($query);
    }

    public function gelDisableItems(){

        $query=DB::select("SELECT * FROM `items_list` where item_status = 2");

        return response($query);
    }

    public function gelEnableItems(){

        $query=DB::select("SELECT * FROM `items_list` where item_status = 1");

        return response($query);
    }

    public function updateStatusToInActive($itemId){

        $query=DB::select("UPDATE `items_list` SET `item_status`= 2 WHERE `id` = $itemId");

        return response($query);
    }


    public function updateStatusToActive($itemId){

        $query=DB::select("UPDATE `items_list` SET `item_status`= 1 WHERE `id` = $itemId");

        return response($query);
    }

    public function getEstimation(){

        $query=DB::select("SELECT `delivery_estimation` FROM `app_settings`");

        return response($query);
    }

    public function updateEstimationTime($newTime){

        $query=DB::select("UPDATE `app_settings` SET `delivery_estimation`= $newTime");

        return response($query);
    }
    
    public function getPendingOrder(){

        $query=DB::select("SELECT orders.*, users.first_name, users.last_name FROM `orders`, `users` WHERE orders.phone_number = users.MobileNumber and orders.Status = 1");

        return response($query);
    }
    
    public function getAcceptedOrder(){

        $query=DB::select("SELECT orders.*, users.first_name, users.last_name FROM `orders`, `users` WHERE orders.phone_number = users.MobileNumber and orders.Status = 2");

        return response($query);
    }
    
    public function getPreparedOrder(){

        $query=DB::select("SELECT orders.*, users.first_name, users.last_name FROM `orders`, `users` WHERE orders.phone_number = users.MobileNumber and orders.Status = 3");

        return response($query);
    }
    
    public function getReadyOrder(){


        $query=DB::select("SELECT orders.*,branch_table.store_name as branchSelected, users.first_name, users.last_name FROM `orders`, `users`,branch_table WHERE orders.phone_number = users.MobileNumber and orders.branchSelected=branch_table.id  and orders.Status = 4");

        return response($query);
    }
    
    public function getDeliveredOrder(){

        $query=DB::select("SELECT orders.*, users.first_name, users.last_name FROM `orders`, `users` WHERE orders.phone_number = users.MobileNumber and orders.Status = 5");

        return response($query);
    }
    
    public function getCanceledOrder(){

        $query=DB::select("SELECT orders.*, users.first_name, users.last_name FROM `orders`, `users` WHERE orders.phone_number = users.MobileNumber and orders.Status = 6");

        return response($query);
    }
    
    
    public function Is_Auto_Print($vendorID){
        
                $isAuto=DB::select("select *  from vendor_branches where vendor_id = $vendorID and auto_print=1");
                
               if($isAuto != []){
                   
                    return response()->json(["status"=>1],200);
               }else{
                   return response()->json(["status"=>0],200);
               }
                   
               
              

    }
    
    
    public function Edit_auto_print($vendorID,$status){
        
            try {
                 DB::select("update vendor_branches set auto_print=$status where vendor_id = $vendorID");
                 return response()->json(["status"=>"success"],200);
            } catch(Exception $e) {
                 return response()->json(["error"=>"update unsuccess"],404);
            }
            


        
 
    }
    
}
