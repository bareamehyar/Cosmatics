<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse\Json\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\BrandCategory;

class brandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data =Brand::all();
        return response()->json($data,200);
    }

    public  function BrandCategory($brand_id){

        $Brandcategory =  BrandCategory::join("category_list","brand_categories.category_id","=","category_list.id")->where("brand_id",$brand_id)->get(["category_list.id","category_name_en","category_name_ar","category_image_url"]);
        return response()->json( $Brandcategory,200);

    }



    public  function get_all_items_brands($brand_id){

        $Brandcatitem =  BrandCategory::join("category_list","brand_categories.category_id","=","category_list.id")
            ->join("items_list","category_list.id","=","items_list.category_id")
            ->where("brand_id",$brand_id)
            ->get("items_list.*");
        return response()->json( $Brandcatitem,200);

    }

    // public function get_items_category_brands($brand_id,$category_id){

    //     $Brandcatitem =  BrandCategory::join("category_list","brand_categories.category_id","=","category_list.id")
    //         ->join("items_list","category_list.id","=","items_list.category_id")
    //         ->where([["brand_id",$brand_id],["category_list.id",$category_id]])
    //         ->get("items_list.*");
    //     return response()->json( $Brandcatitem,200);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
