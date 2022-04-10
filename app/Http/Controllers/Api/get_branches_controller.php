<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class get_branches_controller extends Controller
{
    //
    public function getAllBranches(){

        $query = DB::select("SELECT * FROM `branch_table`");

        return response($query);

    }

    public function getBranchDetails($id){

        $query = DB::select("SELECT * FROM `branch_table` WHERE id = $id");

        return response($query);

    }
}
