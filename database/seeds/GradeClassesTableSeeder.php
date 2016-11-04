<?php

use Illuminate\Database\Seeder;

class GradeClassesTableSeeder extends Seeder
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
                DB::table('gradeClasses')->insert([
                    //年和班的字符串连接成为班级代码
                    'classCode' => (2016 - $i) . '0' . $j,
                    'entryYear' => (2016 - $i),
                    'gradeNum' => $i,
                    'classNum' => $j
                ]);
            }
        }
    }
}
