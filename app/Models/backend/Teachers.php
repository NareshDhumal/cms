<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Teachers extends Model

{
  //use Sluggable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    use SoftDeletes;
    protected $table = 'teachers';
    protected $primaryKey = 'teacher_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'mobile', 'dob', 'gender', 'edu_details', 'address', 'picture', 'resume', 'status'
    ];

    public function education(){
        return $this->hasMany(TeacherEducation::class, 'teacher_id','teacher_id');
    }

    public function documents(){
        return $this->hasMany(TeacherDocuments::class, 'teacher_id','teacher_id');
    }
}
