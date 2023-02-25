<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use DB;

use App\Models\backend\School;
use App\Models\backend\Boards;
use App\Models\backend\State;
use App\Models\backend\Expenses;
use App\Models\backend\Categories;
use App\Models\backend\SubCategories;
use App\Models\backend\SubCategoryDetails;
use App\Models\backend\Units;


class ExpenseController extends Controller
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
    public function index(){
        $year  = session('year');
        $expenses = Expenses::with('school')->where('mktg_year',$year)->get();
        return view('backend.expenses.index', compact('expenses'));
    }

    public function create()
    {
        $schools = collect(School::all())->mapWithKeys(function ($item, $key) {
            return [$item['school_id'] => $item['school_name']. (isset($item['board_name'])? ' ('.$item->board_name.')' : "").(isset($item['location'])? ' ('.$item->location.')' : "")   ];
          });
          $category = Categories::pluck('category_name','category_id');

       return view('backend.expenses.expenses_create',compact('schools','category'));
    }

    public function store(Request $request){
        // dd($request->all());
        $expense = new Expenses;
        $expense->fill($request->all());
       if($expense->save()){
        return redirect('/admin/expenses')->with('success', 'Expence Has Been Stored');
       }


    }

    public function edit($id){
        $expense = Expenses::where('mktg_expences_id',$id)->first();
        $schools = collect(School::all())->mapWithKeys(function ($item, $key) {
             return [$item['school_id'] => $item['school_name']. (isset($item['board_name'])? ' ('.$item->board_name.')' : "").(isset($item['location'])? ' ('.$item->location.')' : "")   ];
          });
          $category = Categories::pluck('category_name','category_id');
          $subategories = SubCategories::where('category_id',$expense->category_id)->pluck('sub_category_name','sub_category_id');
           $subcategory_details = SubCategoryDetails::where('sub_category_id',$expense->sub_category_id)->pluck('sub_category_details','sub_category_details_id');
            return view('backend.expenses.expenses_edit',compact('schools','expense','category','subategories','subcategory_details'));


    }
public function update(Request $request){

$expense = Expenses::where('mktg_expences_id', $request->mktg_expences_id)->first();
        $expense->fill($request->all());
       if($expense->save()){
        return redirect('/admin/expenses')->with('success', 'Expence Has Been Updated');
       }

}

public function delete($id){
    $data = Expenses::where('mktg_expences_id', $id)->get();
    if(count($data)!= 0){
        $delete =Expenses::where('mktg_expences_id', $id)->delete();
        if($delete){
            return redirect('/admin/expenses')->with('success', 'Record Has Been Removed');
           }else{
            return redirect('/admin/expenses')->with('error', 'Unable to Delete Expence record');
           }
    }
}

public function getSubCategory(Request $request)
{
    $subcategory = SubCategories::where('category_id', $request->cat_id)->pluck('sub_category_name','sub_category_id');
   echo "<option value=''>Select Sub Category </option>";
    if(count($subcategory) > 0)
   {
       foreach($subcategory as $key =>$value){
           echo "<option value=".$key.">".$value."</option>";
       }
   }

}

public function getSubCatDetails(Request $request){
  $details = SubCategoryDetails::where('sub_category_id', $request->sub_cat_id)->pluck('sub_category_details','sub_category_details_id');
  echo "<option value=''>Select Sub Category Details </option>";
   if(count($details) > 0)
  {
      foreach($details as $key =>$value){
          echo "<option value=".$key.">".$value."</option>";
      }
  }
}

public function getdetailsUnit(Request $request){
   // $details = SubCategoryDetails::with('units')->where('sub_category_details_id', $request->details_id)->get('units');
    $unit_ids = SubCategoryDetails::where('sub_category_details_id', $request->details_id)->first()->toArray();
    $ids  = explode(',',$unit_ids['unit']);
    $units = Units::whereIn('unit_id',$ids)->get('expence_unit')->toArray();
    print_r (json_encode($units));
}

public function getMonth(Request $request){
    echo date("F", strtotime($request->dt));
}

//
public function getMultipleSubCategory(Request $request)
{
    $subcategory = SubCategories::whereIn('category_id', $request->cat_id)->pluck('sub_category_name','sub_category_id');
   echo "<option value=''>Select Sub Category </option>";
    if(count($subcategory) > 0)
   {
       foreach($subcategory as $key =>$value){
           echo "<option value=".$key.">".$value."</option>";
       }
   }

}

public function getMultipleSubCatDetails(Request $request){
  $details = SubCategoryDetails::whereIn('sub_category_id', $request->sub_cat_id)->pluck('sub_category_details','sub_category_details_id');
  echo "<option value=''>Select Sub Category Details </option>";
   if(count($details) > 0)
  {
      foreach($details as $key =>$value){
          echo "<option value=".$key.">".$value."</option>";
      }
  }
}

} //end of class
