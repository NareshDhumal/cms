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
        $expenses = array();
        if($request->in_group == 1){
            dd('display in group');
        }else{
            if (isset($request->sub_category_details_id) && ($request->sub_category_details_id != null && $request->sub_category_details_id != 0))
        {
            $expenses = Expenses::with('expense_category','expense_sub_category', 'expense_sub_category_details', 'school')->whereIN('mktg_year', $request->mktg_year)
                ->whereIN('sub_category_details_id', $request->sub_category_details_id)
                ->orderBy('category_id', 'ASC')->orderBy('sub_category_id', 'ASC')->orderBy('sub_category_details_id', 'ASC')->get();
        }
        else if (isset($request->sub_category_id) && $request->sub_category_id != "" && $request->sub_category_details_id == "")
        {
            $expenses = Expenses::with('expense_category','expense_sub_category', 'expense_sub_category_details', 'school')->whereIN('mktg_year', $request->mktg_year)
                ->whereIN('sub_category_id', $request->sub_category_id)
                ->orderBy('category_id', 'ASC')->orderBy('sub_category_id', 'ASC')->orderBy('sub_category_details_id', 'ASC')->get();
        }
        else if (isset($request->category_id) && $request->category_id != "" && $request->sub_category_id == "")
        {
            $expenses = Expenses::with('expense_category','expense_sub_category', 'expense_sub_category_details', 'school')->whereIN('mktg_year', $request->mktg_year)
                ->whereIN('category_id', $request->category_id)->orderBy('category_id', 'ASC')->orderBy('sub_category_id', 'ASC')->orderBy('sub_category_details_id', 'ASC')->get();

        }
        }
        //  dd($request->all());


        $srno = 1;
        echo "<table class='table table-bordered table-striped table-css master-table w-100 header' id='report_table' style='white-space: nowrap;'><thead><tr>";
        echo "<th>Sr No.</th>";
        // echo "<th>School Name</th>";

        echo "<th>Category</th>";
        echo "<th>Sub Category</th>";
        echo "<th>Sub Category Details</th>";
        echo "<th>Marketing Year</th>";
        echo "<th>Amount</th>";
        echo "</tr></thead><tbody>";
        foreach ($expenses as $data) {
            echo "<tr>";
            echo "<td>" . $srno . "</td>";
            // if (isset($data->school->school_name)) {
            //     echo "<td>" . $data->school->school_name . " (" . $data->school->board_name . ") " . $data->school->location . "</td>";
            // }


            /** check for category**/
            if (isset($data->expense_category->category_name))
                echo "<td>" . $data->expense_category->category_name . "</td>";

            /** Sub Category Data **/
            if (isset($data->expense_sub_category)) {
                if (isset($data->expense_sub_category->sub_category_name)) {
                    echo "<td>" . $data->expense_sub_category->sub_category_name . "</td>";
                }
            } else {
                echo "<td>--</td>";
            }

            /** Sub category Deatails**/
            if(isset($data->expense_sub_category_details)){
                if(isset($data->expense_sub_category_details->sub_category_details))
                {
                    echo "<td>".$data->expense_sub_category_details->sub_category_details."</td>";
                }
            }else{
                echo "<td>--</td>";
            }
            echo "<td>" . $data->mktg_year . "</td>";
            echo "<td>".$data->amount."</td>";

            echo "</tr>";
            $srno++;
        } //end of foreach loop
        echo "<tbody></table>";

    }


    //report function code backup()
    /**
     *  public function getdetailsReport(Request $request)
      *  {
       * $expenses = array();
       * if (isset($request->sub_category_details_id) && ($request->sub_category_details_id != null && $request->sub_category_details_id != 0))
       * {
       *     $expenses = Expenses::with('expense_category','expense_sub_category', 'expense_sub_category_details', 'school')->where('mktg_year', $request->mktg_year)
       *         ->where('sub_category_details_id', $request->sub_category_details_id)->get();
       * }
       * else if (isset($request->sub_category_id) && $request->sub_category_id != "" && $request->sub_category_details_id == "")
       * {
       *     $expenses = Expenses::with('expense_category','expense_sub_category', 'expense_sub_category_details', 'school')->where('mktg_year', $request->mktg_year)
       *         ->where('sub_category_id', $request->sub_category_id)->get();
       * }
       * else if (isset($request->category_id) && $request->category_id != "" && $request->sub_category_id == "")
       * {
       *     $expenses = Expenses::with('expense_category','expense_sub_category', 'expense_sub_category_details', 'school')->where('mktg_year', $request->mktg_year)
       *         ->where('category_id', $request->category_id)->get();
       *     // dd($expenses->toArray());
       * }
       *
       * $srno = 1;
       * echo "<table class='table table-bordered table-striped table-css master-table w-100 header' id='report_table' style='white-space: nowrap;'><thead><tr>";
       * echo "<th>Sr No.</th>";
       * echo "<th>School Name</th>";
       * echo "<th>Marketing Year</th>";
       * echo "<th>Category</th>";
       * echo "<th>Sub Category</th>";
       * echo "<th>Sub Category Details</th>";
       * echo "<th>Vendor Details</th>";
       * echo "<th>Bill No</th>";
       * echo "<th>Bill Date</th>";
       * echo "<th>Amount</th>";
       * echo "</tr></thead><tbody>";
       * foreach ($expenses as $data) {
        *    echo "<tr>";
        *    echo "<td>" . $srno . "</td>";
        *    if (isset($data->school->school_name)) {
        *        echo "<td>" . $data->school->school_name . " (" . $data->school->board_name . ") " . $data->school->location . "</td>";
        *    }
        *    echo "<td>" . $data->mktg_year . "</td>";
        *
        *
        *    if (isset($data->expense_category->category_name))
        *        echo "<td>" . $data->expense_category->category_name . "</td>";
        *
        *
        *    if (isset($data->expense_sub_category)) {
        *        if (isset($data->expense_sub_category->sub_category_name)) {
        *            echo "<td>" . $data->expense_sub_category->sub_category_name . "</td>";
        *        }
        *    } else {
        *        echo "<td>--</td>";
        *    }


        *            if(isset($data->expense_sub_category_details)){
        *                if(isset($data->expense_sub_category_details->sub_category_details))
        *                {
        *                    echo "<td>".$data->expense_sub_category_details->sub_category_details."</td>";
        *                }
        *            }else{
        *                echo "<td>--</td>";
        *            }
        *
        *            echo "<td>".$data->vendor_details."</td>";
        *            echo "<td>".$data->bill_no."</td>";
        *            echo "<td>".$data->bill_date."</td>";
        *            echo "<td>".$data->amount."</td>";
        *
        *            echo "</tr>";
        *            $srno++;
        *        } //end of foreach loop
        *        echo "<tbody></table>";
        *
        *    }
     */
} //end of class
