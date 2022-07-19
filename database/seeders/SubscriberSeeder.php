<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 6; $i++) { 
            DB::table('subscribers')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
	        ]);

    }
}
}
