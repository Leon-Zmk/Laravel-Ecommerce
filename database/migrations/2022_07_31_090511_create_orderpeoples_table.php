<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderpeoples', function (Blueprint $table) {
            $table->id();
            $table->string("user_id");
            $table->string("shipping_fee");
            $table->string("items_fee");
            $table->string("total");
            $table->string("member_city");
            $table->string("member_location");
            $table->string("member_phone");
            $table->string("is_delivered");
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
        Schema::dropIfExists('orderpeoples');
    }
};
