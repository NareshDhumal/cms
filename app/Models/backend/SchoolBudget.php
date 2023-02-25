<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\DB;

class SchoolBudget extends Model
{
    // use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'school_budget';
    protected $primaryKey = 'school_budget_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['school_id', 'academic_year', 'budget', 'year'];

    public function school(){
        return $this->hasOne(School::class,'school_id','school_id');
    }

    public function getBudgetAttribute($value){
        return $value.'.00';
    }

}
