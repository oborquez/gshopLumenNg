<?php

use Illuminate\Database\Seeder;
use App\Categories;
use Faker\Factory as Faker;


class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $total = 30; 
        for ($x=0; $x<=$total; $x++){
            $faker = Faker::create();
            $category = Categories::inRandomOrder()->first();
            DB::table('products')->insert([
                'name' => $faker->sentence,
                'category_id' =>$category->id,
                'description' => $faker->sentence,
                'price' => 9.99
                ]);
        }
    }
}
