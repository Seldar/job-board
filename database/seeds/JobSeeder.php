<?php

use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobs')->truncate();

        DB::table('jobs')->insert([
            'title' => str_random(10),
            'description' => str_random(50),
            'poster_id' => 1,
        ]);

        DB::table('jobs')->insert([
            'title' => str_random(10),
            'description' => str_random(50),
            'poster_id' => 2,
        ]);

        DB::table('jobs')->insert([
            'title' => str_random(10),
            'description' => str_random(50),
            'poster_id' => 2,
        ]);

        DB::table('jobs')->insert([
            'title' => str_random(10),
            'description' => str_random(50),
            'poster_id' => 2,
        ]);

        DB::table('jobs')->insert([
            'title' => str_random(10),
            'description' => str_random(50),
            'poster_id' => 2,
        ]);

        DB::table('jobs')->insert([
            'title' => str_random(10),
            'description' => str_random(50),
            'poster_id' => 2,
        ]);

        DB::table('jobs')->insert([
            'title' => str_random(10),
            'description' => str_random(50),
            'poster_id' => 3,
        ]);

        DB::table('jobs')->insert([
            'title' => str_random(10),
            'description' => str_random(50),
            'poster_id' => 4,
        ]);

    }
}
