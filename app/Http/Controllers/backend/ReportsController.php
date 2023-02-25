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


        $budget = Categories::with('category_budget', 'budget_report_subcategories')->where('include_budget', 1)->get();



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
        $srno=1;
            echo "<table class='table table-bordered table-striped table-css master-table w-100 header' id='report_table' style='white-space: nowrap;'><thead><tr>";
            echo "<th>Sr No.</th>";
            echo "<th>School Name</th>";
            echo "<th>Category</th>";
            echo "<th>SubCategory</th>";
            echo "<th>Sub Category Details</th>";
            foreach ($request->mktg_year as $year_num) {
                echo "<td>" . $year_num . "</td>";
            }
            echo "</tr></thead><tbody>";

        if ($request->in_group == 1) {
            // dd('display in group');
        } else {
            $year = $request->mktg_year;
            $category = $request->category_id;
            if (isset($request->sub_category_details_id) && ($request->sub_category_details_id != null && $request->sub_category_details_id != 0)) {
                // echo "details";
                //Category Details
                $year = $request->mktg_year;
                $year1 = implode("','", $request->mktg_year);
                $sub_category_details = implode("','", $request->sub_category_details_id);
                //$sub_category_details= str_replace("'", '"', $sub_category_details1);

                $results = DB::select(DB::raw("SELECT distinct(school_id) FROM mktg_expences where mktg_year in ('" . $year1 . "') and sub_category_details_id in ('" . $sub_category_details . "') "));
                foreach ($results as $school_ids) {
                    //school array
                    $school = School::where('school_id', $school_ids->school_id)->first();
                    $exp_sub_category_details = DB::select(DB::raw("SELECT distinct(sub_category_details_id) FROM mktg_expences where school_id = $school_ids->school_id and  sub_category_details_id in ('" . $sub_category_details . "')  "));
                    foreach ($exp_sub_category_details as $sub_cat_details) {
                        echo "<tr>";
                            echo "<td>".$srno."</td>";
                            echo "<td>". $school->school_name . " (" . $school->board_name . ") " . $school->location . "</td>";
                            //sub_category_details
                            $sub_cat_details_name = SubCategoryDetails::where('sub_category_details_id', $sub_cat_details->sub_category_details_id)->first();
                            $sub_cat_name = SubCategories::where('sub_category_id', $sub_cat_details_name->sub_category_id)->first();
                            $cat_name = Categories::where('category_id', $sub_cat_name->category_id)->first();

                            if(isset($cat_name->category_name)){
                                echo "<td>".$cat_name->category_name."</td>";
                                }

                                if(isset($sub_cat_name->sub_category_name)){
                                    echo "<td>".$sub_cat_name->sub_category_name."</td>";
                                    }

                            if (isset($sub_cat_details_name->sub_category_details)) {
                                echo "<td>".$sub_cat_details_name->sub_category_details."</td>";
                            }
                            $srno++;
                    }
                    foreach ($year as $year_num) {
                        $data = Expenses::where('sub_category_details_id', '=', $sub_cat_details->sub_category_details_id)->where('mktg_year', $year_num)->where('school_id', $school_ids->school_id)->sum('amount');
                        if(isset($data) && $data != 0 || $data !=""){
                            echo "<td>". $data . "</td>";
                        }
                        else{
                            echo "<td>0</td>";
                        }
                         //")".$year_num.
                    }
                }
                //Total
                echo "<tr>";
                echo "<td>Total</td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                foreach ($year as $year_num) {
                    //echo "SELECT sum(amount) as total FROM mktg_expences where sub_category_id in ('" . $sub_category. "') and mktg_year = '" . $year_num . "' ";
                    $sum = DB::select(DB::raw("SELECT sum(amount) as total FROM mktg_expences where sub_category_details_id in ('" . $sub_category_details. "') and mktg_year = '" . $year_num . "' "));

                    echo "<td>" . $sum[0]->total . "</td>";
                    //")".$year_num.
                }
                echo "</tr>";

            }  //end of details condition



            else if (isset($request->sub_category_id) && $request->sub_category_id != "" && $request->sub_category_details_id == "") {
                //FOR SUNCATEGORY
                // echo "sub category";
                $year = $request->mktg_year;
               // $category = $request->category_id;
                $year1 = implode("','", $request->mktg_year);
                $sub_category = implode("','", $request->sub_category_id);
                $results = DB::select(DB::raw("SELECT distinct(school_id) FROM mktg_expences where mktg_year in ('" . $year1 . "') and sub_category_id in ('" . $sub_category . "') "));
                foreach ($results as $school_ids) {
                //school array
                $school = School::where('school_id', $school_ids->school_id)->first();
                    $exp_sub_category = DB::select(DB::raw("SELECT distinct(sub_category_id) FROM mktg_expences where school_id = $school_ids->school_id and sub_category_id in ('" . $sub_category. "')"));

                    foreach ($exp_sub_category as $sub_cat) {
                        //foreach for categories
                        foreach($sub_cat as $cat){
                            echo "<tr>";
                            echo "<td>".$srno."</td>";
                            echo "<td>". $school->school_name . " (" . $school->board_name . ") " . $school->location . "</td>";
                            $sub_cat_name = SubCategories::where('sub_category_id', $sub_cat->sub_category_id)->first();
                            $cat_name = Categories::where('category_id', $sub_cat_name->category_id)->first();
                            if(isset($cat_name->category_name)){
                                echo "<td>".$cat_name->category_name."</td>";
                            }

                            echo "<td>";

                        if (isset($sub_cat_name['sub_category_name'])) {
                            echo $sub_cat_name['sub_category_name'];
                        }
                        echo "</td>";
                        echo "<td></td>";
                            // echo "<td>".$sub_cat->sub_category_id."</td>";
                            $srno++;
                        }

                        foreach ($year as $year_num) {
                            $data = Expenses::where('sub_category_id', '=', $sub_cat->sub_category_id)->where('mktg_year', $year_num)->where('school_id', $school_ids->school_id)->sum('amount');
                            if(isset($data) && $data != 0 || $data !=""){
                                echo "<td>". $data . "</td>";
                            }
                            else{
                                echo "<td>0</td>";
                            }//")".$year_num.
                        }

                    }
                } //end of foreach school ids
                //total for subcategory
                echo "<tr>";
                echo "<td>Total</td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                foreach ($year as $year_num) {
                    //echo "SELECT sum(amount) as total FROM mktg_expences where sub_category_id in ('" . $sub_category. "') and mktg_year = '" . $year_num . "' ";
                    $sum = DB::select(DB::raw("SELECT sum(amount) as total FROM mktg_expences where sub_category_id in ('" . $sub_category. "') and mktg_year = '" . $year_num . "' "));
                    echo "<td>" . $sum[0]->total . "</td>";
                    //")".$year_num.
                }
                echo "</tr>";



            }



            else if (isset($request->category_id) && $request->category_id != "" && $request->sub_category_id == "")
            {
                //ONLY Category Selected
// echo "category";
                $year = $request->mktg_year;
                //dd($request->mktg_year);
                $category = $request->category_id;
                $year1 = implode("','", $request->mktg_year);
                $category1 = implode("','", $request->category_id);
                // ++ $results = DB::select( DB::raw("SELECT distinct(school_id) FROM mktg_expences where mktg_year in ('2021-22','2023-24')") );
                $results = DB::select(DB::raw("SELECT distinct(school_id) FROM mktg_expences where mktg_year in ('" . $year1 . "') and category_id in ('" . $category1 . "') "));

                $ind = 0;
                $srno=1;
                foreach ($results as $school_ids) {
                    $school = School::where('school_id', $school_ids->school_id)->first();
                    $exp_category = DB::select(DB::raw("SELECT distinct(category_id) FROM mktg_expences where school_id = $school_ids->school_id and category_id in ('" . $category1 . "') "));
                    foreach ($exp_category as $cat) {

                        echo "<tr>";
                        echo "<td>".$srno."</td>";
                        echo "<td>" . $school->school_name . " (" . $school->board_name . ") " . $school->location . "</td>";
                        $cat_name = Categories::where('category_id', $cat->category_id)->first();

                        // echo "<td>".$cat->category_id."</td>";
                        // echo "<td>".print_r($cat_name->category_name[0])."</td>";
                        echo "<td>";
                        if (isset($cat_name['category_name'])) {
                            echo $cat_name['category_name'];
                        }
                        echo "</td>";
                        echo "<td> - </td>";
                        echo "<td> - </td>";
                        foreach ($year as $year_num) {
                            $data = Expenses::where('category_id', '=', $cat->category_id)->where('mktg_year', $year_num)->where('school_id', $school_ids->school_id)->sum('amount');
                            if(isset($data) && $data != 0 || $data !=""){
                                echo "<td>". $data . "</td>";
                            }
                            else{
                                echo "<td>0</td>";
                            } //")".$year_num.
                        }
                        echo "</tr>";
                        $srno++;
                    }

                }

                echo "<tr>";
                echo "<td>Total</td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                foreach ($year as $year_num) {
                    $sum = DB::select(DB::raw("SELECT sum(amount) as total FROM mktg_expences where category_id in ('" . $category1 . "') and mktg_year = '" . $year_num . "' "));
                    echo "<td>" . $sum[0]->total . "</td>";
                    //")".$year_num.
                }
                echo "</tr>";
            }  //Category Selection END

        } // end of else

echo "</tbody>";
echo "</table>";

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
