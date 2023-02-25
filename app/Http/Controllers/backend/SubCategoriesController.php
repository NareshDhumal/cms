<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\backend\Categories;
use App\Models\backend\SubCategories;
use App\Models\backend\SubCategoryDetails;
use App\Models\backend\CategoryBudget;
use App\Models\backend\CategoryBudgetTrash;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class SubCategoriesController extends Controller
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
    public function index($id)
    {

        $subcategories = SubCategories::where('category_id', $id)->get();
        return view('backend.subcategories.index', compact('subcategories', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id)
    {
        return view('backend.subcategories.subcategory_create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'sub_category_name' => 'required',
            'visibility' => 'required',
        ]);

        $subcategories = new SubCategories();
        $subcategories->fill($request->all());
        if ($subcategories->save()) {

            //activity Log
            $log = ['module' => 'sub categories', 'action' => 'sub categories Created', 'description' => 'New sub categories Created : ' . $request->sub_category_name];
            captureActivity($log);

            return redirect('admin/subcategory/' . $request->category_id)->with('success', 'subcategory  Has Been Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        // $categories = Categories::findOrFail($id);

        // return view('backend.categories.show', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $subcategories = SubCategories::where('sub_category_id', $id)->first();
        return view('backend.subcategories.subcategory_edit', compact('subcategories', 'id'));
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
        $this->validate($request, [
            'sub_category_name' => ['required'],
        ]);
        $id = $request->input('sub_category_id');
        $subcategories = SubCategories::findOrFail($id);
        $original_cat = $subcategories->sub_category_name;
        $subcategories->fill($request->all());
        if ($subcategories->update()) {
            if ($subcategories->getChanges()) {
                // $upd = json_encode($school->getChanges());
                //activity Log
                $upd = $subcategories->getChanges();
                unset($upd['updated_at']);
                $str = ['module' => 'sub categories', 'action' => 'subcategories Update', 'description' => 'subcategories Details Updated : ' . $original_cat];
                captureActivityupdate($upd, $str);
            }
        }
        return redirect('admin/subcategory/' . $subcategories->category_id)->with('success', 'Subcategory Details Has Been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function delete($id)
    {
        $subcategories = SubCategories::findOrFail($id);

        $budget = SubCategories::where('sub_category_id', $id)->first();

        if($budget->sub_category_budget){
            $trash = new CategoryBudgetTrash ;
            $trash->fill($budget->sub_category_budget->toArray());
            $trash->save();
            $budget->sub_category_budget()->delete();
        }

        $budget_data = CategoryBudget::where('sub_category_id', $id)->get()->toArray();
       if(count($budget_data) > 0){
        foreach($budget_data as $bdata){
            $trash = new CategoryBudgetTrash;
            $trash->fill($bdata);
            $trash->save();

            CategoryBudget::where('category_budget_id', $bdata['category_budget_id'] )->delete();
            // dd();
        }
       }





        $category_id = $subcategories->category_id;
        if ($subcategories->delete()) {

            //activity log
            $dcat = '';

            if (isset($subcategories->sub_category_name)) {
                $dcat = $subcategories->sub_category_name;
            }
            $log = ['module' => 'sub categories', 'action' => 'sub categories Deleted', 'description' => 'sub categories deleted : sub category name  = ' . $subcategories->sub_category_name];
            captureActivity($log);
            //activity log

            return redirect('admin/subcategory/' . $category_id)->with('success', 'Subcategory Details Has Been Removed');
        }
    }
}
