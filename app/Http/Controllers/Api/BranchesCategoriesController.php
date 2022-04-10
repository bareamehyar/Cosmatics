<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BranchTable;
use App\Models\CategoryBranch;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryBranch as CategoryBranchResource;

class BranchesCategoriesController extends Controller
{
    use ApiResponse;
    public function index(){
        $categories = CategoryBranch::select("id", "img_url")->get()->makeHidden(["directory_path", "img_path_url"]);
        return $categories ?: false;

    }

}
