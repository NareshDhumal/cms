<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\backend\TeacherDocuments;
use Illuminate\Http\Request;

//models
use App\Models\backend\Students;

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
            dd('save');
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
        $student = Students::with('admissions')->where('student_id', $id)->first();
        if ($student) {
            // dd($student->toArray());
            return view('backend.student.profile', compact('student'));
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
