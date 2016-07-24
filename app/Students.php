<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $fillable = ['student_number', 
    'student_name', 
    //'student_password', 
    'student_entry_year', 
    'student_grade', 
    'student_class'];
}
