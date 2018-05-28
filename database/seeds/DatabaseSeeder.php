<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create('en_US');

        $data['account']['about']=$faker->jobTitle;
        $data['account']['dob']=$faker->date('Y-m-d', 'now');
        $data['account']['address']=$faker->streetAddress;
        $data['account']['city']=$faker->city;
        $data['account']['state']=$faker->state;
        $data['account']['country']=$faker->country;
        $data['account']['zip']=$faker->postcode;
        $data['account']['photo']=$faker->imageUrl('480', '480', 'cats');

        $data['user']['name'] = $faker->name;
        $data['user']['email'] = 'admin@gmail.com';
        $data['user']['password'] = bcrypt('secret');
        $data['user']['mobile']=$faker->phoneNumber;
        $data['user']['verification_token']=md5(time());
        $data['user']['mobile_verified']=1;
        $data['user']['email_verified']=1;
        $data['user']['is_employee']=1;

        $account=\App\Models\Account::create($data['account']);
        $user=\Illuminate\Foundation\Auth\User::make($data['user']);
        $account->user()->save($user);
    }
}
