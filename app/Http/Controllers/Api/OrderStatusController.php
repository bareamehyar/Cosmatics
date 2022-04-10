<?php

namespace App\Http\Controllers\Api;

use App\Models\Notification;
use App\Traits\Firebase;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\ApiResponse;
use App\Traits\Notifications;

class OrderStatusController extends Controller
{
    use  Notifications, Firebase;


    public function setOrderStatus(Request $request){
        if(!isset($request->phone_number) || !isset($request->order_id) || !isset($request->status)){
            return $this->sendError();
        }else{
            $user   = $user=User::where('MobileNumber',$request->phone_number)->first();
            $order  = Order::find($request->order_id);
            if($order && $user){
                $notification_texts = [];
                if($request->status == 1){
                    $notification_texts = $this->getNotificationTextDetails("accept_order", ["order_id" => $order->id]);
                    $order->Status = 2;
                }else if($request->status == 2){
                    $notification_texts = $this->getNotificationTextDetails("prepare_order", ["order_id" => $order->id]);
                    $order->Status = 3;
                }else if($request->status == 3){
                    $notification_texts = $this->getNotificationTextDetails("ready_order", ["order_id" => $order->id]);
                    $order->Status = 4;
                }else if($request->status == 4){
                    $notification_texts = $this->getNotificationTextDetails("delieverd_order", ["order_id" => $order->id]);
                    $order->Status = 5;
                }else if($request->status == 5){
                    $notification_texts = $this->getNotificationTextDetails("reject_order", ["order_id" => $order->id]);
//                if(isset($request->message_en))
//                $notification_texts["body"]["en"] = $request->message_en;
//                $notification_texts["body"]["ar"] = $request->message_ar;
                    $order->Status = 6;
                }
                if(!empty($notification_texts)){
                    $notification = new Notification();
                    $notification->title_en = $notification_texts["title"]["en"];
                    $notification->title_ar = $notification_texts["title"]["ar"];
                    $notification->body_en = $notification_texts["body"]["en"];
                    $notification->body_ar = $notification_texts["body"]["ar"];
                    $notification->user_id = $user->id;
                    $notification->save();
                    $this->sendFirebaseNotification($notification_texts, [$order->token]);
                }else{
                    return $this->sendError("notification your want is not exists");
                }

                $order->save();
                return $this->sendSuccess("Sended Success");
            }else{
                return $this->sendError("order or user not exists");
            }

        }
    }
}
