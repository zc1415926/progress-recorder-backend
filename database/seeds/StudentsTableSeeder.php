<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 10; $i++)
        {
            DB::table('students')->insert([
            'student_number' => str_random(15),
            'student_name' => str_random(5),
            'student_password' => bcrypt('secret'),
            'student_entry_year' => mt_rand(2010, 2016),
            'student_grade' => mt_rand (1, 6),
            'student_class' => mt_rand (1, 14),
            ]);
        }
    }
}
