<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('websites')->insert([
                ['name' => Str::random(6),
                'subscriber_id' => 2
            ],
               [ 'name' => Str::random(6),
                'subscriber_id' => 1
        ],
        [
                'name' => Str::random(6),
                'subscriber_id' => 4
            ],
            [
                'name' => Str::random(6),
                'subcriber_id' => 3
	        ],
            [
            'name' => Str::random(6),
                'subscriber_id' => 6
	        ],
[                'name' => Str::random(6),
                'subscriber_id' => 5
	        ]
        ]);
    }

}