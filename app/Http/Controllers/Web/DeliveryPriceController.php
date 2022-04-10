<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DeliveryAreaPrice;
use Illuminate\Http\Request;
use App\Traits\Helper;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class DeliveryPriceController extends Controller
{

    use Helper;

    protected $routeRedirect = "delivery_price.index";

    public function __construct()
    {
        if(isset($_GET['redirect'])){
            if($_GET['redirect'] == "tree"){
                $this->routeRedirect = "delivery_price.tree";
            }
        }

    }

    public function index(){
        if(!hasPermissions(["create-delivery-price" ,"edit-delivery-price", "delete-delivery-price"]))
            return abort("401");

        $data['locations'] = DeliveryAreaPrice::all();
        return view("delivery_price.index", $data);
    }

    public function tree(){
        if(!hasPermissions(["create-delivery-price" ,"edit-delivery-price", "delete-delivery-price"]))
            return abort("401");

        $treeData = [];
        $parents = [];
        $locations= DeliveryAreaPrice::all();
        foreach($locations as $location){
            $full_location =  $location->country .
                        (empty($location->governorate)  ?null: "-"  . $location->governorate) .
                        (empty($location->locality)     ?null: "-"  . $location->locality) .
                        (empty($location->sub_locality) ?null: "-"  . $location->sub_locality) .
                        (empty($location->neighborhood) ?null: "-"  . $location->neighborhood);
            $parents[$full_location] = $location->id;
        }

        foreach($locations as $location){
            $level = null;
            $parent_location = null;
            if($location->country && !$location->governorate){
                $level = 1;
                $location->location_text = $location->country;
            }else if($location->country && $location->governorate && !$location->locality){
                $level = 2;
                $parent_location = $location->country;
                $location->location_text = $location->governorate;
            }else if($location->country && $location->governorate && $location->locality && !$location->sub_locality && !$location->neighborhood){
                $level = 3;
                $parent_location = $location->country . "-"  . $location->governorate;
                $location->location_text = $location->locality;
            }else if($location->country && $location->governorate && $location->locality && $location->sub_locality && !$location->neighborhood){
                $level = 4;
                $parent_location = $location->country . "-"  . $location->governorate . "-"  . $location->locality;
                $location->location_text = $location->sub_locality;

            }else if($location->country && $location->governorate && $location->locality && $location->sub_locality && $location->neighborhood){
                $level = 5;
                $parent_location = $location->country . "-"  . $location->governorate . "-"  . $location->locality .  "-"  . $location->sub_locality;
                $location->location_text = $location->neighborhood;
            }

            $treeData[$level][$parents[$parent_location] ?? 0][] = $location;
        }
        unset($parents);
       // return buildTreeView(5,18,$tree_view);

        return view("delivery_price.tree", ["treeData" => $treeData]);
    }



    public function create(){
        if(!hasPermissions("create-delivery-price"))
            return abort("401");

        return view("delivery_price.create");
    }

    public function initialize(Request $request){

        $country = $request->country;
        $governorate = $request->governorate;
        $locality = $request->locality;
        $subLocality = $request->subLocality ?? null;
        $neighborhood = $request->neighborhood ?? null;

        $sessionData = [
            "country" => null,
            "governorate" => null,
            "locality" => null,
            "subLocality" => null,
            "neighborhood" => null,
        ];
        $responseData = [];
        $statusNumber = 300; //300 already exits , 200 success , 400 not supported

        $countryResult = DeliveryAreaPrice::where([
            ["country"      , "=", $country],
            ["governorate"  , "=", null],
            ["locality"     , "=", null],
            ["sub_locality" , "=", null],
            ["neighborhood" , "=", null],])->first();

        if(!$countryResult){
            $responseData[] = $sessionData["country"] = $country;
        }else{

            $governorateResult = DeliveryAreaPrice::where([
                ["country" , "=", $country],
                ["governorate" , "=", $governorate],
                ["locality"     , "=", null],
                ["sub_locality" , "=", null],
                ["neighborhood" , "=", null]])->first();

            if(!$governorateResult && $countryResult->supported == 1){
                $responseData[] = $sessionData["country"] = $country;
                $responseData[] = $sessionData["governorate"] = $governorate;
            }else if($countryResult->supported == 0){
                $statusNumber = 400;
            }else{
                $filterd_governorate = str_replace(" governorate","",strtolower($governorate));
                $filterd_locality = strtolower($locality);
                $localityResult = DeliveryAreaPrice::where([
                    ["country" , "=", $country],
                    ["governorate" , "=", $governorate],
                    ["locality" , "=", $locality],
                    ["sub_locality" , "=", null],
                    ["neighborhood" , "=", null]])->first();

                if($filterd_governorate == $filterd_locality){
                    if(!$localityResult && $governorateResult->supported == 1){
                        $localityResult = DeliveryAreaPrice::create([
                            "country" => $country,
                            "governorate" => $governorate,
                            "locality" => $locality,
                            "price" => $governorateResult->price,
                        ]);
                    }
                }
                if(!$localityResult && $governorateResult->supported == 1){
                    $responseData[] = $sessionData["country"] = $country;
                    $responseData[] = $sessionData["governorate"] = $governorate;
                    $responseData[] = $sessionData["locality"] = $locality;
                }else if($governorateResult->supported == 0){
                    $statusNumber = 400;
                }else{
                    $subLocalityResult = DeliveryAreaPrice::where([
                        ["country" , "=", $country],
                        ["governorate" , "=", $governorate],
                        ["locality" , "=", $locality],
                        ["sub_locality" , "=", $subLocality],
                        ["neighborhood" , "=", null]])->first();

                    if(!$subLocalityResult && $subLocality !== null && $localityResult->supported == 1){
                        $responseData[] = $sessionData["country"] = $country;
                        $responseData[] = $sessionData["governorate"] = $governorate;
                        $responseData[] = $sessionData["locality"] = $locality;
                        $responseData[] = $sessionData["subLocality"] = $subLocality;
                    }else if($localityResult->supported == 0){
                        $statusNumber = 400;
                    }else{
                        $neighborhoodResult = DeliveryAreaPrice::where([
                            ["country" , "=", $country],
                            ["governorate" , "=", $governorate],
                            ["locality" , "=", $locality],
                            ["sub_locality" , "=", $subLocality],
                            ["neighborhood" , "=", $neighborhood],])->first();

                        if(!$neighborhoodResult && $neighborhood !== null && $subLocalityResult->supported == 1){
                            $responseData[] = $sessionData["country"] = $country;
                            $responseData[] = $sessionData["governorate"] = $governorate;
                            $responseData[] = $sessionData["locality"] = $locality;
                            if($subLocality !== null)
                                $responseData[] = $sessionData["subLocality"] = $subLocality;
                            $responseData[] = $sessionData["neighborhood"] =$neighborhood;
                        }else if($subLocality !== null && $subLocalityResult->supported == 0){
                            $statusNumber = 400;
                        }
                    }
                }
            }
        }

        if($responseData){
            $statusNumber = 200;
            Session::put("location_details", $sessionData);
        }


        return response()->json(["data" => $responseData, "status" => $statusNumber], 200);
    }


    public function cancel(Request $request){

        if(Session::has("location_details")){
            Session::remove("location_details");
        }
    }

    public function store(Request $request){
        if(!hasPermissions("create-delivery-price"))
            return abort("401");

        $sessionData = [
            "country" => null,
            "governorate" => null,
            "locality" => null,
            "subLocality" => null,
            "neighborhood" => null,
        ];
        if(Session::has("location_details")){
            if(isset($request->supported))
                $request->validate(["price" => "required|numeric|min:0"]);
            else
                $request->price = -1;

            $data = Session::get("location_details");
            $deliveryLocation = new DeliveryAreaPrice();

            $deliveryLocation -> country        = $data["country"];
            $deliveryLocation -> governorate    = $data["governorate"];
            $deliveryLocation -> locality       = $data["locality"];
            $deliveryLocation -> sub_locality   = $data["subLocality"];
            $deliveryLocation -> neighborhood   = $data["neighborhood"];
            $deliveryLocation -> price          = $request->price;
            $deliveryLocation -> supported      = isset($request->supported) ? 1 : 0;

            $this->setPageMessage("The Delivery Location Price Has Been Created Successfully", 1);
            $deliveryLocation->save();
            Session::remove("location_details");

            return redirect()->route('delivery_price.create');
        }

        return redirect()->back();
    }

    public function edit($id){
        if(!hasPermissions("edit-delivery-price"))
            return abort("401");

        $data['location'] = DeliveryAreaPrice::findOrFail($id);
        return view("delivery_price.edit", $data);
    }

    public function update(Request $request, $id){
        if(!hasPermissions("edit-delivery-price"))
            return abort("401");

        $location = DeliveryAreaPrice::findOrFail($id);
        $request->validate(["price" => "required|numeric|min:0"]);

        $supported = isset($request->supported) ? 1 : 0;
        if($supported != $location->supported){
            $sql = "UPDATE delivery_areas_price SET `supported` = " . $supported . " WHERE ";
            if($location->neighborhood){
                $sql .= "country = '" . $location->country . "' AND governorate = '" . $location->governorate .
                "' AND locality = '" . $location->locality . "' AND sub_locality = '" . $location->sub_locality .
                "' AND neighborhood = '" . $location->neighborhood . "'";
            }else{
                if($location->sub_locality){
                    $sql .= "country = '" . $location->country . "' AND governorate = '" . $location->governorate .
                    "' AND locality = '" . $location->locality . "' AND sub_locality = '" . $location->sub_locality . "'";
                }else{
                    if($location->locality){
                        $sql .= "country = '" . $location->country . "' AND governorate = '" . $location->governorate .
                        "' AND locality = '" . $location->locality . "'";
                    }else{
                        if($location->governorate){
                            $sql .= "country = '" . $location->country . "' AND governorate = '" . $location->governorate . "'";
                        }else{
                            $sql .= "country = '" . $location->country . "'";
                        }
                    }
                }
            }
            DB::update($sql);
        }

        $location->price = $request->price;
        $location->supported = $supported;
        $location->save();

        $this->setPageMessage("The Location Has Been Updated Successfully", 1);
        return redirect()->route($this->routeRedirect);
    }


    public function destroy($id){

        if(!hasPermissions("delete-delivery-price"))
            return abort("401");

        $location = DeliveryAreaPrice::findOrFail($id);
        $sql = "DELETE FROM delivery_areas_price WHERE ";
        if($location->neighborhood){
            $sql .= "country = '" . $location->country . "' AND governorate = '" . $location->governorate .
            "' AND locality = '" . $location->locality . "' AND sub_locality = '" . $location->sub_locality .
            "' AND neighborhood = '" . $location->neighborhood . "'";
        }else{
            if($location->sub_locality){
                $sql .= "country = '" . $location->country . "' AND governorate = '" . $location->governorate .
                "' AND locality = '" . $location->locality . "' AND sub_locality = '" . $location->sub_locality . "'";
            }else{
                if($location->locality){
                    $sql .= "country = '" . $location->country . "' AND governorate = '" . $location->governorate .
                    "' AND locality = '" . $location->locality . "'";
                }else{
                    if($location->governorate){
                        $sql .= "country = '" . $location->country . "' AND governorate = '" . $location->governorate . "'";
                    }else{
                        $sql .= "country = '" . $location->country . "'";
                    }
                }
            }
        }
        DB::delete($sql);
        $this->setPageMessage("The Location Has Been Deleted Successfully", 0);
        return redirect()->back();
    }
}
