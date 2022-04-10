<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BranchTable;
use App\Models\ItemsList;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function getByBranchAndCategory($lang, $branch_id, $category_id){
      $items = ItemsList::join("items_branches", "items_branches.item_id", "=", "items_list.id")
         ->where([["category_id", $category_id],["items_branches.branch_id", $branch_id]])
         ->select("items_list.*")->get();
      $branch = BranchTable::findOrFail($branch_id);
      $allOffers = [];

      if(!empty($branch->offers[0])){
          foreach ($branch->offers as $offer)
              $allOffers[$offer->translate_type][$offer->type_id] =
              ["type" => $offer->offer_type,
               "value" => $offer->value];
      }
     $data = [];
      foreach ($items as $item){
          $itemData = [];
          $itemData["id"] = $item->id;
          $itemData["name"] = $item->{"item_name_" . $lang};
          $itemData["price"] = $item->item_price;
          $itemData["description"] = $item->{"item_description_" . $lang};
          $itemData["image_url"] = $item->item_image;
          $itemData["status"] = $item->item_status;

          if(isset($allOffers["item"][$item->id]) && !empty($allOffers["item"][$item->id])){
              $itemData["priceWithOffer"] = $allOffers["item"][$item->id]["type"] == "p" ?
                  $itemData["price"] - ($itemData["price"] * ($allOffers["item"][$item->id]["value"] / 100))
                  : $itemData["price"] - $allOffers["item"][$item->id]["value"];

              $itemData["offerValue"] = $allOffers["item"][$item->id]["value"];
              $itemData["offerType"] = $allOffers["item"][$item->id]["type"];
          }elseif(isset($allOffers["category"][$item->category->id]) && !empty($allOffers["category"][$item->category->id])){
              $itemData["priceWithOffer"] = $allOffers["category"][$item->category->id]["type"] == "p" ?
                  $itemData["price"] - ($itemData["price"] * ($allOffers["category"][$item->category->id]["value"] / 100))
                  : $itemData["price"] - $allOffers["category"][$item->category->id]["value"];

              $itemData["offerValue"] = $allOffers["category"][$item->category->id]["value"];
              $itemData["offerType"] = $allOffers["category"][$item->category->id]["type"];
          }
          $data[] = $itemData;
      }
      return $data;
    }
}
