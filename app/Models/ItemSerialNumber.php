<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemSerialNumber extends Model
{            
    //
             
        protected $fillable = ['item_id','serial_no'];
    
    public function item(){
        return $this->belongsTo(ItemsList::class, "item_id", "id");
    }
}
