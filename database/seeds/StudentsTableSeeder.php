<?php

use Illuminate\Database\Seeder;
use App\Students;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        dump('sb');
                    
        //年级1到6
        for($i = 1; $i <= 6; $i++)
        {
            //班级1到4
            for($j = 1; $j <= 4; $j++)
            {
                for($k = 0; $k < 10; $k++)
                {
                    Students::create([
                    'student_number' => str_random(5) . '0000' . $k,
                    'student_name' => str_random(5),
                    'classCode' => (2016 - $i) . '0' . $j,
                    ]);
                }
            }
        }
        
    }
}
