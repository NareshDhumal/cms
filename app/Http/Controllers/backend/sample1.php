// $expenses = DB::table('mktg_expences')
        //         ->select('school_id', 'mktg_year')
        //         ->groupByRaw('distinct(mktg_year)')
        //         ->get();

        // *  $expenses = DB::table('mktg_expences')->select(DB::raw('school_id,mktg_year, count(mktg_year)'))->groupBy('mktg_year')->get();



        // $expenses = Expenses::get()
        // ->groupBy('school_id')->map(function($item){
        //     return $item->groupBy(['mktg_year']);
        // });

        $data = Expenses::select('school_id','mktg_year', 'category_id', 'sub_category_id', 'sub_category_details_id','amount')->whereIN('category_id', $request->category_id)->whereIN('mktg_year', $request->mktg_year)->get();

        // $newdata = collect($data)->map(function ($item, $key) {
        //     return [$item['school_id'] => $item['mktg_year']];
        //   });
        //   dd($data);
          $newdata = $data->mapToDictionary(function ($item, $key) {
            // dd( $item['amount']);
            $sid = $item['school_id'];
            $year = $item['mktg_year'];
            $amt = $item['amount'];
            return [$item['school_id'] = [$year=>$amt]];

         });

         $mydata = ($newdata);
        //  $third = $mydata->merge($data);
        //  dd($third);

         dd($mydata);
