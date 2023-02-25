<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\backend\School;
use App\Models\backend\SchoolBudget;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use DB;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class MarketingBudgetController extends Controller
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
        //$school = School::where('type',1)->get();
        //  $school = School::all();
        //  $school = School::where('established_date', '<=',session('year'))->get();
          $school = School::where(function ($query) {
            $query->where('established_date', '<=',session('year') )
                  ->orWhere('established_date', '=', null);
        })->where('type',1)->get();

        $schoolbudget = SchoolBudget::where('year', session('year'))->pluck('budget','school_id' )->toArray();
        return view('backend.marketingbudget.create_budget', compact('school','schoolbudget'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $budget = SchoolBudget::where('year', session('year'))->get();
    //   $school = School::select(
    //     DB::raw("CONCAT(school_name,' (',board_name,') ',' ',location) AS school_name"),'school_id')
    //     ->pluck('school_name', 'school_id');
         return view('backend.marketingbudget.create_budget', compact('school'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $schools = $request->school_id;

        for($i = 0; $i < sizeof($request->budget); $i++){
            if(isset($request->budget[$i])){
              $budget = str_replace(',','',$request->budget[$i]);
              $budget = str_replace('.00','',$budget);
              $budget = SchoolBudget::updateOrCreate(
                  ['year'=>$request->year[$i] , 'school_id'=>$request->school_id[$i]],
                  ['school_id'=>$request->school_id[$i],
                  'year'=>$request->year[$i],
                  'budget'=>$budget
                ]);
                $budget->save();

        }
      //  dd($schools);
    //   for($i = 0; $i <count($request->school_id); $i++){

    //     $budget = SchoolBudget::where('year',$request->year)
    //                             ->where('school_id', $request->school_id[$i])
    //                             ->first();

    //     if(!$budget){
    //         $school_budget = new SchoolBudget;
    //     }else{
    //         $school_budget = $budget;
    //     }

    //        $school_budget->school_id = $request->school_id[$i];
    //        $school_budget->year = $request->year[$i];
    //         $school_budget->budget = $request->budget[$i];
    //         $school_budget->save();
       }

      return redirect('admin/marketing')->with('success','Budget Has Been Created');
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
        for($i = 0; $i <count($request->school_budget_id); $i++){
            //   echo $school_id['0'][$i]."<br><br>";
               $school_budget =SchoolBudget::find($request->school_budget_id[$i]);
               $school_budget->budget = $request->budget[$i];
               $school_budget->save();
          }
          return redirect('admin/marketing')->with('success','Budget Has Been Created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */


}
