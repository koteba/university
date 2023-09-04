<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
$this->call([
        CollageSeeder::class,
        DepartmentSeeder::class,
        UserSeeder::class,
    ]);
    }
}
