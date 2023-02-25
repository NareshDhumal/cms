<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

use App\Models\backend\School;
use App\Models\backend\Boards;
use App\Models\backend\State;


class SchoolController extends Controller
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
        $school = School::with('state')->get();
        return view('backend.school.index', compact('school'));
    }

    public function create()
    {
        $boards = Boards::pluck('board_name','board_name');
        $state = State::pluck('state_name','state_id');
      return view('backend.school.create' , compact('boards','state'));
    }

    public function store(Request $request){
        // $request->validate([
        //     // 'school_name' => 'required|unique:schools,school_name',
        //     'school_name' => 'required',
        //     'state_id' => 'required',
        //     'established_date' => 'required',
        //     'board_name' => 'required',
        //     'type' => 'required'
        // ]);
        $school = new School;
        $school->fill($request->all());
       if($school->save()){
        return redirect('/admin/school')->with('success', 'School Has Been Added');
       }else{
        return redirect('/admin/school')->with('error', 'Unable to add School');
       }
    }

    public function edit($id){
        $school = School::find($id);
        if(!empty($id) || $id != 0){
            $schooldata = School::where('school_id', $id)->with('board')->first();
            $boards = Boards::pluck('board_name','board_name');
            $state = State::pluck('state_name','state_id');

            return view('backend.school.edit', compact('schooldata', 'id', 'boards','state'));
        }
    }
public function update(Request $request){
    // $request->validate([
    //     'school_name' => 'required',
    //     'state_id' => 'required',
    //     'established_date' => 'required',
    //     'board_name' => 'required',
    //     'type' => 'required'
    // ]);

    $school = School::where('school_id', $request->school_id)->first();
    $school->fill($request->all());
       if($school->save()){
        return redirect('/admin/school')->with('success', 'School Details Has Been Updated');
       }else{
        return redirect('/admin/school')->with('error', 'Unable to Update School Details');
       }
}

public function delete($id){
    $data = School::where('school_id', $id)->get();
    if(count($data)!= 0){
        $delete =School::where('school_id', $id)->delete();
        if($delete){
            return redirect('/admin/school')->with('success', 'School Has Been Removed');
           }else{
            return redirect('/admin/school')->with('error', 'Unable to Delete school');
           }
    }
}



} //end of class
