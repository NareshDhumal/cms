<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class SubCategoryDetails extends Model
{
//   use Sluggable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sub_category_details';
    protected $primaryKey = 'sub_category_details_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['sub_category_details_id', 'sub_category_id', 'sub_category_details', 'visibility','unit','include_budget', 'include_summary'];

    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    // public function sluggable()
    // {
    //     return [
    //         'sub_category_slug' => [
    //             'source' => 'subcategory_name',
    //             'onUpdate'=>true
    //         ]
    //     ];
    // }
    public function subcategory(){
        return $this::belongsTo(SubCategories::class , 'sub_category_id','sub_category_id');
    }

    public function units(){
        return $this::HasMany(Units::class, 'unit_id','unit');
    }

    public function budget_subcategorydetails_budget(){
        return $this->hasMany(CategoryBudget::class, 'sub_category_details_id','sub_category_details_id');
    }

    public function sub_category_details_budget(){
        return $this->hasOne(CategoryBudget::class, 'sub_category_details_id' ,'sub_category_details_id')->where('year', session('year'));  ///->where('sub_category_id' , '')
    }


}
