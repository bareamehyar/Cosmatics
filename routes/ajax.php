<?php

use Illuminate\Support\Facades\Route;




//Commissions
Route::prefix("commissions")->name("commissions.")->group(function (){
    Route::post("/", "CommissionController@save")->name("save");
    Route::post("/destroy", "CommissionController@destroy")->name("destroy");

});