<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\backend\SubCategories;
use App\Models\backend\SubCategoryDetails;
use App\Models\backend\Units;
use App\Models\backend\CategoryBudget;
use App\Models\backend\CategoryBudgetTrash;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class SubCategorydetailsController extends Controller
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

            // $id => subcategory id
            $cat_id = 0;
         $details = SubCategoryDetails::with('subcategory')->where('sub_category_id',$id)->get();
         $subcat = SubCategories::where('sub_category_id', $id)->first('category_id');
         $cat_id = $subcat->category_id;

         return view('backend.subcategorydetails.index', compact('details', 'id', 'cat_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id,$cat_id)
    {
        $units = Units::pluck('expence_unit','unit_id');
        // $details_id = SubCategoryDetails::where('sub_category_id',$id)->first('sub_category_id');
        // dd($details_id->toArray());
        return view('backend.subcategorydetails.subcategorydetals_create', compact('id','cat_id','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

      $this->validate($request, [
        'sub_category_details' => 'required',
        'visibility' => 'required',
      ]);

    //    if($request->unit != null || $request->unit !=""){
       if($request->units != null){
        $units = implode(',', $request->units);
       }else{
        $units =  $request->units;
       }

      $form_data = $request->all();
      $form_data['unit']= $units;

       $details = new SubCategoryDetails();
       $details->fill($form_data);
      if($details->save())
      {

        //activity Log
    $log = ['module'=>'sub category details', 'action' =>'sub category details Created' , 'description'=> 'New sub category details Created : '.$request->sub_category_details];
    captureActivity($log);

        return redirect('admin/subcategorydetails/'.$request->sub_category_id)->with('success', 'Subcategory Details Has Been Added');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    // public function show($id)
    // {
    //     // $categories = Categories::findOrFail($id);

    //     // return view('backend.categories.show', compact('categories'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id, $cat_id, $sub_cat_id=0)
    {
        $units = Units::pluck('expence_unit','unit_id');
        $details = SubCategoryDetails::where('sub_category_details_id',$id)->first();
        return view('backend.subcategorydetails.subcategorydetals_edit', compact('details','id','cat_id','sub_cat_id','units'));
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
        'sub_category_details' => ['required'],
        'visibility' => ['required'],
      ]);
      if($request->units != null){
        $units = implode(',', $request->units);
       }else{
        $units =  $request->units;
       }
     // $units = implode(',', $request->unit);
      $form_data = $request->all();
      $form_data['unit']= $units;

       $id = $request->input('sub_category_details_id');
       $details = SubCategoryDetails::findOrFail($id);
       $original_cat = $details->sub_category_details;
       $details->fill($form_data);
      if($details->update())
      {

        if($details->getChanges()){

            //activity Log
            $upd = $details->getChanges();
            unset($upd['updated_at']);
            $str = ['module'=>'sub categories details', 'action' =>'sub categories details Update' , 'description'=> 'sub categories Details Updated : '.$original_cat];
            captureActivityupdate($upd , $str);
          }

        return redirect('admin/subcategorydetails/'.$details->sub_category_id)->with('success', 'Subcategory Details Has Been updated');
      }
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
        $detaiils = SubCategoryDetails::findOrFail($id);

        $budget = SubCategoryDetails::where('sub_category_details_id', $id)->first();

        if($budget->sub_category_details_budget){
            $trash = new CategoryBudgetTrash ;
            $trash->fill($budget->sub_category_details_budget->toArray());
            $trash->save();
            $budget->sub_category_details_budget()->delete();
        }


        $budget_data = CategoryBudget::where('sub_category_details_id', $id)->get()->toArray();
        if(count($budget_data) > 0){
         foreach($budget_data as $bdata){
             $trash = new CategoryBudgetTrash;
             $trash->fill($bdata);
             $trash->save();

             CategoryBudget::where('category_budget_id', $bdata['category_budget_id'] )->delete();
             // dd();
         }
        }


        // $budget = SubCategoryDetails::where('sub_category_details_id', $id)->first();
        // $budget->sub_category_details_budget()->delete();


        $sub_category_id = $detaiils->sub_category_id;
        if($detaiils->delete()){

            //activity log
$dcat = '';

if(isset($detaiils->sub_category_details)){
    $dcat = $detaiils->sub_category_details;
}
$log = ['module'=>'sub categories', 'action' =>'sub categories Deleted' , 'description'=> 'sub categories deleted : sub category name  = '.$detaiils->sub_category_details];
captureActivity($log);
//activity log

            return redirect('admin/subcategorydetails/'.$sub_category_id)->with('success', 'Subcategory Details Has Been Removed');
        }
    }

}
