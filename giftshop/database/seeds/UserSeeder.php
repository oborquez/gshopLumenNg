<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('user')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'level' => 2,
            'api_token' => Str::random(60)
        ]);

        DB::table('user')->insert([
            'name' => 'Registered User 1',
            'email' => 'user1@gmail.com',
            'password' => Hash::make('user1'),
            'level' => 1,
            'api_token' => Str::random(60)
        ]);

        DB::table('user')->insert([
            'name' => 'Registered User 2',
            'email' => 'user2@gmail.com',
            'password' => Hash::make('user2'),
            'level' => 1,
            'api_token' => Str::random(60)
        ]);

        /*    
        $total_users = 20; 
        for ($x=0; $x<=$total_users; $x++){
        $faker = Faker::create();
            DB::table('user')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make($faker->password),
                'level' => 1,
                'api_token' => Str::random(60)
            
            ]);
        }   */ 


    }
}
