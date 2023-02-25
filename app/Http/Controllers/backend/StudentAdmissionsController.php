<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//models
use App\Models\backend\Students;
use App\Models\backend\AcademicYears;
use App\Models\backend\Batches;
use App\Models\backend\StudentAdmissions;

use Carbon\Carbon;
use Session;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Auth;

class StudentAdmissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function admissions($id){
       if($id !='' && $id !=0){
        $years = AcademicYears::orderBy('academic_year_id', 'desc')->pluck('academic_year','academic_year_id');
        $batchs = Batches::pluck('batch_name','batch_id');
        $student = Students::with('admissions')->where('student_id', $id)->first();
        if ($student) {
            //admission details
            // dd($student->toArray());
            return view('backend.student.admissions', compact('student','years','batchs'));
        } else {
            return redirect()->route('admin.students')->with('error', 'Student Not Found.');
        }
       }
    }

    public function admission_store(Request $request){
       $old_record = StudentAdmissions::where('student_id',$request->student_id)
                                        ->where('year_id',$request->year_id)
                                        ->where('batch_id',$request->batch_id)->get();
        if(count($old_record) == 0){
           $data = $request->all();
           $admission = new StudentAdmissions;
           $admission->fill($data);
           $admission->inserted_by = Auth::user()->admin_user_id;

           if($admission->save()){
            return redirect()->route('admin.students.admissions',[$request->student_id])->with('success','Student Enroll in course');
           }else{
            return redirect()->route('admin.students.admissions',[$request->student_id])->with('error','Unable to enroll student');
           }

        }else{
           return redirect()->route('admin.students.admissions',[$request->student_id])->with('error','This student already enrolled in this course');
        }
    }


    public function admissions_edit($id){}

    public function admission_update(Request $request){}

    public function delete($id){
        $admission = StudentAdmissions::where('student_admission_id', $id)->first();
        if($admission){
                //check fee paid if presert dlete fee and delete recodr mesaga
                //else
                if($admission->delete()){
                    return redirect()->route('admin.students.admissions',[$admission->student_id])->with('success','Admission record has been deleted');
                }else
                {
                    return redirect()->route('admin.students.admissions',[$admission->student_id])->with('error','Unable to delete admission record');
                }
        }
    }



}  //end of class
