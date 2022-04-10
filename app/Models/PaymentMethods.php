<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethods extends Model
{
    protected $fillable = ["title"];
    protected $table = "payment_methods";
    public $timestamps=false;



}
