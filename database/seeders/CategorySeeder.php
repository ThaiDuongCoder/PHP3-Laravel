<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // thực hiện tạo nhiều bản ghi
        // tạo mảng rỗng để chứa dữ liệu
        $cateSeed = [];
        for ($i = 0; $i < 5; $i++) {
            $cateSeed[] = [
                'name' => fake()->name(),
                'description' => fake()->text(),
                'status' => fake()->randomElement(['active', 'inactive']),
            ];
        }
        DB::table('categories')->insert($cateSeed);
    }
}
