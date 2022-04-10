<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category_service extends Model
{
    //
    
    protected $table="category_services";
    protected $fillable=['service_name_en', 'service_name_ar', 'which_choice'];

    public function Category_service_option(){
    return $this->hasMany(Category_service_option::class, "service_id", "id");
    }
    
    
}
