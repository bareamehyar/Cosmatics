<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddOnsTitle extends Model
{
    protected $fillable = ["add_ons_name_en", "add_ons_name_ar", "item_id", "which_choice"];
    protected $table = "add_ons_title";
    public $timestamps=false;

    public function addOnsList(){
        return $this->hasMany(AddOnsList::class, "add_ons_cat_id", "id");
    }

}
