<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemsColors extends Model
{
    protected  $fillable=['item_id','url_image','color'];


    public function item(){
        return $this->belongsTo(ItemsList::class, "item_id", "id");
    }

}
