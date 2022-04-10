<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Traits\Firebase;
use App\Traits\Notifications;
use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Models\OrderItem;
use App\Models\AddOnsOrder;
use Illuminate\Support\Facades\Http;


use Illuminate\Support\Facades\DB;

class creat_order_controller extends Controller
{

    use  Notifications, Firebase;


    public function createOrder(Request $request){


        try{


         $orderNumber=DB::select("select max(order_number) as MaxOrderNumber from orders limit 1");
         $MaxOrderNumber=$orderNumber[0]->MaxOrderNumber;


          if(empty($MaxOrderNumber)){
              $MaxOrderNumber=0;
          }


         $TotlaPrice=$request -> cart['totalItemPrice'];
         $TotalQuentety=$request ->cart['totalQty'];
         $addressSelected=$request ->cart['addressSelected'];
         $paymentSelected=$request ->cart['paymentSelected'];
         $phoneNumber=$request ->cart['phoneNumber'];
         $instruction=$request ->cart['instruction'];

         $priceWithDelivery=$request ->cart['priceWithDelivery'];
         $deliveryFee=$request ->cart['deliveryFee'];
         $branchSelected=$request ->cart['branchSelected'];
                  $token=$request ->cart['token'];
                  $order_time = $request->cart["orderTime"];



         $createOrder=Order::create([
             'order_number'=>$MaxOrderNumber+1,
             'Total_Amount'=>$TotlaPrice,
             'paymentMethod'=>$paymentSelected,
             'DropOffAddress'=>$addressSelected,
             'totalQty'=>$TotalQuentety,
             'phone_number'=>$phoneNumber,
             'instruction'=>$instruction,
             'priceWithDelivery'=>$priceWithDelivery,
             'deliveryFee'  =>$deliveryFee,
             'branchSelected'=>$branchSelected,
             'delivered_time' => $order_time,
             'token'=>$token
             ]);



        if($createOrder)  {


         $orderID= $createOrder['id'];


        $items=$request->cart['items'];


         foreach( $items as $item){

                     $ItemID =$item['item']['id'];
                     $QuentetyItem=$item['quantity'];
                     $ItemPrice =$item['item']['item_price'];
                     $TotalPriceItem=$item['totalPrice'];
                     $Category_Id =$item['item']['category_id'];
                     $ItemImage =$item['item']['item_image'];
                     $Item_Name_En =$item['item']['item_name_en'];
                     $Item_Name_Ar =$item['item']['item_name_ar'];




                     $createOrderItem=OrderItem::create([
                         'order_id'=>$orderID,
                         'item_id'=>$ItemID,
                         'quantity'=>$QuentetyItem,
                         'itemPrice'=>$ItemPrice,
                         'totalPrice'=>$TotalPriceItem,
                         'category_id'=>$Category_Id,
                         'item_image'=>$ItemImage,
                         'item_name_en'=>$Item_Name_En,
                         'item_name_ar'=>$Item_Name_Ar,
                         'OrderBy'=>"u"
                         ]);



                         if($createOrderItem){

                          $orderItemID=$createOrderItem['id'];
                           $addOnsByCategory=$item['addOnsByCategory'];

                             foreach($addOnsByCategory as $category){

                                 $catgoryid=$category['id'];
                                 $catgoryname=$category['name'];
                                 $addons=$category['addons'];

                                 foreach($addons as $addon){
                                     $addonid= $addon['id'];
                                     $addonname= $addon['name'];
                                     $addoneprice= $addon['price'];

                                     $craeteAddonse=AddOnsOrder::create([
                                         'order_item_id'=>$orderItemID,
                                         'AddOns_Category_id'=>$catgoryid,
                                         'AddOns_Category_name'=>$catgoryname,
                                         'AddOns_id'=>$addonid,
                                         'AddOns_name'=>$addonname,
                                         'AddOns_price'=>$addoneprice,
                                         'OrderBy'=>"u"

                                         ]);

                                 }
                             }

                         }



                  }










       Http::get('http://socketserver.baby.pos001.digisolapps.com:4250/NewOrder',["data"=>$orderID,"type"=>"vendor"]);
         }

            $user=User::where('MobileNumber',$createOrder['phone_number'])->first(['first_name','last_name','id']);

            if($user){
                $createOrder['first_name']=$user ->first_name;
                $createOrder['last_name']=$user->last_name;
                $createOrder['userid']=$user->id;
            }

            $notification_texts = $this->getNotificationTextDetails("pending_order", ["order_id" => $createOrder['id']]);
            $notification = new Notification();
            $notification->title_en = $notification_texts["title"]["en"];
            $notification->title_ar = $notification_texts["title"]["ar"];
            $notification->body_en = $notification_texts["body"]["en"];
            $notification->body_ar = $notification_texts["body"]["ar"];
            $notification->user_id = $user->id;
            $notification->save();
            $this->sendFirebaseNotification($notification_texts, [$createOrder->token]);



        return response()->json(['reply'=>$createOrder]);








      }catch(\Illuminate\Database\QueryException $ex){
                    $error=$ex->getMessage();
                    return response($ex);


                    }

    }


}
