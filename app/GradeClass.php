<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradeClass extends Model
{
    protected $table = 'gradeClasses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['classCode', 'entryYear', 'gradeNum', 'classNum'];
}
