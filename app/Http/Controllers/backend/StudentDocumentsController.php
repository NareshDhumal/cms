<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\backend\TeacherDocuments;
use Illuminate\Http\Request;

//models
use App\Models\backend\Students;
use App\Models\backend\StudentDocuments;


use Carbon\Carbon;
use Session;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class StudentDocumentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function show_documents($id)
    {
        //$id nothing but batch_id
        $student = Students::with('documents')->where('student_id',$id)->first();
        return view('backend.student.documents', compact('student'));
    }

    public function store_documents(Request $request){
        $request->validate([
            'student_id'=>'required',
            'doc_name'=>'required',
            'doc_file'=>'required'
        ]);

        $ext = ['pdf','png', 'jpg', 'jpeg'];
        $file_ext = $request->file('doc_file')->getClientOriginalExtension();
        $file_name = 'doc_'.date('his').'.'.$request->doc_file->getClientOriginalExtension();

        if(!in_array($file_ext,$ext)){
           return redirect()->route('admin.students.documents', [$request->student_id])->with('error','Please Upload pdf or image file');
        }

        $location = public_path('/uploads/students/documents/'.$request->student_id);

        if($request->doc_file->move($location, $file_name)){
            $document = new StudentDocuments;
            $data = [
                'student_id'=>$request->student_id,
                'doc_name' => $request->doc_name,
                'doc_file' => $file_name
            ];

            $document->fill($data);
            if($document->save()){
                return redirect()->route('admin.students.documents', [$request->student_id])->with('success','Document Has Been Uploaded');
            }else{
                return redirect()->route('admin.students.documents', [$request->student_id])->with('error','Something got wrong');
            }
        }else{
            return redirect()->route('admin.students.documents', [$request->student_id])->with('error','Unable to Upload Image');
        }
    }


    //delete document
    public function delete_document($id){
        $student = StudentDocuments::where('student_document_id', $id)->first();
        if($student){
          if($student->delete()){
            return redirect()->route('admin.students.documents', [$student->student_id])->with('success','Document has been deleted.');
          }else{
            return redirect()->route('admin.students.documents', [$student->student_id])->with('error','Unable to Delete Document.');
        }
        }
    }
}  //end of class
