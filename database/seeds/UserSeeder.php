<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'{"en":"admin","ar":"الأدمن"}',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'phone' => '123456789',
            'user_type' => 1,
        ]);
        DB::table('users')->insert([
            'name'=>'{"en":"teacher","ar":"مدرس"}',
            'email' => 'teacher@teacher.com',
            'password' => Hash::make('password'),
            'phone' => '123456789',
            'department_id' => '1',
            'user_type' => 3,
            'specification'=>'{"en":"programming","ar":"برمجيات"}',
        ]);
        DB::table('users')->insert([
            'name'=>'{"en":"teacher2","ar":"2مدرس"}',
            'email' => 'teacher2@teacher.com',
            'password' => Hash::make('password'),
            'phone' => '123456789',
            'department_id' => '1',
            'user_type' => 4,
            'specification'=>'{"en":"communication","ar":"الاتصالات"}',
        ]);
        DB::table('users')->insert([
            'name'=>'{"en":"teacher3","ar":"مدرس3"}',
            'email' => 'teacher3@teacher.com',
            'password' => Hash::make('password'),
            'phone' => '123456789',
            'department_id' => '2',
            'user_type' => 7,
            'specification'=>'{"en":"communication","ar":"الاتصالات"}',
        ]);
        DB::table('users')->insert([
            'name'=>'{"en":"student1","ar":"طالب1"}',
            'email' => 'student@student.com',
            'password' => Hash::make('password'),
            'phone' => '123456789',
            'user_type' => 5,
            'department_id' => '1',
            'year' => '1',
        ]);
        DB::table('users')->insert([
            'name'=>'{"en":"student2","ar":"طالب2"}',
            'email' => 'student2@student.com',
            'password' => Hash::make('password'),
            'phone' => '123456789',
            'user_type' => 5,
            'department_id' => '3',
            'year' => '2',

        ]);
    }
}
