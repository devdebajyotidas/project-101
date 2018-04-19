<?php

use Illuminate\Database\Seeder;
use App\Models\Account;
use Faker\Factory as Faker;

class AccountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,5) as $index) {

            Account::create([
                'about'=>$faker->text,
                'address'=>$faker->address,
                'city'=>$faker->city,
                'state'=>null,
                'country'=>$faker->country,
                'zip'=>$faker->randomDigit,
                'aadhaar'=>null,
                'photo'=>$faker->imageUrl($width = 200, $height = 200),
                'cover_photo'=>$faker->imageUrl($width = 200, $height = 200),
                'longitude'=>$faker->longitude,
                'latitude'=>$faker->latitude,
                'is_provider'=>1,
                'language'=>$faker->languageCode,
                'aadhaar_verified'=>0,
                'is_blocked'=>0
            ]);

        }
        foreach (range(1,5) as $index) {

            Account::create([
                'about'=>$faker->text,
                'address'=>$faker->address,
                'city'=>$faker->city,
                'state'=>null,
                'country'=>$faker->country,
                'zip'=>$faker->randomDigit,
                'aadhaar'=>null,
                'photo'=>$faker->imageUrl($width = 200, $height = 200),
                'cover_photo'=>$faker->imageUrl($width = 200, $height = 200),
                'longitude'=>$faker->longitude,
                'latitude'=>$faker->latitude,
                'is_provider'=>0,
                'language'=>$faker->languageCode,
                'aadhaar_verified'=>0,
                'is_blocked'=>0
            ]);

        }
    }
}
