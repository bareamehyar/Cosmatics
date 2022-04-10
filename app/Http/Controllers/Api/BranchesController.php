<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BranchTable;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class BranchesController extends Controller
{
    use ApiResponse;
    public function getByCategory($category_id){
        $branches = BranchTable::where("category_id",$category_id)
            ->get(["id","store_name", "latitude", "longitude","address", "img_url"])->makeHidden(["imgPath", "imgPathUrl"]);
       return $branches ?: false;
    }
}
