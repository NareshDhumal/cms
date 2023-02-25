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
use App\Models\backend\SchoolBudget;
use App\Models\backend\Years;

class ReportsController extends Controller
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
        dd("hii reports index");
    }

    public function summaryReport()
    {
        $year = session('year');
        $school = School::where('established_date', '<=', session('year'))->with('budget', function ($q) {
            $q->where('year', '=', session('year'));
        })->get();


        $marketing = DB::table('mktg_expences')
            ->selectRaw('sum(amount) as amount, school_id')
            ->where('mktg_year',  session('year'))
            ->groupBy('school_id')->get();
        return view('backend.report.summary_report', compact('school', 'marketing'));
    }

    public function budgetReport()
    {
        $old_school = School::where('type', '1')->where('established_date', '<=', session('year'))->get();
        $new_school = School::with('budget_report_school')->where('type', '1')->where('established_date', '=', session('year'))->get();

        //Required variables
        $old_school_id = array();
        $new_school_id = array();
        $old_school_budget = 0;
        $new_school_budget = 0;

        $old_school_utilization = 0;
        $new_school_utilization = 0;

        /** array to big elequent relation giver issues
         * saparate id from array pass these array with raw query to fetch details
         *
         */

        //filter school id from array which are present in database
        foreach ($old_school as $school) {
            array_push($old_school_id, $school->school_id);
        }

        //New School budget if present
        if (count($new_school) > 0) {
            foreach ($new_school as $school) {
                array_push($new_school_id, $school->school_id);
            }
            //New  School Budget
            $new_budget = DB::table('school_budget')->selectRaw("SUM(budget) as budget")->whereIN('school_id', $new_school_id)->where('year', session('year'))->get()->toArray();
            $new_school_budget = $new_budget[0]->budget;

            //new school expence Utilization
            $new_school_utilize = DB::table('mktg_expences')->selectRaw("SUM(amount) as amount")->whereIN('school_id', $new_school_id)->where('mktg_year', session('year'))->get()->toArray();
            $new_school_utilization = $new_school_utilize[0]->amount;
        }

        //old school total budget
        $old_budget = DB::table('school_budget')->selectRaw("SUM(budget) as budget")
            ->whereIN('school_id', $old_school_id)
            ->where('year', session('year'))->get()->toArray();
        $old_school_budget = $old_budget[0]->budget;

        $old_school_utilize = DB::table('mktg_expences')->selectRaw("SUM(amount) as amount")->whereIN('school_id', $old_school_id)->where('mktg_year', session('year'))->get()->toArray();
        $old_school_utilization = $old_school_utilize[0]->amount;

        // fetch data of categoires who are active

        //send data to view
        // $budget = Categories::with('budget_report_subcategories')->where('include_budget', '1')->get();




        //test code start
        //$categories = Categories::with('budget_report_subcategories')->where('include_budget', 1)->get()->toArray();

        // category and its budget
        // $categories = Categories::with('category_budget','budget_report_subcategories')->where('include_budget', 1)->get();
        $budget = Categories::with('category_budget', 'budget_report_subcategories')->where('include_budget', 1)->get();
        //test code End
        // dd($budget->toArray());


        return view('backend.report.budget_report', compact('old_school', 'new_school', 'budget', 'old_school_budget', 'new_school_budget', 'old_school_utilization', 'new_school_utilization'));
        //return view('backend.report.tmp_view', compact('categories'));
    }


    public function detailsReport()
    {
        $categories = Categories::pluck('category_name', 'category_id');
        $years = Years::pluck('year', 'year');
        return view('backend.report.details_report', compact('categories', 'years'));
    }

    //get report
    public function getdetailsReport(Request $request)
    {


        //table head
        $srno = 1;
            echo "<table class='table table-bordered table-striped table-css master-table w-100 header' id='report_table' style='white-space: nowrap;'><thead><tr>";
            echo "<th>Sr No.</th>";
            echo "<th>School Name</th>";
            echo "<th>Category</th>";
            foreach ($request->mktg_year as $year_num) {
                echo "<td>" . $year_num . "</td>";
            }
            echo "</tr></thead><tbody>";

        if ($request->in_group == 1) {
            dd('display in group');
        } else {
            //$year = $request->mktg_year;
            $category = $request->category_id;
            if (isset($request->sub_category_details_id) && ($request->sub_category_details_id != null && $request->sub_category_details_id != 0)) {
                $expenses = Expenses::with('expense_category', 'expense_sub_category', 'expense_sub_category_details', 'school')->whereIN('mktg_year', $request->mktg_year)
                    ->whereIN('sub_category_details_id', $request->sub_category_details_id)
                    ->orderBy('category_id', 'ASC')->orderBy('sub_category_id', 'ASC')->orderBy('sub_category_details_id', 'ASC')->get();
            } else if (isset($request->sub_category_id) && $request->sub_category_id != "" && $request->sub_category_details_id == "") {
                $expenses = Expenses::with('expense_category', 'expense_sub_category', 'expense_sub_category_details', 'school')->whereIN('mktg_year', $request->mktg_year)
                    ->whereIN('sub_category_id', $request->sub_category_id)
                    ->orderBy('category_id', 'ASC')->orderBy('sub_category_id', 'ASC')->orderBy('sub_category_details_id', 'ASC')->get();
            } else if (isset($request->category_id) && $request->category_id != "" && $request->sub_category_id == "") {
                //  $expenses = Expenses::with('expense_category', 'expense_sub_category', 'expense_sub_category_details', 'school')->whereIN('mktg_year', $request->mktg_year)
                //  ->whereIN('category_id', $request->category_id)->distinct('school_id')->get();
                //   ->whereIN('category_id', $request->category_id)->get('school_id','mktg_year','category_id','subcategory_id','sub_category_details_id','amount')->groupBy('school_id');
                // $data = Expenses::select('school_id','mktg_year', 'category_id', 'sub_category_id', 'sub_category_details_id','amount')->whereIN('category_id', $request->category_id)->whereIN('mktg_year', $request->mktg_year)->get();
                // $data = DB::table('mktg_expences')->distinct('school_id')->get('school_id');
                $year = $request->mktg_year;
                //dd($request->mktg_year);
                $category = $request->category_id;
                $year1 = implode("','", $request->mktg_year);
                $category1 = implode("','", $request->category_id);
                // ++ $results = DB::select( DB::raw("SELECT distinct(school_id) FROM mktg_expences where mktg_year in ('2021-22','2023-24')") );
                $results = DB::select(DB::raw("SELECT distinct(school_id) FROM mktg_expences where mktg_year in ('" . $year1 . "') and category_id in ('" . $category1 . "') order by 1 asc"));
            }
            //  dd($results);


            $ind = 0;
            foreach ($results as $school_ids) {
                $school = School::where('school_id', $school_ids->school_id)->first();
                $exp_category = DB::select(DB::raw("SELECT distinct(category_id) FROM mktg_expences where school_id = $school_ids->school_id"));
                foreach ($exp_category as $cat) {
                    echo "<tr>";
                    echo "<td></td>";
                    echo "<td>" . $school->school_name . " (" . $school->board_name . ") " . $school->location . "</td>";
                    $cat_name = Categories::where('category_id', $cat->category_id)->first();

                    // echo "<td>".$cat->category_id."</td>";
                    // echo "<td>".print_r($cat_name->category_name[0])."</td>";
                    echo "<td>";
                    if (isset($cat_name['category_name'])) {
                        echo $cat_name['category_name'];
                    }
                    echo "</td>";
                    foreach ($year as $year_num) {
                        $data = Expenses::where('category_id', '=', $cat->category_id)->where('mktg_year', $year_num)->where('school_id', $school_ids->school_id)->sum('amount');
                        echo "<td>" . $data . "</td>";  //")".$year_num.
                    }
                    echo "</tr>";
                }
            }
            echo "<tr>";
            echo "<td>Total</td>";
            echo "<td></td>";
            echo "<td></td>";
            foreach ($year as $year_num) {
                $sum = DB::select(DB::raw("SELECT sum(amount) as total FROM mktg_expences where category_id in ('" . $category1 . "') and mktg_year = '" . $year_num . "' "));
                echo "<td>" . $sum[0]->total . "</td>";
                //")".$year_num.
            }
            echo "</tr>";
        } // end of else



    } //end of function

} //end of class




//trash code

// $expences = Expenses::with('school','expense_category')->where('school_id', $school_ids->school_id)->get();
//               dd($expences->toArray());
//            foreach($expences as $data){
//             echo "<tr>";
//             echo "<td>".$data[$ind]->mktg_year."</td>";
//             //echo "<td>".$data[$ind]->school->school_id.$data[$ind]->school->school_name." (".$data[$ind]->school->board_name.") ".$data->school->location." </td>";

//             echo "</tr>";
//            }



///end of trash code
