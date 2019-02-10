<?php

use App\Models\City;
use App\Models\Developer;
use App\Models\Listing;
use Illuminate\Database\Seeder;
use Faker\Factory;

class ListsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        $developers = Developer::all()->pluck('id')->toArray();
        $cities = City::all()->pluck('id')->toArray();

        for ($i = 0; $i < 25; $i++) {
            Listing::create([
                'price' => $faker->randomNumber(5),
                'name' => $faker->streetAddress                       ,
                'isOnSale' => mt_rand(0,1),
                'city_id' => $faker->randomElement($cities),
                'developer_id' => $faker->randomElement($developers),
            ]);
        }

    }
}
