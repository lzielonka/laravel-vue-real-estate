<?php

use App\Models\City;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 15; $i++) {
            City::create([
                'name' => $faker->city,
                'country' => $faker->country,
            ]);
        }
    }
}
