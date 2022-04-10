<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Traits\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    use Helper;
    public function itemsCountOrder()
    {
        if(!hasPermissions("view-items-ordered-report"))
            return abort("401");

        $data["items"] = DB::table("items_list")
            ->select(["items_list.*" , "category_list.category_name_en", "category_list.category_name_ar",
                DB::raw("COUNT(order_items.id) as 'itemsNumber'")])
            ->leftJoin("order_items", "items_list.id", "=", "order_items.item_id")
            ->join("category_list","category_list.id", "=", "items_list.category_id")
            ->groupBy("items_list.id")->orderBy("itemsNumber",'desc')->get();
        return view("reports.items_count_order", $data);

    }

    public function exportItemsCountOrderAsExcel(){
        if(!hasPermissions("view-items-ordered-report"))
            return abort("401");

        $items = DB::table("items_list")
            ->select(["items_list.*" , "category_list.category_name_en", "category_list.category_name_ar",
                DB::raw("COUNT(order_items.id) as 'itemsNumber'")])
            ->leftJoin("order_items", "items_list.id", "=", "order_items.item_id")
            ->join("category_list","category_list.id", "=", "items_list.category_id")
            ->groupBy("items_list.id")->orderBy("itemsNumber",'desc')->get();

        return $this->downloadExcelFile(
            ["id","item_name_en", "item_name_ar", "item_price",
                "category_name_en" , "category_name_ar", "itemsNumber"
            ], $items,
            ["id","english name", "arabic name", "price",
                "category english name","category arabic name", "number times ordered"]);
    }

    public function getUsersWithCountOrdersHim(){
        if(!hasPermissions("view-users-ordered-report"))
            return abort("401");

        /*
         * SELECT * , COUNT(orders.id) as 'countOrder' from users
         * LEFT JOIN orders ON orders.phone_number = users.MobileNumber GROUP BY users.id
         * */
        $data["users"] = DB::table("users")
            ->select(["users.*" , DB::raw("COUNT(orders.id) as 'countOrders'")])
            ->leftJoin("orders", "orders.phone_number", "=", "users.MobileNumber")
            ->groupBy("users.id")->orderBy("countOrders",'desc')->get();
        return view("reports.users_count_orders", $data);
    }

    public function exportUsersWithCountOrdersHimAsExcel(){
        if(!hasPermissions("view-users-ordered-report"))
            return abort("401");

        $users = DB::table("users")
            ->select(["users.*" , DB::raw("COUNT(orders.id) as 'countOrders'")])
            ->leftJoin("orders", "orders.phone_number", "=", "users.MobileNumber")
            ->groupBy("users.id")->orderBy("countOrders",'desc')->get();

        return $this->downloadExcelFile(
            ["id","first_name", "last_name", "MobileNumber", "countOrders"] , $users,
            ["id","first name", "last name", "Phone number","Orders"], "users_orders.xlsx");
    }

    public function getBranchesSales(){
        if(!hasPermissions("view-branches-sales-report"))
            return abort("401");

        /*
            SELECT branch_table.* , SUM(orders.priceWithDelivery) as 'branch_sales_with_delivery' ,
            SUM(orders.Total_Amount) as 'branch_sales', COUNT(orders.id) as 'countOrders' FROM `branch_table`
            LEFT JOIN orders ON orders.branchSelected = branch_table.store_name GROUP BY branch_table.id
       */

        $data["areas"] = DB::table("cities_area")
            ->select(["cities_area.*" , DB::raw("SUM(orders.Total_Amount) as 'area_sales'"),
                DB::raw("SUM(orders.priceWithDelivery) as 'area_sales_with_delivery'"),
                DB::raw("COUNT(orders.id) as 'count_orders'"),])
            ->leftJoin("orders", "orders.branchSelected", "=", "cities_area.area_name")
            ->groupBy("cities_area.id")->orderBy("area_sales",'desc')->get();
        return view("reports.branches_sales", $data);
    }

    public function exportBranchesSalesAsExcel(){
        if(!hasPermissions("view-branches-sales-report"))
            return abort("401");

        $branches = DB::table("branch_table")
            ->select(["branch_table.*" , DB::raw("SUM(orders.Total_Amount) as 'branch_sales'"),
                DB::raw("SUM(orders.priceWithDelivery) as 'branch_sales_with_delivery'"),
                DB::raw("COUNT(orders.id) as 'count_orders'"),])
            ->leftJoin("orders", "orders.branchSelected", "=", "branch_table.store_name")
            ->groupBy("branch_table.id")->orderBy("branch_sales",'desc')->get();

        return $this->downloadExcelFile(
            ["id","store_name", "phone_number", "branch_sales", "branch_sales_with_delivery", "count_orders"] ,
            $branches,
            ["id","Branch name", "Branch Phone number", "Total Sales","Total Sales with Delivery", "Orders"],
            "branches_sales.xlsx");
    }

    public function orders(){
//        $data["orders"] = DB::table("orders")
//            ->select(["orders.*"])->orderBy("Total_Amount",'desc')->get();
//        return view("reports.branches_sales", $data);

    }
}
