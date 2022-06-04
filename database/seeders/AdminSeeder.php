<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $pass=Hash::make("password");
        $superADM=[
            'id'=>1,
            'name'=>'Zaw Min Khant',
            'type'=>'Admin',
            'vendor_id'=>'0',
            'mobile'=>'0924141901',
            'email'=>'admin@admin.com',
            'password'=>"$pass",
            'status'=>'1'
        ];
        $Vendor=[
            'id'=>2,
            'name'=>'Zaw Min Khant',
            'type'=>'Vendor',
            'vendor_id'=>'1',
            'mobile'=>'0942129014',
            'email'=>'vendor@admin.com',
            'password'=>"$pass",
            'status'=>'1'
        ];

        Admin::insert($superADM);
        Admin::insert($Vendor);

    }
}
