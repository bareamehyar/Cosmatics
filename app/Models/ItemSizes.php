<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemSizes extends Model
{
    //
    protected $fillable=["item_id","Size"];

    public function item(){
        return $this->belongsTo(ItemsList::class, "item_id", "id");
    }
}
