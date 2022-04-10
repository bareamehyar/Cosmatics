<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    protected $fillable = ["offer_type", "value", "translate_type", "type_id"];

    public $timestamps = false;

    public function category(){
        return $this->belongsTo(CategoryList::class, "type_id");
    }

    public function item(){
        return $this->belongsTo(ItemsList::class, "type_id", "id");
    }

    public function branches(){
        return $this->belongsToMany(BranchTable::class, "offers_branches", "offer_id", "branch_id");
    }
}
