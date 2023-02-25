<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

use App\Models\backend\Years;



class YearController extends Controller
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
        $year = Years::all();
        return view('backend.year.index', compact('year'));
    }

    public function create()
    {
        return view('backend.year.years_create');

    }

    public function store(Request $request){
        $request->validate([
            'year' => 'Required|unique:year,year'
        ]);

        $year = new Years;
        $year->fill($request->all());
        if($year->save()){
            return redirect('/admin/year')->with('success', 'Year Has Been Added');
           }else{
            return redirect('/admin/year')->with('error', 'Unable to add Year');
           }
    }

    public function edit($id){
        $yeardata = Years::where('year_id',$id)->first();
        return view('backend.year.years_edit', compact('yeardata'));

    }
public function update(Request $request){
$request->validate([
    'year'=>'required'
]);

$year = Years::where('year_id',$request->year_id)->first();
$year->fill($request->all());
if($year->save()){
    return redirect('/admin/year')->with('success', 'Year Has Been Updated');
   }else{
    return redirect('/admin/year')->with('error', 'Unable to Update Year');
   }



}

public function delete($id){
    $data = Years::where('year_id', $id)->get();

    if(count($data)!= 0){
        $delete =Years::where('Year_id', $id)->delete();
        if($delete){
            return redirect('/admin/year')->with('success', 'year Has Been Removed');
           }else{
            return redirect('/admin/year')->with('error', 'Unable to Delete year');
           }
    }
}



} //end of class
