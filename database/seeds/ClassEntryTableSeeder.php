<?php

use Illuminate\Database\Seeder;

class ClassEntryTableSeeder extends Seeder
{
    /**
     * 生成1到6年级，每个年级4个班
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
                DB::table('classEntry')->insert([
                    'classCode' => (date("Y") - 1 - $i) . '0' . $j,
                    'entryYear' => (date("Y") - 1 - $i),
                    'gradeNum' => $i,
                    'classNum' => $j
                ]);
            }
        }
    }
}
