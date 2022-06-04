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
        Schema::create('vshops', function (Blueprint $table) {
            $table->id();
            $table->string("shop_name");
            $table->string("shop_owner");
            $table->string("shop_profile")->nullable()->default("user_default.png");
            $table->string("shop_background_profile")->nullable()->default("user_default.png");
            $table->string("shop_address");
            $table->string("shop_website")->nullable();
            $table->string("shop_mobile");
            $table->string("shop_email");
            $table->string("shop_image_verification");
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
        Schema::dropIfExists('vshops');
    }
};
