<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryBranch extends Model
{
    protected $fillable = ["name_en","name_ar","img_url", "status"];
    protected $table = "categories_branches";

    protected $appends = ["directory_path","img_path_url"];
    public $timestamps = false;

    public function getDirectoryPathAttribute(){
        return "uploads" . DS . "branches_categories" . DS;
    }

    public function getImgPathUrlAttribute(){
        return env("APP_PATH") . "/uploads/branches_categories/";
    }
    public function branches(){
        return $this->hasMany(BranchTable::class, "category_id", "id");
    }
}
