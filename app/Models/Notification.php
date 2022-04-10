<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ["title_en","title_ar","body_en","body_ar", "send_date"];
    protected $table = "notifications";
    public $timestamps = false;
}
