<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//models
use App\Models\backend\Students;
use App\Models\backend\StudentAcademics;

use Carbon\Carbon;
use Session;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class StudentsAcademicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        //$id nothing but batch_id

    }

    public function add_academics($id){
        $student = Students::with('academics')->where('student_id', $id)->first();
        //dd($student->toArray());
        if($student){
            return view('backend.student.student_academics', compact('student'));
        }else{
            return redirect()->route('admin.students')->with('error', 'Student Details Not Found');
        }
    }

    public function academics_store(Request $request){
           $request->validate([
            'student_id'=>'required',
            'exam'=>'required',
            'school_board'=>'required',
            'score'=>'required',
            'year'=>'required|digits:4'
           ]);

           $adcademics = new StudentAcademics;
           $adcademics->fill($request->all());
           if($adcademics->save()){
            return redirect()->route('admin.students.academics',[$request->student_id])->with('success','Previous Academic Details Added');
           }else{
            return redirect()->route('admin.students.academics',[$request->student_id])->with('error','Unable  Add Previous Academics');
           }
    }

    public function academics_delete($id){
       $academic = StudentAcademics::where('student_acadmic_id',$id)->first();
       if($academic){
            if( $academic->delete()){
                return redirect()->route('admin.students.academics',[$academic->student_id])->with('success','Details Deleted Successfully');
            }else{
                return redirect()->route('admin.students.academics',[$academic->student_id])->with('error','Failed to Delete Details');
            }
       }else{
        return redirect()->route('admin.students')->with('error', 'Student Details Not Found');
       }
    }

}  //end of class
