<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Students extends Model

{
  //use Sluggable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    use SoftDeletes;
    protected $table = 'students';
    protected $primaryKey = 'student_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_name', 'father_name', 'mother_name', 'address', 'gender', 'mobile_no', 'parents_mobile_no','email', 'father_occupation', 'mother_occupation', 'date_of_birth', 'income', 'previous_school', 'last_exam', 'last_year_percentage', 'picture', 'status'
    ];

    // get student admissions relation for class and students
    public function admissions(){
        return $this->hasmany(StudentAdmissions::class, 'student_id','student_id')->with('academic_years','batches');
    }
}
