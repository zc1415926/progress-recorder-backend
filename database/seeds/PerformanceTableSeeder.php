<?php

use Illuminate\Database\Seeder;
use App\Performance;

class PerformanceTableSeeder extends Seeder
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
                    $termCodeArray = ['20150', '20151', '20160', '20161'];
                    
                    foreach($termCodeArray as $termCode){
                        
                        //give a student 1 to 4 record randomly
                        $recordCount = rand(1, 4);
                        
                        for($l = 0; $l < $recordCount; $l++)
                        {
                            Performance::create([
                                'delta_score' => rand(-10, 10),
                                'comment' => str_random(rand(5, 20)),
                                'student_number' => $classCode . '0' . $k,
                                'term_code' => $termCode
                            ]);
                        }
                    }
                    
                    
                }
            }
        }
    }
}
