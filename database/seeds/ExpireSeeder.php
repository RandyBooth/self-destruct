<?php

use App\Expire;
use Illuminate\Database\Seeder;

class ExpireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Expire::create([
            'name' => '1 hour',
            'hour' => 1,
        ]);

        Expire::create([
            'name' => '1 day',
            'hour' => 24,
        ]);

        Expire::create([
            'name' => '3 days',
            'hour' => 72,
        ]);

        Expire::create([
            'name' => '7 days',
            'hour' => 168,
        ]);

        Expire::create([
            'name' => '14 days',
            'hour' => 336,
        ]);

        Expire::create([
            'name' => '30 days',
            'hour' => 720,
        ]);
    }
}
