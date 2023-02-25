<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\backend\School;
use App\Models\backend\SchoolBudget;
use App\Models\backend\Categories;
use App\Models\backend\SubCategories;
use App\Models\backend\SubCategoryDetails;
use App\Models\backend\CategoryBudget;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use DB;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class CategoryBudgetController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth:admin');
  }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

       $data = Categories::with('budget_subcategories')->get();
    //    dd(session('year'));
       $budgetCategory = CategoryBudget::where('year',session('year'))->get();
        // dd($budgetCategory->toArray());
       return view('backend.category_expenses.index', compact('data','budgetCategory'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $year = session('year');
        for($i=0; $i< count($request->category_id); $i++){
            $budget = CategoryBudget::updateOrCreate(
                ['year'=>$year,
                 'category_id'=>$request->category_id[$i],
                 'sub_category_id'=> $request->sub_category_id[$i],
                 'sub_category_details_id'=> $request->sub_category_details_id[$i]
                ],
                [ 'year'=>$year,
                'category_id'=>$request->category_id[$i],
                'sub_category_id'=> $request->sub_category_id[$i],
                'sub_category_details_id'=> $request->sub_category_details_id[$i],
                'budget'=>$request->budget[$i]
            ]);
              $budget->save();

        }
        return redirect('admin/marketing/category')->with('success','Category Budget Has Been Created');


    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */


}
