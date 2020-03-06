<?php

use Illuminate\Database\Seeder;

class FriendshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('friendships')->insert([
        	'user_id' => 1,
            'recipient_id' => 2,
            'sender_id' => 1,
            'status' => 'confirmed',
        ]);
    	\DB::table('friendships')->insert([
        	'user_id' => 1,
            'recipient_id' => 4,
            'sender_id' => 1,
            'status' => 'pending',
        ]);
    	\DB::table('friendships')->insert([
        	'user_id' => 2,
            'recipient_id' => 4,
            'sender_id' => 2,
            'status' => 'pending',
        ]);
    	\DB::table('friendships')->insert([
        	'user_id' => 4,
            'recipient_id' => 3,
            'sender_id' => 4,
            'status' => 'confirmed',
        ]);
        \DB::table('friendships')->insert([
        	'user_id' => 1,
            'recipient_id' => 3,
            'sender_id' => 1,
            'status' => 'confirmed',
        ]);
    }
}
