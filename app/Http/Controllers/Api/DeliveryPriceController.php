<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliveryAreaPrice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DeliveryPriceController extends Controller
{

    public function getDeliveryPrice(Request $request){

        $address = $this->initialize($request->lat, $request->lng);
        $price = null;


        $result = DeliveryAreaPrice::where([
            ["country"      , "=", $address["country"]],
            ["governorate"  , "=", $address["governorate"]],
            ["locality"     , "=", $address["locality"]],
            ["sub_locality" , "=", $address["sub_locality"]],
            ["neighborhood" , "=", $address["neighborhood"]],])->first();
        if(!$result){
            if(!$result){
                $result = DeliveryAreaPrice::where([
                    ["country"      , "=", $address["country"]],
                    ["governorate"  , "=", $address["governorate"]],
                    ["locality"     , "=", $address["locality"]],
                    ["sub_locality" , "=", $address["sub_locality"]],
                    ["neighborhood" , "=", null],])->first();
                if(!$result){

                    $result = DeliveryAreaPrice::where([
                        ["country"      , "=", $address["country"]],
                        ["governorate"  , "=", $address["governorate"]],
                        ["locality"     , "=", $address["locality"]],
                        ["sub_locality" , "=", null],
                        ["neighborhood" , "=", null],])->first();

                    if(!$result){

                        $result = DeliveryAreaPrice::where([
                            ["country"      , "=", $address["country"]],
                            ["governorate"  , "=", $address["governorate"]],
                            ["locality"     , "=", null],
                            ["sub_locality" , "=", null],
                            ["neighborhood" , "=", null],])->first();
                        if(!$result){

                            $result = DeliveryAreaPrice::where([
                                ["country"      , "=", $address["country"]],
                                ["governorate"  , "=", null],
                                ["locality"     , "=", null],
                                ["sub_locality" , "=", null],
                                ["neighborhood" , "=", null],])->first();
                        }
                    }
                }
            }
        }

        if($result){
            if($result->supported == 1)
                $data = ["price" => $result->price, "support" => true];
            else
                $data = ["support" => false];
        } else {
            $data = ["support" => false];
        }

        return response()->json([
            "status" => 200,
            "data" => $data,
        ], 200);



    }




    public function initialize($lat , $lng){
        $address = [ "country" => null, "governorate" => null, "locality" => null, "sub_locality" => null, "neighborhood" => null];

        $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $lat . ',' . $lng . '&key=' . env("GOOGLE_API_KEY");
        $results = json_decode(Http::post($url), true)["results"];

        foreach($results as $result){
            foreach($result["types"] as $type){
                switch ($type) {
                    case 'country':
                        $address["country"] = $result["address_components"][0]["long_name"];
                    break;

                    case 'administrative_area_level_1':
                        $address["governorate"] = $result["address_components"][0]["long_name"];
                    break;

                    case 'locality':
                        $address["locality"] = $result["address_components"][0]["long_name"];
                    break;

                    case 'sublocality':
                        $address["sub_locality"] = $result["address_components"][0]["long_name"];
                    break;

                    case 'neighborhood':
                        $address["neighborhood"] = $result["address_components"][0]["long_name"];
                    break;
                }
            }
        }
        return $address;
    }


}
