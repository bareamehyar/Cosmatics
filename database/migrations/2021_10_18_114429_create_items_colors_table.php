<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_colors', function (Blueprint $table) {
            $table->id();

            $table->integer("item_id");
            $table->text("url_image");
            $table->string("color");
            $table->foreign("item_id")->references("id")->on("items_list")->onDelete("cascade")->onUpdate("cascade");
//            $table->foreign("image_id")->references("id")->on("item_galleries")->onDelete("cascade")->onUpdate("cascade");

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
        Schema::dropIfExists('items_colors');
    }
}
