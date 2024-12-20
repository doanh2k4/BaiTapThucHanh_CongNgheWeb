<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class IssuesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $computerIds = DB::table('computers')->pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            DB::table('issues')->insert([
                'computer_id' => $faker->randomElement($computerIds),
                'reported_by' => $faker->name,
                'reported_date' => $faker->dateTimeBetween('-1 year', 'now'),
                'description' => $faker->sentence(20),
                'urgency' => $faker->randomElement(['Low', 'Medium', 'High']),
                'status' => $faker->randomElement(['Open', 'In Progress', 'Resolved']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
