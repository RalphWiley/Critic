<?php

use Illuminate\Database\Seeder;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('ratings')->insert([
        	'user_id' => 1,
            'title' => 'Misfits',
            'type' => 'tv',
            'genre' => 'Comedy / Drama',
            'rating' => 6.2,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
    	\DB::table('ratings')->insert([
        	'user_id' => 1,
        	'title' => 'Grinch',
            'type' => 'movie',
            'genre' => 'Comedy',
            'rating' => 5.9,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
    	\DB::table('ratings')->insert([
        	'user_id' => 2,
        	'title' => 'I Am Legend',
            'type' => 'book',
            'genre' => 'Horror',
            'rating' => 9.8,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
    	\DB::table('ratings')->insert([
        	'user_id' => 2,
        	'title' => 'The Way We Were',
            'type' => 'movie',
            'genre' => 'Drama',
            'rating' => 2.4,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
        \DB::table('ratings')->insert([
        	'user_id' => 1,
        	'title' => 'Misfits',
            'type' => 'tv',
            'genre' => 'Comedy / Drama',
            'rating' => 8.1,
        	'created_at' => NOW(),
        	'updated_at' => NOW()
        ]);
    }
}
