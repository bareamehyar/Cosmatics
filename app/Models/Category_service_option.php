<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category_service_option extends Model
{
    //
        protected $table="category_service_options";
        protected $fillable=['service_option_en', 'service_option_ar', 'price','status'];
        public function Category_service(){
        return $this->belongsTo(Category_service::class,"add_ons_cat_id", "id");
       }

}
