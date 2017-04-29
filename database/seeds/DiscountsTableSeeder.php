<?php

use Illuminate\Database\Seeder;

class DiscountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discounts')->insert([
            ['value' => 10.0],
            ['value' => 25.0],
            ['value' => 50.0],
            ['value' => 70.0],
        ]);
    }
}
