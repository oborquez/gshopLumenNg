<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;


class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array("Caps","T-Shirts","Sunglasses","Gloves","Souvenirs");
        foreach($categories as $category)
        {
            $faker = Faker::create();
            DB::table('categories')->insert([
                'name' => $category,
                'description' => $faker->text
            ]);
        }
    }
}
