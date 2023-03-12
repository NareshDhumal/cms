<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\DB;

class FeesCollection extends Model
{
     //use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fees_collection';
    protected $primaryKey = 'fees_collection_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
     'student_id', 'roll_no', 'amount', 'payment_method', 'reference_no', 'payment_date', 'is_online', 'transaction_id', 'status', 'is_cancelled', 'recieved_by', 'description'
    ];




}
