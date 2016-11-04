<?php

use Illuminate\Database\Seeder;

class PosterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posters')->truncate();

        DB::table('posters')->insert([
            'email' => str_random(10) . "@gmail.com",
            'approved' => 0,
            'spam' => 0,
        ]);

        DB::table('posters')->insert([
            'email' => "test@gmail.com",
            'approved' => 1,
            'spam' => 0,
        ]);

        DB::table('posters')->insert([
            'email' => str_random(10) . "@gmail.com",
            'approved' => 0,
            'spam' => 1,
        ]);

        DB::table('posters')->insert([
            'email' => str_random(10) . "@gmail.com",
            'approved' => 1,
            'spam' => 1,
        ]);
    }
}
