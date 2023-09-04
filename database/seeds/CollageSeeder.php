<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('collages')->insert([
            'name'=>'{"en":"MEE","ar":"الهمك"}',
        ]);
        DB::table('collages')->insert([
            'name'=>'{"en":"civil","ar":"المدنية"}',
        ]);
    }
}
