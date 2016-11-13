<?php

use Illuminate\Database\Seeder;
use App\PerformanceScore;

class PerformanceScoreTableSeeder extends Seeder
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
                    $classCode = (2016 - $i) . '0' . $j;
                    PerformanceScore::create([
                        'delta_score' => rand(-10, 10),
                        'comment' => str_random(rand(10, 20)),
                        'student_number' => $classCode . '0' . $k
                    ]);
                }
            }
        }
    }
}
