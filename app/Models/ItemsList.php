<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemsList extends Model
{
    protected $fillable = [
        'category_id', 'item_name_en', 'item_name_ar', 'item_price', 'tax', 'item_description_en', 'item_description_ar','quantity',
        'item_status', 'item_image',
    ];
    protected $table="items_list";
    public $timestamps=false;

    protected $appends = ["directory_path","img_path_url"];


    public function getDirectoryPathAttribute(){
        return "uploads" . DS . "items" . DS;
    }

    public function getImgPathUrlAttribute(){
        return env("APP_PATH") . "/uploads/items/";
    }


    public function category(){
        return $this->hasOne(CategoryList::class,  'id','category_id');
    }

    public function branches(){
        return $this->belongsToMany(BranchTable::class, "items_branches",
                            "item_id", "branch_id");
    }

    public function offer(){
        return $this->hasOne(Offers::class, "type_id", "id");
    }

    public function serial_no(){
        return $this->hasMany(ItemSerialNumber::class, "item_id", "id");
    }

    public function ItemSizes(){
        return $this->hasMany(ItemSizes::class, "item_id", "id");
    }

    public function ItemColor(){
        return $this->hasMany(ItemsColors::class, "item_id", "id");
    }

    public function ItemGallery(){
        return $this->hasMany(ItemGallery::class, "item_id", "id");
    }

//    public function sliders(){
//        return $this->belongsTo(Slider::class, )
//    }


}
