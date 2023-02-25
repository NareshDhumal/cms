<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Batches extends Model

{
  //use Sluggable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    use SoftDeletes;
    protected $table = 'batches';
    protected $primaryKey = 'batch_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'batch_name', 'full_fees', 'fees', 'teaching_rate', 'status'
    ];


    public function subjects(){
        return $this->hasMany(Subjects::class,'batch_id','batch_id');
    }
}
