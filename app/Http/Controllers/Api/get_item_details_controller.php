<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ItemsList;
use App\Models\ItemSerialNumber;
use App\Models\ItemGallery;
use App\Models\ItemSizes;
use App\Models\ItemsColors;



class get_item_details_controller extends Controller
{
    //


    // protected function checkSerial($serialno){

    //     return ItemSerialNumber::where('serial_no',$serialno)->exists();
    // }

      protected function checkItemExists($item_id){

        return ItemsList::where('id',$item_id)->exists();
    }


    protected function checkItemImages($item_id){

        return ItemGallery::where('item_id',$item_id)->exists();
    }

    public function checkItemSizes($item_id){

        return ItemSizes::where('item_id',$item_id)->exists();

    }

    public function checkItemColor($item_id){

        return ItemsColors::where('item_id',$item_id)->exists();

    }


    public function getItemBySerial(){


        $query=DB::select("SELECT items_list.*,item_serial_numbers.serial_no FROM `items_list`,item_serial_numbers where item_serial_numbers.item_id =items_list.id");

        return response($query);


    }


    //item images



    public function getItemImages($item_id){

        if($this->checkItemExists($item_id)){

            if($this->checkItemImages($item_id)){

                           return ItemGallery::where('item_id',$item_id)->get(["image_url"]);

            }else{
                           return response()->json([" this item  not have  gallery images  "],404);
            }


        }else{
           return response()->json([" this item id not found "],404);
        }


        $query=DB::select("SELECT items_list.*,item_serial_numbers.serial_no FROM `items_list`,item_serial_numbers where item_serial_numbers.item_id =items_list.id");

        return response($query);


    }



    // Item Sizes

        public function getItemSizes($item_id){

        if($this->checkItemExists($item_id)){

            if($this->checkItemSizes($item_id)){

                           return ItemSizes::where('item_id',$item_id)->get(["id","Size"]);

            }else{
                           return response()->json([" this item  not have  Sizes   "],404);
            }


        }else{
           return response()->json([" this item id not found "],404);
        }


        $query=DB::select("SELECT items_list.*,item_serial_numbers.serial_no FROM `items_list`,item_serial_numbers where item_serial_numbers.item_id =items_list.id");

        return response($query);


    }


        //item Colors

    public function getItemColor($item_id){

        if($this->checkItemExists($item_id)){

            if($this->checkItemColor($item_id)){

                return ItemsColors::where('item_id',$item_id)->get(["id", DB::raw("REPLACE(color,'\r\n','') as color" ) , "url_image"]);

            }else{
                return response()->json([" this item  not have  color   "],404);
            }


        }else{
            return response()->json([" this item id not found "],404);
        }


        $query=DB::select("SELECT items_list.*,item_serial_numbers.serial_no FROM `items_list`,item_serial_numbers where item_serial_numbers.item_id =items_list.id");

        return response($query);


    }



    //item Details


    public function getItemDetails($item_id){

        $query=DB::select("SELECT * FROM `items_list` WHERE id = $item_id");

        return response($query);
    }

    public function getItemAddOnsCategory($item_id){

        $query=DB::select("select
                                JSON_ARRAYAGG(JSON_OBJECT('Option',

                                (select JSON_ARRAYAGG(JSON_OBJECT('id',add_ons_list.id,'en',add_ons_list.add_ons_list_en,'ar',add_ons_list.add_ons_list_ar,'price',add_ons_list.price))

                                from

                                add_ons_list where  add_ons_title.id=add_ons_list.add_ons_cat_id and  add_ons_title.`item_id` = $item_id )

                                ,'id',add_ons_title.id,'en',add_ons_title.add_ons_name_en,'ar',add_ons_title.add_ons_name_ar,'which_choice',add_ons_title.which_choice))

                                from
                                add_ons_title   where add_ons_title.item_id=$item_id

                                 ");
         return array_values(get_object_vars($query[0]));

    }

    public function getListOfAddOns($addOnsCatId){

        $query=DB::select("SELECT * FROM add_ons_list WHERE add_ons_cat_id = $addOnsCatId and status = 1");

        return response($query);
    }
}
