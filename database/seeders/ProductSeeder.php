<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //tạo mảng chứa tất cả id của bảng categories
        $categoryID = DB::table('categories')->pluck('id')->toArray();

        $proSeed = [];
        for ($i = 0; $i < 5; $i++) {
            $proSeed[] = [
                'name' => fake()->name(),
                'description' => fake()->text(),
                'price' => fake()->randomFloat(2, 1, 9999),
                'stock' => fake()->randomNumber(),
                'image' => fake()->image(),
                'category_id' => fake()->numberBetween(1, 2),
                'status' => fake()->randomElement(['available', 'out_of_stock', 'hidden']),
            ];
        }
        DB::table('products')->insert($proSeed);
    }
}
