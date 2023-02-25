<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\backend\TeacherDocuments;
use Illuminate\Http\Request;

//models
use App\Models\backend\Students;
use App\Models\backend\Batches;
use App\Models\backend\StudentAdmissions;

use Carbon\Carbon;
use Session;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class StudentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        //$id nothing but batch_id
        $students = Students::orderby('status', 'desc')->get();
        return view('backend.student.index', compact('students'));
    }

    public function create()
    {
        return view('backend.student.create');
    }

    //Store Teacher Details
    public function store(Request $request)
    {
        //  dd($request->all());
        $request->validate([
            "student_name" => "required",
            "email" => "unique:teachers,email",
            "mobile_no" => "required|unique:students,mobile_no",
            "gender" => "required",
        ]);

        $student = new Students;
        $student->fill($request->all());
        if($student->save()){
           return redirect()->route('admin.students.profile',[$student->student_id])->with('success','New Student Registered');
        }else{
           return redirect()->to('admin.students.create')->with('error','Unable to Register Student');
        }
    }


    public function delete($id)
    {
        if ($id != 0 || $id != 0) {
            $student = Students::where('student_id', $id)->first();
            if ($student) {
                $student->status = 0;
                if ($student->save()) {
                    //delete
                    return redirect()->route('admin.students')->with('info', 'Teacher has been Disabled.');
                } else {
                    //failed to delete
                    return redirect()->route('admin.students')->with('error', 'Failed to Disable Teacher.');
                }
            } else {
                //data not found
                return redirect()->route('admin.students')->with('error', 'Teacher Not Found.');
            }
        }
    }

    /////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    //////////Profile Functions/////////////////
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////

    //view Profile
    public function profile($id)
    {
        //student course array
        $student_course = [0=>'Not Enrolled'];
        $last_course = [];
        $session_data = ['student_id'=>$id, 'roll_no' => '', 'year_id'=>'', 'academic_year'=>'',  'batch_id'=>'', 'batch'=>'', 'total_fees'=>0, 'paid_fees'=>0, 'remain_fees'=>0 ];

        $student = Students::with('admissions')->where('student_id', $id)->first();
        if ($student) {

                    //get student admission count
        $admission_count = StudentAdmissions::where('student_id', $id)->count();
        //check student get admission or not
        if($admission_count !="" && $admission_count > 0){
            //gets ids  of student selected course
            //fetch batches for student batch dropdown
            // then pass the ids for batch pluck method
        $courses = StudentAdmissions::where('student_id', $id)->get('batch_id');
        $student_course = Batches::whereIN('batch_id',$courses)->pluck('batch_name','batch_id');

        //put last entered class data in session with payment details
        //create array of student details i.e user visit the appliation user get deteils without hitting database query

     //   session::forget('student_2');
        //check session is set or not
       if(Session()->has('student_'.$id)){
        //update session
        $student_session = Session('student_'.$id);

        $last_course = StudentAdmissions::with('academic_years','batches')->where('student_id', $id)->where('student_admission_id',$student_session['roll_no'])->first();
       // dd($last_course,$id);
    }else{
        //update value in array for pushing in session
        $last_course = StudentAdmissions::with('academic_years','batches')->where('student_id', $id)->orderBy('student_admission_id','desc')->first();

    }
       $session_data['roll_no'] = $last_course->student_admission_id;
       $session_data['year_id'] = $last_course->year_id;
       //check year value empty or not
           if(isset($last_course->academic_years->academic_year)  )
           {
                $session_data['academic_year'] = $last_course->academic_years->academic_year;
           }
       $session_data['batch_id'] = $last_course->batch_id;
           if(isset($last_course->batches->batch_name) )
           {
               $session_data['batch'] = $last_course->batches->batch_name;
           }
           //put data in new session
       Session::put('student_'.$id, $session_data);
    }


            return view('backend.student.profile', compact('student','student_course','last_course'));
        } else {
            return redirect()->route('admin.students')->with('error', 'Student Not Found.');
        }
    }

    //Go to edit page
    public function edit($id)
    {
        // if ($id != '' && $id != 0) {
        //     $teacher = Teachers::with('education')->where('teacher_id', $id)->first();
        //     if ($teacher) {
        //         return view('backend.teacher.edit', compact('teacher'));
        //     }
        // }
    }

    //Update details
    public function update(Request $request)
    {
        // dd($request->all());
        $teacher = Teachers::where('teacher_id', $request->teacher_id)->first();
        if ($teacher) {
            $teacher->fill($request->all());
            if ($teacher->save()) {
                return redirect()->route('admin.teachers.edit', [$teacher->teacher_id])->with('success', 'Teacher Details Has Been Updated');
            }
        } else {
            return redirect()->route('admin.teachers.edit', [$request->teacher_id])->with('error', 'Failed to Update Teacher Details');
        }
    }

    //update status
    public function update_status(Request $request)
    {

    }


    //update education details
    public function update_education(Request $request)
    {
    }




    //update resume
    public function update_resume(Request $request)
    {

    }

    //update profile picture
    public function update_picture(Request $request)
    {

    }

    //function for show documents
    public function show_documents($id){

    }

    //store documents
    public function store_documents(Request $request)
    {

    }

public function delete_document($id){

}




}  //end of class
