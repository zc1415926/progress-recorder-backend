<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
dump('sb');

        $this->call(GradeClassesTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(PerformanceTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TermTableSeeder::class);
        Model::reguard();
    }
}
