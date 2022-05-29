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
            'name'=>'super admin',
            'type'=>'super admin',
            'vendor_id'=>'0',
            'mobile'=>'0997129481',
            'email'=>'admin@admin.com',
            'password'=>"$pass",
            'status'=>'1'
        ];

        Admin::insert($superADM);


    }
}
