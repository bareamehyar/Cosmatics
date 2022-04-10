<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

function gateCRUDPermissions($mainName){
    return Gate::check("view-" . $mainName) || Gate::check("create-" . $mainName)
        || Gate::check("update-" . $mainName) || Gate::check("delete-" . $mainName);
}

function getAllCuurentYearMonthsUntilCurrentMonth(){
    $cuurentMonth = date("n",time());
    for ($month=1; $month <= $cuurentMonth ; $month++) {
        $months_number[] = $month;
        $months_name[] = date("F", mktime(0,0,0,$month,10));
    }
    return ["months_number" => $months_number, "months_name" => $months_name];
}

function buildTreeView($level, $parentId, $tree){
    $view =  "<ul class='tree'>";
    if(!empty($tree[$level][$parentId]) && isset($tree[$level][$parentId])){
        foreach($tree[$level][$parentId] as $node){
            $hasTree = isset($tree[$level + 1][$node->id]) && !empty($tree[$level + 1][$node->id]);
            $view .= "<li class='" . ($hasTree ? "has-tree" : null) . "'>";

            $view .= "<div class='node " . ($hasTree ? "action-tree" : null) . "'>";
            if($hasTree)
                $view .= '<i class="fas fa-caret-right arrow"></i>';
            $view .= $node->location_text;
            $view .= "<span class='node-details'>Price: " . $node->price . " JOD </span>";
            $view .= "<span class='node-details'>Supported: " . ($node->supported ? "Yes" : "NO") . "</span>";
            if(hasPermissions(["edit-delivery-price", "delete-delivery-price"])){
                if(hasPermissions("edit-delivery-price"))
                    $view .= '<a href="' . route("delivery_price.edit", $node->id) . '?redirect=tree"class="control-link edit node-control"><i class="fas fa-edit"></i></a>';
                if(hasPermissions("delete-delivery-price"))
                    $view .= '<form action="' . route("delivery_price.destroy", $node->id) . '?redirect=tree" method="post" id="delete' . $node->id . '" style="display: none" data-swal-title="Delete Location" data-swal-text="Are Your Sure To Delete This Location ?" data-yes="Yes" data-no="No" data-success-msg="the location has been deleted succssfully">
                        <input type="hidden" name="_token" value="' . csrf_token() . '"><input type="hidden" name="_method" value="delete"></form>' .
                        '<span href="#" class="control-link node-control remove form-confirm" data-form-id="#delete' . $node->id . '"><i class="far fa-trash-alt"></i></span>';
            }
            $view .= "</span>";
            $view .= "</div>";
            if($hasTree)
                $view .= buildTreeView($level + 1, $node->id, $tree);
            $view .= "</li>";
        }
    }
    $view .= "</ul>";
    return $view;
}

function hasPermissions($permissions){
    $user = Auth::user();
    if($permissions == "admin-control"){
        if($user->is_admin == 1)
            return true;
        return false;
    }

    if($user->is_admin == 1)
        return true;

    if(is_array($permissions)){
        foreach ($permissions as $permission){
            if(Gate::allows($permission)){
                return true;
            }
        }
    }else{
        if(Gate::allows($permissions)){
            return true;
        }
    }
    return false;
}
