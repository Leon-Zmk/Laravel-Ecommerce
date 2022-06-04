<?php

namespace Database\Seeders;

use App\Models\Vshop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VshopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vshopRecord=[
            "id"=>"1",
            "shop_name"=>"Vendor Shop",
            "shop_owner"=>"1",           
            "shop_address"=>"76 st 43",
            "shop_website"=>"",
            "shop_mobile"=>"094891481190",
            "shop_email"=>"vendorshop@admin.com",
            "shop_image_verification"=>"veriimg.com",
        ];

        Vshop::insert($vshopRecord);
    }
}
