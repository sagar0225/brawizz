<?php

namespace Database\Seeders;

use App\Models\Crudapi;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert data into the table
        DB::table('tasks')->insert([
            'id' => 1,
            'name' => 'create data',
            'created_at' => Carbon::now(),
        ]);
        DB::table('tasks')->insert([
            'id' => 2,
            'name' => 'delete data',
            'created_at' => Carbon::now(),
        ]);
        DB::table('tasks')->insert([
            'id' => 3,
            'name' => 'read data',
            'created_at' => Carbon::now(),
        ]);
        DB::table('tasks')->insert([
            'id' => 4,
            'name' => 'update data',
            'created_at' => Carbon::now(),
        ]);
        DB::table('tasks')->insert([
            'id' => 5,
            'name' => 'testing data',
            'created_at' => Carbon::now(),
        ]);
    }
}
