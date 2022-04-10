<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/',function(){
    if(DB::connection()->getDatabaseName())
    {
       echo "Yes! successfully connected to the DB: " . DB::connection()->getDatabaseName();
    }
});

Route::group(["namespace"=>"Api"],function(){

// add user name to data base controller
    Route::post("addUserName/{id}/{firstName}/{lastName}/{phone_number}/{is_logged_in}","save_name_contraller@addUserName");
    Route::get("getNotificationByUser/{phoneNumber}","notification_controller@getNotificationByUser");

    // Event
    Route::post("addEvent/{mobile_number}/{event_type}","event_controller@addEvent");


    Route::resource("brand","brandController");
    Route::get("BrandCategory/{brand_id}","brandController@BrandCategory");
    Route::get("BrandItems/{brand_id}","brandController@get_all_items_brands");
    // Route::get("BrandCategoryItems/{brand_id}/{category_id}","brandController@get_items_category_brands");


//  phone number controller
    Route::get("checkPhoneNumber/{phoneNumber}","check_phone_number@checkPhoneNumber");
    Route::get("getfisrtNamelastName/{phoneNumber}","check_phone_number@getfisrtNamelastName");
    Route::get("updatePersonInfo/{phoneNumber}/{first_name}/{last_name}","check_phone_number@updatePersonInfo");
    Route::get("getAllAddresses/{phoneNumber}","check_phone_number@getAllAddresses");
    Route::get("addAddressManual/{phoneNumber}/{title}/{area_name}/{street_name}/{building_number}/{floor_number}/{apartment_number}/{lat}/{long}","check_phone_number@addAddressManual");
    Route::get("getAddressDetails/{id}","check_phone_number@getAddressDetails");
    Route::post("updateAddressDetails/{title}/{area_name}/{street_name}/{building_number}/{floor_number}/{apartment_number}/{id}","check_phone_number@updateAddressDetails");

// get all branches controllers
    Route::get("getAllBranches","get_branches_controller@getAllBranches");
    Route::get("getBranchDetails/{id}","get_branches_controller@getBranchDetails");
    Route::get("branches/category/{category_id}","BranchesController@getByCategory");

    Route::post("contuct_us","contuct_us_controller@store");

// get all cities controller
    Route::get("getAllCities","get_all_cities_controller@getAllCities");
    Route::get("getAllAreas/{city_id}","get_all_cities_controller@getAllAreas");
    Route::get("getAllAreasAndCities","get_all_cities_controller@getAllAreasAndCities");

//check is logged in
    Route::get("checkIsLoggedIn/{mobile_number}","check_is_logged_in@checkIsLoggedIn");

// all category feild conroller
    Route::get("getAllCategory/{lang_code}","category_controller@getAllCategory");
    Route::get("getAllItemFromCategory/{categoryId}","category_controller@getAllItemFromCategory");
    Route::get("{lang}/branches/{branch_id}/categories", "category_controller@getCategoryByBranch");

// item details controller
    Route::get("getItemDetails/{itemId}","get_item_details_controller@getItemDetails");
    Route::get("getItemAddOnsCategory/{itemId}","get_item_details_controller@getItemAddOnsCategory");
    Route::get("getListOfAddOns/{addOnsCatId}","get_item_details_controller@getListOfAddOns");
    Route::get("getItemBySerial","get_item_details_controller@getItemBySerial");
    Route::get("getItemImages/{item_id}","get_item_details_controller@getItemImages");

    Route::get("getItemSizes/{item_id}","get_item_details_controller@getItemSizes");

    Route::get("getItemColor/{item_id}","get_item_details_controller@getItemColor");



// app settings controller
    Route::get("getAppSettings","app_settings_controller@getAppSettings");
    Route::post("updateIsAccepting/{isAccept}","app_settings_controller@updateIsAccepting");
    Route::get("getIsAcceptOrder","app_settings_controller@getIsAcceptOrder");

//creat order controller
    Route::post("createOrder","creat_order_controller@createOrder");
    Route::get("OrderItemDetails","order_details_controller@getOrderItemDetails");


 // cashier orders
    Route::post("CreateCashierOrder","posOrderController@store");
    Route::get("CashierOrderItemDetails","posOrderController@getOrderItemDetails");
    Route::get("getInvoiceFooter/{branch_id}","posOrderController@getInvoiceFooter");

    Route::get("get_Print_Order_Number","posOrderController@getPrintNumber");
    Route::get("EditPrintOrder","posOrderController@EditPrintOrder");



// get all payments
    Route::get("getAllPayment","get_all_payment@getAllPayment");

// get my orders
    Route::get("getMyOrders/{phone_number}/{type}","order_details_controller@getMyOrders");
    Route::get("getMyOrderDetails/{order_id}","order_details_controller@getMyOrderDetails");

    Route::get("getInvoice","order_details_controller@getInvoice");




// get branch slider image controller
    Route::get("getBranchSlider/{branch_id}","get_branch_slider_controller@getBranchSlider");

// get slider in home page
    Route::get("getSlider","get_main_slider_controller@getSlider");
    Route::get("navigateSlider/{type}/{id}","get_main_slider_controller@navigateSlider");

// vendor controller
    Route::get("gelAllItems","vendor_controller@gelAllItems");
    Route::get("gelDisableItems","vendor_controller@gelDisableItems");
    Route::get("Is_Auto_Print/{vendorID}","vendor_controller@Is_Auto_Print");


    Route::get("Edit_auto_print/{vendorID}/{newStatus}","vendor_controller@Edit_auto_print");

    Route::get("gelEnableItems","vendor_controller@gelEnableItems");
    Route::post("updateStatusToInActive/{itemId}","vendor_controller@updateStatusToInActive");
    Route::post("updateStatusToActive/{itemId}","vendor_controller@updateStatusToActive");
    Route::get("getEstimation","vendor_controller@getEstimation");
    Route::post("updateEstimationTime/{newTime}","vendor_controller@updateEstimationTime");
    Route::post("location/delivery_price","DeliveryPriceController@getDeliveryPrice");



    // order vendor same vendor controller
    Route::get("getPendingOrder","vendor_controller@getPendingOrder");
    Route::get("getAcceptedOrder","vendor_controller@getAcceptedOrder");
    Route::get("getPreparedOrder","vendor_controller@getPreparedOrder");
    Route::get("getReadyOrder","vendor_controller@getReadyOrder");
    Route::get("getDeliveredOrder","vendor_controller@getDeliveredOrder");
    Route::get("getCanceledOrder","vendor_controller@getCanceledOrder");

    Route::post("set_order_status", "OrderStatusController@setOrderStatus");

    // Categories Branches
    Route::get("/categories_branches", "BranchesCategoriesController@index");

    //Branches Items
    Route::get("/{lang}/items/branch/{branch_id}/category/{category_id}","ItemController@getByBranchAndCategory");


    // coupon controller
    Route::get("getCouponByUser/{phone_number}","coupon_controller@getCouponByUser");
    Route::post("checkValidCoupon","coupon_controller@checkValidCoupon");
    Route::post("use_coupon","coupon_controller@useCoupon");

});

//Ajax Call
// Change User App Status
Route::post("users/app/change_status", "Web\UsersController@changeStatus");
Route::post("users/app/change_type", "Web\UsersController@changeType");
Route::post("branch/slider/delete", "Web\BranchTableController@deleteSlider");
Route::post("addOn/option/delete", "Web\AddOnsOptionsController@destroy");
Route::post("service/option/delete", "Web\servicesController@destroyOption");

