<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Term;

class TermTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $terms = array(
                ['term_code' => '20150', 'year' => '2015', 'season' => '0'],
                ['term_code' => '20151', 'year' => '2015', 'season' => '1'],
                ['term_code' => '20160', 'year' => '2016', 'season' => '0'],
                ['term_code' => '20161', 'year' => '2016', 'season' => '1'],
        );
        
        foreach ($terms as $term)
        {
            Term::create($term);
        }
    }
}
