<?php

namespace Database\Seeders;

use App\Models\Filter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filter=[
            "id"=>1,
            "filter_name"=>"Axios",
            "base_filter_category"=>"1",
            "status"=>"1",
        ];

        Filter::insert($filter);
    }
}
