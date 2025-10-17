<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 30) as $index) {
            DB::table('clients')->insert([
                'fname' => $faker->firstName,
                'mname' => $faker->optional()->firstName,
                'lname' => $faker->lastName,
                'civil_status' => $faker->randomElement(['Single', 'Married', 'Widowed', 'Separated']),
                'occupation' => $faker->jobTitle,
                'birthdate' => $faker->date(),
                'contact' => $faker->phoneNumber,
                'gender' => $faker->randomElement(['Male', 'Female']),
                'address' => $faker->address,
                'educational_attainment' => $faker->randomElement(['High School', 'College', 'Vocational', 'Postgraduate']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
