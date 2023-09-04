<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('departments')->insert([
            'name'=>'{"en":"Communications","ar":"الاتصالات"}',
            'collage_id' => 1,
            'years' => '5',
        ]);
        DB::table('departments')->insert([
            'name'=>'{"en":"Computers","ar":"الحاسبات"}',
            'collage_id' => 1,
            'years' => '5',
        ]);
        DB::table('departments')->insert([
            'name'=>'{"en":"Networks","ar":"الشبكات"}',
            'collage_id' => 2,
            'years' => '5',
        ]);
        DB::table('departments')->insert([
            'name'=>'{"en":"Programming","ar":"البرمجيات"}',
            'collage_id' => 2,
            'years' => '5',
        ]);
    }
}
