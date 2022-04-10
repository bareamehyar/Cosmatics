<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchTable extends Model
{
    protected $imgDirectoryPath = "uploads" . DS . "branches" . DS;
    protected $appends = ["imgPath","imgPathUrl"];
    protected $fillable = ["store_name","latitude", "longitude", "img_url", "phone_number", "category_id", "address" , 'InvoiceFooterMessage'];
    protected $table = "branch_table";
    public $timestamps = false;

    public function getImgPathAttribute(){
        return $this->imgDirectoryPath;
    }
    public function getImgPathUrlAttribute(){
        return env("APP_PATH") . "/uploads/branches/";
    }


    public function sliders(){
        return $this->hasMany(BranchTableImages::class, "branch_id", "id");
    }

    public  function category(){
        return $this->belongsTo(CategoryBranch::class, "category_id", "id");
    }

    public function items(){
        return $this->belongsToMany(ItemsList::class, "items_branches",
            "item_id", "item_id");
    }

    public function offers(){
        return $this->belongsToMany(Offers::class, "offers_branches", "branch_id", "offer_id");
    }


}
