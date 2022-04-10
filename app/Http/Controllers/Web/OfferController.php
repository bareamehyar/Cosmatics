<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BranchTable;
use App\Models\CategoryList;
use App\Models\ItemsList;
use App\Models\Offers;
use App\Traits\ApiResponse;
use App\Traits\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{
    use Helper, ApiResponse;

    public function rules(){
        return [
            "offer_type"        => ["required", "in:1,2"],
            "offer_value"       => ["required", "numeric"],
            "offer_value_type"  => ["required", "in:1,2"],
        ];
    }

    public function columns(){
        return [
            "offer_type"        => "offer on",
            "offer_value_type"  => "offer type",
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["offers"] = Offers::all();
        return view("offers.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data["items"] = ItemsList::all();
        $data["categories"] = CategoryList::all();
        $offers = Offers::all();
        $allOffers = [];
        // if($offers){
        //     foreach ($offers as $offer)
        //     $allOffers[$offer->translate_type][$offer->translate_type == "category" ? $offer->category->id : $offer->item->id] = true;
        // }
        $data["allCurrentOffers"] = $allOffers;
        unset($allOffers, $offers);
        return view("offers.create",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->rules();
        if($request->offer_type == 1)
            $rules["offer_value"] = ["required", "numeric", "between:0,99.99"];

        if($request->offer_value_type == 1)
            $rules["item"] = ["required"];
        else
            $rules["category"] = ["required"];

        $valid = Validator::make($request->all(), $rules,[],$this->columns());
        if ($valid->fails()) {
            return redirect()->route("offers.create")->withInput($request->all())->withErrors($valid->errors());
        }else{
            $offer = new Offers();
            $offer->offer_type = $request->offer_value_type == 1 ? "p" : "m";
            $offer->translate_type = $request->offer_type == 2 ? "item" : "category";
            $offer->value = $request->offer_value;
            $offer->type_id  = $request->offer_type == 2 ? $request->item : $request->category;
            $offer->save();
            $this->setPageMessage("The Offer Has Been Created Successfully");
            return redirect()->route("offers.index");
        }
    }


    public function branches($id)
    {
        $data['offer'] = $offer = Offers::findOrFail($id);
        $data["branches"] = BranchTable::all();
        $branches = [];
        if($offer->branches){
            foreach ($offer->branches as $branch){$branches[$branch->id] = true; }
        }
        $data["branchesOfferIds"] = $branches;
        unset($branches, $offer);
        return view("offers.branches",$data);
    }

    public function branchesAttach(Request $request, $offer_id){
        try {

            $offer = Offers::findOrFail($offer_id);
            $branch = BranchTable::findOrFail($request->branchId);
            if(empty(DB::table("offers_branches")->select("*")->where([["branch_id" , $branch->id],["offer_id", $offer->id]])->first()))
                $offer->branches()->attach($request->branchId);
            $data["branch"]["id"] = $branch->id;
            $data["branch"]["name"] = $branch->store_name;
            return $this->sendData($data);

        }catch (\Exception $e){
            return $this->sendError("error");
        }
    }

    public function branchesDetach(Request $request, $offer_id){
        try {

            $offer = Offers::findOrFail($offer_id);
            $branch = BranchTable::findOrFail($request->branchId);
            if(!empty(DB::table("offers_branches")->select("*")->where([["branch_id" , $branch->id],["offer_id", $offer->id]])->first()))
                $offer->branches()->detach($request->branchId);
            $data["branch"]["id"] = $branch->id;
            $data["branch"]["name"] = $branch->store_name;
            return $this->sendData($data);

        }catch (\Exception $e){
            return $this->sendError("error");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["offer"] = Offers::findOrFail($id);
        $data["items"] = ItemsList::all();
        $data["categories"] = CategoryList::all();
        $offers = Offers::all();
        $allOffers = [];
        if($offers){
            foreach ($offers as $offer)
                $allOffers[$offer->translate_type][$offer->translate_type == "category" ? $offer->category->id : $offer->item->id] = true;
        }
        $data["allCurrentOffers"] = $allOffers;
        unset($allOffers, $offers);

        return view("offers.edit",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = $this->rules();
        if($request->offer_type == 1)
            $rules["offer_value"] = ["required", "numeric", "between:0,99.99"];

        if($request->offer_value_type == 1)
            $rules["item"] = ["required"];
        else
            $rules["category"] = ["required"];

        $valid = Validator::make($request->all(), $rules,[],$this->columns());
        if ($valid->fails()) {
            return redirect()->route("offers.create")->withInput($request->all())->withErrors($valid->errors());
        }else{
            $offer = Offers::findOrFail($id);
            $offer->offer_type = $request->offer_value_type == 1 ? "p" : "m";
            $offer->translate_type = $request->offer_type == 2 ? "item" : "category";
            $offer->value = $request->offer_value;
            $offer->type_id  = $request->offer_type == 2 ? $request->item : $request->category;
            $offer->save();
            $this->setPageMessage("The Offer Has Been Updated Successfully");
            return redirect()->route("offers.index");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Offers::findOrFail($id)->delete();
        $this->setPageMessage("The Offer Has Been Deleted Successfully",0);
        return redirect()->route("offers.index");
    }
}
