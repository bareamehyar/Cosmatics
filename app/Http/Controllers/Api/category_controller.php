<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\CategoryList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class category_controller extends Controller
{
    //

    public function getAllCategory($lang_code){

        if($lang_code === 'en'){
            $query=DB::select("SELECT `id`, `category_name_en`,`category_image_url` FROM `category_list` WHERE category_status = 1");

            return response($query);
        } else{
            $query=DB::select("SELECT `id`, `category_name_ar`, `category_image_url` FROM `category_list` WHERE category_status = 1");

            return response($query);
        }

    }

    public function getAllItemFromCategory($category_id){


        $query=DB::select("SELECT * FROM `items_list` WHERE `category_id` = $category_id");

        return response($query);

    }
    public function getCategoryByBranch(Request $request){
        $lang = $request->lang;
        $categories = CategoryList::join("items_list", "items_list.category_id", "=", "category_list.id")
            ->join("items_branches",
                [["items_branches.item_id", "=", "items_list.id"],["items_branches.branch_id", "=", DB::raw($request->branch_id)]])
            ->groupBy("items_list.category_id")->select( "category_list.id","category_name_{$lang} as category_name", "category_image_url")->get()->makeHidden(["img_path_url","directory_path"]);
        if($categories)
            return $categories;
        else
            return false;
    }
}
