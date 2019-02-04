<?php

use App\Developer;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DevelopersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Developer::create([
                'name' => $faker->name,
            ]);
        }
    }
}
