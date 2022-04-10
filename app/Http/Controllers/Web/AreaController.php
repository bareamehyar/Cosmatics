<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Traits\Helper;


class AreaController extends Controller
{
//Rule::unique("cities_area")->where(function($q) use($area_name, $city_id){}
use Helper;

    public function rules(){
        return [
            "area_name" => ["required", "max:255",
            Rule::unique("cities_area")->where(function($q){
                return $q->where([["area_name", request()->area_name], ["city_id", request()->city_id]]);
            })],
            "city_id" => ["required", "exists:cities,id"]
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($city_id)
    {
        if(!hasPermissions(["create-area" ,"edit-area", "delete-area"]))
            return abort("401");

        $data["city"] = City::with("areas")->where("id", "=", $city_id)->first();

        return view("areas.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($city_id)
    {
        if(!hasPermissions("create-area"))
            return abort("401");

        $data["city"] = City::with("areas")->where("id", "=", $city_id)->first();
        return view("areas.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $city_id){
        if(!hasPermissions("create-area"))
            return abort("401");

        $request->merge(["city_id" => $city_id]);
        $request->validate($this->rules());

        $city = City::with("areas")->where("id", "=", $city_id)->first();

        $area = new Area();
        $area->area_name = $request->area_name;
        $city->areas()->save($area);
        $this->setPageMessage("The Area Has Been Added Successfully");
        return redirect()->route("area.index", $city->id);


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($city_id, $id)
    {
        if(!hasPermissions("edit-area"))
            return abort("401");

        $data["city"] = City::with("areas")->where("id", "=", $city_id)->firstOrFail();
        $data["area"] = $data["city"]->areas()->whereId($id)->first();
        return view("areas.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $city_id, $id)
    {
        if(!hasPermissions("edit-area"))
            return abort("401");

        $city = City::with("areas")->where("id", "=", $city_id)->firstOrFail();
        $area = $city->areas()->whereId($id)->first();
        $request->merge(["city_id" => $city_id]);
        $rules = $this->rules();
        if($city->id == $city_id && $request->area_name == $area->area_name){
            $rules["area_name"] = ["required", "max:255"];
        }
        $request->validate($rules);

        $city = City::with("areas")->where("id", "=", $city_id)->first();
        $area->area_name = $request->area_name;
        $city->areas()->save($area);
        $this->setPageMessage("The Area Has Been Updated Successfully");
        return redirect()->route("area.index", $city->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $city_id, $id)
    {
        if(!hasPermissions("delete-area"))
            return abort("401");

        City::with("areas")->where("id", "=", $city_id)->firstOrFail()->areas()->whereId($id)->delete();
        $this->setPageMessage("The Area Has Been Deleted Successfully",0);
        return redirect()->route("area.index", $city_id);
    }
}
