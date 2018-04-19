<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use Faker\Factory as Faker;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1,10) as $key=>$index) {

            User::create([
                'name' => $faker->firstNameMale,
                'mobile'=>$faker->phoneNumber,
                'email' => $faker->email,
                'account_id'=>$key,
                'account_type'=>'App\Models\Account',
                'password' => bcrypt('secret'),
            ]);

        }
    }
}
