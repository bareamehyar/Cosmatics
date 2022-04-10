<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
define("DS",DIRECTORY_SEPARATOR);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes(['verify' => true]);



Route::group(["middleware" => ["auth", "verified", "permissions"], "namespace" => "Web"],function(){
    
    Route::redirect("/","/en");
    Route::group(['prefix'=>'{lang}'],function() {
    Route::get('/', "DashboardController@index")->name("dashboard.index");
    //users app
    Route::get("users/app", "UsersController@index")->name("users.app.index");
    Route::delete("users/app/{id}", "UsersController@destroy")->name("users.app.destroy");
    Route::get("profile", "UsersDashboardController@profile")->name("profile");
    Route::post("profile", "UsersDashboardController@saveProfile")->name("profile.save");
    Route::get("users/driver", "UsersController@driverindex")->name("users.driver.index");
    Route::get("users/vendor", "UsersController@vendorindex")->name("users.vendor.index");


    //user cashier
    Route::get("users/cashier", "UsersController@cashierIndex")->name("users.cashier.index");

    Route::resource("admins", "UsersDashboardController");





        //categories
        Route::resource("categories", "CategoryListController");
          

        //categories_branches
        Route::resource("categories_branches", "CategoryBranchController");

        //sliders
        Route::resource("sliders", "SliderController");




        //bracnh
        Route::resource("branches", "BranchTableController");
        Route::get("branch/{id}/slider","BranchTableController@slider")->name("branch.slider");
        Route::put("branch/slider","BranchTableController@saveSlider")->name("branch.slider.save");
        Route::post("item/{id}/branches", "BranchTableController@getByItem");
        Route::post("category/{id}/branches", "BranchTableController@getByCategory");


        //addons
        Route::get("items/{id}/add_ons","AddOnsController@index")->name("items.add_ons");
        Route::get("items/{id}/add_ons/create","AddOnsController@create")->name("items.add_ons.create");
        Route::post("items/{id}/add_ons","AddOnsController@store")->name("items.add_ons.store");
        Route::get("items/{item_id}/add_ons/{id}/edit","AddOnsController@edit")->name("items.add_ons.edit");
        Route::put("items/{item_id}/add_ons/{id}","AddOnsController@update")->name("items.add_ons.update");
        Route::delete("items/{item_id}/add_ons/{id}/","AddOnsController@destroy")->name("items.add_ons.destroy");

        //item
        Route::get("items/export/excel", "ItemsListController@exportAsExcel")->name("items.export.excel");
        Route::resource("items", "ItemsListController");
        Route::get("items/images", "ItemsListController@getImages")->name("items.images");


        //order controller
        Route::get("orders","OrderController@index")->name("orders.index");
        Route::get("CashierOrders","OrderController@posOrders")->name("orders.posOrders");
        Route::get("orders/{id}/details","OrderController@details")->name("orders.details");
        Route::post("orders/export/excel","OrderController@exportExcelFile")->name("orders.export.excel");

        //settings
        Route::get("settings","SettingsController@index")->name("settings.index");
        Route::post("settings","SettingsController@store")->name("settings.store");



        //Role
        Route::resource("roles","RoleController");

        //services
        Route::resource("services","servicesController");
        Route::get("ServicesLink","servicesController@link")->name("services.link");
        Route::post("ServicesStore","servicesController@linkItem")->name("services.storeLink");



        //Report
        Route::get("reports/items_count_order", "ReportController@itemsCountOrder")->name("reports.items_count_order");
        Route::get("reports/items_count_order/export/excel",
            "ReportController@exportItemsCountOrderAsExcel")->name("reports.items_count_order.export.excel");
        Route::get("reports/users_with_count_him_orders", "ReportController@getUsersWithCountOrdersHim")->name("reports.users_with_count_him_orders");
        Route::get("reports/users_with_count_him_orders/export/excel",
            "ReportController@exportUsersWithCountOrdersHimAsExcel")->name("reports.users_with_count_him_orders.export.excel");
        Route::get("reports/branches_sales", "ReportController@getBranchesSales")->name("reports.branches_sales");
        Route::get("reports/branches_sales/export/excel",
            "ReportController@exportBranchesSalesAsExcel")->name("reports.branches_sales.export.excel");



        // Offers Routes
        Route::resource("offers","OfferController", [
            "except" => ["show"]
        ]);
        Route::get("offers/{id}/branches", "OfferController@branches")->name("offers.branches");
        Route::post("offers/{offer_id}/branches/attach", "OfferController@branchesAttach")->name("offers.branches.attach");
        Route::post("offers/{offer_id}/branches/detach", "OfferController@branchesDetach")->name("offers.branches.detach");






    }); // lang

    //payment_method
    Route::resource("payment_method", "PaymentMethodController");

    //DeliveryPrice
    Route::get("delivery_price/index","DeliveryPriceController@index")->name("delivery_price.index");
    Route::get("delivery_price/create","DeliveryPriceController@create")->name("delivery_price.create");
    Route::post("delivery_price","DeliveryPriceController@store")->name("delivery_price.store");
    Route::get("delivery_price/{id}/edit","DeliveryPriceController@edit")->name("delivery_price.edit");
    Route::put("delivery_price/{id}/update","DeliveryPriceController@update")->name("delivery_price.update");
    Route::delete("delivery_price/{id}/destroy","DeliveryPriceController@destroy")->name("delivery_price.destroy");
    Route::get("delivery_price/tree","DeliveryPriceController@tree")->name("delivery_price.tree");
    Route::post("api/delivery_location/initialize", "DeliveryPriceController@initialize");
    Route::post("api/delivery_location/cancel", "DeliveryPriceController@cancel");




    //city
    Route::resource("city", "CityController");

    //AreaSection
    Route::get("city/{city_id}/areas", "AreaController@index")->name("area.index");
    Route::get("city/{city_id}/areas/create", "AreaController@create")->name("area.create");
    Route::post("city/{city_id}/areas", "AreaController@store")->name("area.store");
    Route::get("city/{city_id}/areas/{id}/edit", "AreaController@edit")->name("area.edit");
    Route::put("city/{city_id}/areas/{id}", "AreaController@update")->name("area.update");
    Route::delete("city/{city_id}/areas/{id}", "AreaController@destroy")->name("area.destroy");











//    Route::get("test", function(){
//        \App\Helpers\GoogleMaps::getAddressFromCoordinates(31.97674223985439, 35.85570402263278);

//    });

});
