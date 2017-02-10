<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        //Model::unguard() does temporarily disable the mass assignment protection of the model, 
        //so you can seed all model properties.
        Model::unguard();

        DB::table('users')->delete();

        $users = array(
                ['name' => 'zc1415926', 'username' => 'zc1415926@126.com', 
                    'password' => Hash::make('secret'), 'role' => 'admin'],
                ['name' => 'Ryan Chenkie', 'username' => 'ryanchenkie@gmail.com', 
                    'password' => Hash::make('secret'), 'role' => 'teacher'],
                ['name' => 'Chris Sevilleja', 'username' => 'chris@scotch.io', 
                    'password' => Hash::make('secret'), 'role' => 'teacher'],
                ['name' => 'Holly Lloyd', 'username' => 'holly@scotch.io', 
                    'password' => Hash::make('secret'), 'role' => 'teacher'],
                ['name' => 'Adnan Kukic', 'username' => 'adnan@scotch.io', 
                    'password' => Hash::make('secret'), 'role' => 'teacher'],
        );
            
        // Loop through each user above and create the record for them in the database
        foreach ($users as $user)
        {
            User::create($user);
        }
        
        //年级1到6
        for($i = 1; $i <= 6; $i++)
        {
            //班级1到4
            for($j = 1; $j <= 4; $j++)
            {
                for($k = 0; $k < 10; $k++)
                {
                    $classCode = (2016 - $i) . '0' . $j;
                    User::create([
                        'name' => str_random(5),
                        'username' => $classCode . '0' . $k,
                        'password' => Hash::make('secret'),
                        'role' => 'student'
                    ]);
                }
            }
        }

        Model::reguard();
    }
}