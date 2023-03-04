<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class StudentAcademics extends Model

{
  //use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    use SoftDeletes;
    protected $table = 'student_academics';
    protected $primaryKey = 'student_acadmic_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'exam', 'school_board', 'score', 'result', 'year'
    ];


}
