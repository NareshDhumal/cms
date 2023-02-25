<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class StudentAdmissions extends Model

{
  //use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    use SoftDeletes;
    protected $table = 'student_admissions';
    protected $primaryKey = 'student_admission_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 'year_id', 'batch_id', 'fees', 'total_fees', 'inserted_by', 'status'
    ];

    public function academic_years(){
        return $this->hasOne(AcademicYears::class, 'academic_year_id','year_id');
    }

    public function batches(){
        return $this->hasOne(Batches::class,'batch_id','batch_id');
    }


}
