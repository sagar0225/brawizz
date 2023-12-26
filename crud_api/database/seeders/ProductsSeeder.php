<?php

namespace Database\Seeders;
use App\Models\Crudapi;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Insert data into the table
         DB::table('products')->insert([
            'id' => 1,
            'name' => 'tv',
            'created_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'id' => 2,
            'name' => 'mobile',
            'created_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'id' => 3,
            'name' => 'laptop',
            'created_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'id' => 4,
            'name' => 'cellphone',
            'created_at' => Carbon::now(),
        ]);
        DB::table('products')->insert([
            'id' => 5,
            'name' => 'walkytalky',
            'created_at' => Carbon::now(),
        ]);
       

    }
}
