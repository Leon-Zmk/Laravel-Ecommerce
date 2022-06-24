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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("section_id");
            $table->string("category_id");
            $table->string("brand_id");
            $table->string("vendor_id");
            $table->string("admin_id");
            $table->string("admin_type");
            $table->string("description");
            $table->string("price");
            $table->string("discount")->nullable();
            $table->string("color")->nullable();
            $table->string("code");
            $table->string("image")->default("product_default.png");
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
        Schema::dropIfExists('products');
    }
};
