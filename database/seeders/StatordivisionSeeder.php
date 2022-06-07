<?php

namespace Database\Seeders;

use App\Models\Statordivision;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatordivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr=["Mandalay","Yangon","Nay Pyi Taw","Maymyo","Meiktila","Pyapon","Myawaddy","Kyaing Tong","Bagan","Dawei","Kalemyo","Pathein","Pakokku","Shwebo","Putao","Sittwe","Myingyan","loikaw","Mergui","Lashio","Taunggyi","Hakha","Hopin","Ayeyarwady","Pathein","Bago","Magway","Sagain","Tanintharyi","Chin","Myitkyina","Kayin","Kayah","Mon","Rakhine","Shan"];

        foreach ($arr as $key => $value) {
            $sodrecords=[
                
                "stat_or_division"=>$value,
            ];

            Statordivision::insert($sodrecords);
        }
    }
}
