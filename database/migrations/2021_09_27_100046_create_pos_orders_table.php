<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_orders', function (Blueprint $table) {
            $table->id();
            $table->integer("order_number");
            $table->string("paymentMethod")->comment("1- 2- ");
            $table->float("totalQty");
            $table->float("Total_Amount");
            $table->float("priceWithDelivery");
            $table->string("DropOffAddress");
            $table->string("phone_number");
            $table->string("instruction");
            $table->string("deliveryFee");
            $table->integer("branchSelected");
            $table->string("token");
            $table->foreign("branchSelected")->references("id")->on("branch_table")->onDelete("cascade")->onUpdate("cascade");

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pos_orders');
    }
}
