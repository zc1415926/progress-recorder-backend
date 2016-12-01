<?php

use Illuminate\Database\Seeder;
use App\Config;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = array(
                ['key' => 'current_term', 'value' => '20161'],
        );
        
        foreach ($items as $item)
        {
            Config::create($item);
        }
    }
}
