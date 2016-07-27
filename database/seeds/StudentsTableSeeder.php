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
        //年级1到6
        for($i = 1; $i <= 6; $i++)
        {
            //班级1到4
            for($j = 1; $j <= 4; $j++)
            {
                for($k = 0; $k < 10; $k++)
                {
                    DB::table('students')->insert([
                    'student_number' => str_random(5) . '0000' . $k,
                    'student_name' => str_random(5),
                    //'student_password' => bcrypt('secret'),
                    'student_entry_year' => 2015 - $i,
                    'student_grade' => $i,
                    'student_class' => $j,
                    ]);
                }
            }
        }
        
    }
}
