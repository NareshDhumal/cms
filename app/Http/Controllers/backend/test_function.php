

        if ($request->in_group == 1) {
            dd('display in group');
        } else {
            if (isset($request->sub_category_details_id) && ($request->sub_category_details_id != null && $request->sub_category_details_id != 0)) {
                $expenses = Expenses::with('expense_category', 'expense_sub_category', 'expense_sub_category_details', 'school')->whereIN('mktg_year', $request->mktg_year)
                    ->whereIN('sub_category_details_id', $request->sub_category_details_id)
                    ->orderBy('category_id', 'ASC')->orderBy('sub_category_id', 'ASC')->orderBy('sub_category_details_id', 'ASC')->get();
            } else if (isset($request->sub_category_id) && $request->sub_category_id != "" && $request->sub_category_details_id == "") {
                $expenses = Expenses::with('expense_category', 'expense_sub_category', 'expense_sub_category_details', 'school')->whereIN('mktg_year', $request->mktg_year)
                    ->whereIN('sub_category_id', $request->sub_category_id)
                    ->orderBy('category_id', 'ASC')->orderBy('sub_category_id', 'ASC')->orderBy('sub_category_details_id', 'ASC')->get();
            } else if (isset($request->category_id) && $request->category_id != "" && $request->sub_category_id == "") {
                 $expenses = Expenses::select('school_id','mktg_year','category_id','sub_category_id','sub_category_details_id','amount')->with('expense_category', 'expense_sub_category', 'expense_sub_category_details', 'school')->whereIN('mktg_year', $request->mktg_year)
                  ->whereIN('category_id', $request->category_id)->get()->groupBy('school_id');
                //   ->whereIN('category_id', $request->category_id)->get('school_id','mktg_year','category_id','subcategory_id','sub_category_details_id','amount')->groupBy('school_id');

                  dd($expenses->toArray());
                }
        }// end of else

        //filter unique years
        $years_arr = array();
        for ($i = 0; $i < sizeof($expenses); $i++) {
            if (!in_array($expenses[$i]['mktg_year'], $years_arr)) {
                $years_arr[$i] = $expenses[$i]['mktg_year'];
            }
        }
        //sort array by  year
        sort($years_arr);

        $srno = 1;
        echo "<table class='table table-bordered table-striped table-css master-table w-100 header' id='report_table' style='white-space: nowrap;'><thead><tr>";
        echo "<th>Sr No.</th>";
        echo "<th>School Name</th>";

        echo "<th>Category</th>";
        echo "<th>Sub Category</th>";
        echo "<th>Sub Category Details</th>";

        for ($i = 0; $i < sizeof($years_arr); $i++) {
            echo "<th>" . $years_arr[$i] . "</th>";
            // echo "<th>Amount</th>";
        }

        echo "</tr></thead><tbody>";

        //table header creation complete
        foreach ($expenses as $data) {
            echo "<tr>";
            echo "<td>" . $srno . "</td>";
            echo "<td>" . $data->school->school_name . " ( " . $data->school->board_name . " ) " . $data->school->location . " </td>";

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
            if (isset($data->expense_sub_category_details)) {
                if (isset($data->expense_sub_category_details->sub_category_details)) {
                    echo "<td>" . $data->expense_sub_category_details->sub_category_details . "</td>";
                }
            } else {
                echo "<td>--</td>";
            }

            for ($j = 0; $j < sizeof($years_arr); $j++) {
                //sub category details
                if(isset($data->expense_sub_category_details->sub_category_details_id)){}

            }
             echo "<td>" . $data->mktg_year . "</td>";
             echo "<td>" . $data->amount . "</td>";


            echo "</tr>";
            $srno++;
        } //end of foreach loop
        echo "<tbody></table>";









        ++++++++++++++++++++++++++++++
        ++++++++++++++++++++++++++++++

        if ($request->in_group == 1) {
            dd('display in group');
        } else {
            if (isset($request->sub_category_details_id) && ($request->sub_category_details_id != null && $request->sub_category_details_id != 0)) {
                $expenses = Expenses::with('expense_category', 'expense_sub_category', 'expense_sub_category_details', 'school')->whereIN('mktg_year', $request->mktg_year)
                    ->whereIN('sub_category_details_id', $request->sub_category_details_id)
                    ->orderBy('category_id', 'ASC')->orderBy('sub_category_id', 'ASC')->orderBy('sub_category_details_id', 'ASC')->get();
            } else if (isset($request->sub_category_id) && $request->sub_category_id != "" && $request->sub_category_details_id == "") {
                $expenses = Expenses::with('expense_category', 'expense_sub_category', 'expense_sub_category_details', 'school')->whereIN('mktg_year', $request->mktg_year)
                    ->whereIN('sub_category_id', $request->sub_category_id)
                    ->orderBy('category_id', 'ASC')->orderBy('sub_category_id', 'ASC')->orderBy('sub_category_details_id', 'ASC')->get();
            } else if (isset($request->category_id) && $request->category_id != "" && $request->sub_category_id == "") {
                 $expenses = Expenses::select('school_id','mktg_year','category_id','sub_category_id','sub_category_details_id','amount')->with('expense_category', 'expense_sub_category', 'expense_sub_category_details', 'school')->whereIN('mktg_year', $request->mktg_year)
                  ->whereIN('category_id', $request->category_id)->get()->groupBy('school_id');
                //   ->whereIN('category_id', $request->category_id)->get('school_id','mktg_year','category_id','subcategory_id','sub_category_details_id','amount')->groupBy('school_id');

                  dd($expenses->toArray());
                }
        }// end of else

        //filter unique years
        $years_arr = array();
        for ($i = 0; $i < sizeof($expenses); $i++) {
            if (!in_array($expenses[$i]['mktg_year'], $years_arr)) {
                $years_arr[$i] = $expenses[$i]['mktg_year'];
            }
        }
        //sort array by  year
        sort($years_arr);

        $srno = 1;
        echo "<table class='table table-bordered table-striped table-css master-table w-100 header' id='report_table' style='white-space: nowrap;'><thead><tr>";
        echo "<th>Sr No.</th>";
        echo "<th>School Name</th>";

        echo "<th>Category</th>";
        echo "<th>Sub Category</th>";
        echo "<th>Sub Category Details</th>";

        for ($i = 0; $i < sizeof($years_arr); $i++) {
            echo "<th>" . $years_arr[$i] . "</th>";
            // echo "<th>Amount</th>";
        }

        echo "</tr></thead><tbody>";

        //table header creation complete
        foreach ($expenses as $data) {
            echo "<tr>";
            echo "<td>" . $srno . "</td>";
            echo "<td>" . $data->school->school_name . " ( " . $data->school->board_name . " ) " . $data->school->location . " </td>";

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
            if (isset($data->expense_sub_category_details)) {
                if (isset($data->expense_sub_category_details->sub_category_details)) {
                    echo "<td>" . $data->expense_sub_category_details->sub_category_details . "</td>";
                }
            } else {
                echo "<td>--</td>";
            }

            for ($j = 0; $j < sizeof($years_arr); $j++) {
                //sub category details
                if(isset($data->expense_sub_category_details->sub_category_details_id)){}

            }
             echo "<td>" . $data->mktg_year . "</td>";
             echo "<td>" . $data->amount . "</td>";


            echo "</tr>";
            $srno++;
        } //end of foreach loop
        echo "<tbody></table>";

        ++++++++++++++++++++++++++++++
        ++++++++++++++++++++++++++++++
