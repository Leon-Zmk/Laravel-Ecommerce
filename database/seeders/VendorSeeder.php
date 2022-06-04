<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorDetails=[
            "id"=>1,
            "name"=>"Zaw Min Khant",
            "city"=>"Mandalay",
            "phone"=>"0942129014",
            "email"=>"vendor@admin.com",
            "address"=>"၇၆ လမ်း ၃၄ ၃၅  ကြား",

        ];

        Vendor::insert($vendorDetails);
    }
}
