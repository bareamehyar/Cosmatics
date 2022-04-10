<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemGallery extends Model
{
    //
    protected  $fillable=["image_url","item_id"];

    public function item(){
        return $this->belongsTo(ItemsList::class, "item_id", "id");
    }
}
