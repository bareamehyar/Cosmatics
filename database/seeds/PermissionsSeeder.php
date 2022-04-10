<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createPermission([
            "View Dashboard",

            "Create Branch" ,"Edit Branch", "Delete Branch", "Control Sliders Branches",

            "Create Category" ,"Edit Category", "Delete Category",

            "Create Item" ,"Edit Item", "Delete Item",

            "Create Add On's" ,"Edit Add On's", "Delete Add On's",

            "Create Slider" ,"Edit Slider", "Delete Slider",

            "View And Control Users Application", "View Orders",

            "Create Payment Method" ,"Edit Payment Method", "Delete Payment Method",

            "Control And Edit Application Settings",

            "Create City" ,"Edit City", "Delete City",

            "Create Area" ,"Edit Area", "Delete Area",

            "Create Delivery Price" ,"Edit Delivery Price", "Delete Delivery Price",

            "View Items Ordered Report" , "View Users Ordered Report" , "View Branches Sales Report",

            "Create Offers" ,"Edit Offers", "Delete Offers",

            "Create Services" ,"Edit Services", "Delete Services",

        ]);

    }

    public function createPermission($name ){

        if(!is_array($name)){
            $data["name"] = $name;
            $data["slug"] = \Illuminate\Support\Str::lower(str_replace(" ","-",$name));
        }else{
            $counter = 0;
            foreach ($name as $val){
                $data[$counter]["name"] = $val;
                $data[$counter]["slug"] = \Illuminate\Support\Str::lower(str_replace(" ","-",$val));
                $counter++;
            }
        }

        DB::table('admin_permissions')->insert($data);
    }
}
/*
 *         $this->createPermission([
            "View Dashboard",

            "Create Branch" ,"Edit Branch", "Delete Branch", "Control Sliders Branches",

            "Create Category" ,"Edit Category", "Delete Category",

            "Create Item" ,"Edit Item", "Delete Item",

            "Create Add On's" ,"Edit Add On's", "Delete Add On's",

            "Create Slider" ,"Edit Slider", "Delete Slider",

            "View And Control Users Application", "View Orders",

            "Create Payment Method" ,"Edit Payment Method", "Delete Payment Method",

            "Control And Edit Application Settings",
        ]);
 *
 *
 *
 *
 * */
