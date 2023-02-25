<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\backend\TeacherDocuments;
use Illuminate\Http\Request;

//models
use App\Models\backend\Teachers;
use App\Models\backend\TeacherEducation;

use Carbon\Carbon;
use Session;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        //$id nothing but batch_id
        $teachers = Teachers::orderby('status', 'desc')->get();
        return view('backend.teacher.index', compact('teachers'));
    }

    public function create()
    {
        return view('backend.teacher.create');
    }

    //Store Teacher Details
    public function store(Request $request)
    {
        //  dd($request->all());
        $request->validate([
            "full_name" => "required",
            "email" => "required|unique:teachers,email",
            "mobile" => "required|unique:teachers,mobile",
            "dob" => "required",
            "edu_details" => "required",
            "address" => "required",
            "picture" => "required|mimes:jpeg,png,jpg",
            "resume" => "required|required|mimetypes:application/pdf", //|max:100000
        ]);

        $form_data = $request->all();
        unset($form_data['picture']);
        unset($form_data['resume']);

        $teacher = new Teachers;
        $teacher->fill($form_data);
        if ($teacher->save()) {
            if ($request->has('picture')) {
                $location = public_path('uploads/teachers/picture/' . $teacher->teacher_id);

                $picture = 'img_' . $teacher->teacher_id . '_' . date('his') . '.' . $request->file('picture')->getClientOriginalExtension();
                if ($request->picture->move($location, $picture)) {
                    $teacher->picture = $picture;
                    $teacher->save();
                }
            }

            if ($request->has('resume')) {
                $location = public_path('uploads/teachers/resume/' . $teacher->teacher_id);
                $resume = 'res_' . $teacher->teacher_id . '_' . date('his') . '.' . $request->file('resume')->getClientOriginalExtension();
                if ($request->resume->move($location, $resume)) {
                    $teacher->resume = $resume;
                    $teacher->save();
                }
            }

            return redirect()->route('admin.teachers')->with('success', 'New Teacher Registered');
        } else {
            return redirect()->route('admin.teachers')->with('error', 'Failed to register teacher');
        }
    }


    public function delete($id)
    {
        if ($id != 0 || $id != 0) {
            $teacher = Teachers::where('teacher_id', $id)->first();
            if ($teacher) {
                if ($teacher->delete()) {
                    //delete
                    return redirect()->route('admin.teachers')->with('info', 'Teacher has been Disabled.');
                } else {
                    //failed to delete
                    return redirect()->route('admin.teachers')->with('error', 'Failed to Disable Teacher.');
                }
            } else {
                //data not found
                return redirect()->route('admin.teachers')->with('error', 'Teacher Not Found.');
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
        $teacher = Teachers::where('teacher_id', $id)->first();
        if ($teacher) {
            return view('backend.teacher.profile', compact('teacher'));
        } else {
            return redirect()->route('admin.teachers')->with('error', 'Teacher Not Found.');
        }
    }

    //Go to edit page
    public function edit($id)
    {
        if ($id != '' && $id != 0) {
            $teacher = Teachers::with('education')->where('teacher_id', $id)->first();
            if ($teacher) {
                return view('backend.teacher.edit', compact('teacher'));
            }
        }
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
        // dd('in update status');
        $teacher = Teachers::where('teacher_id', $request->teacher_id)->first();
        // dd($request->all());
        if ($teacher) {
            $teacher->status = $request->status;
            if ($teacher->save()) {
                return redirect()->route('admin.teachers.edit', [$teacher->teacher_id])->with('success', 'Teacher Status Has Been Updated');
            }
        } else {
            return redirect()->route('admin.teachers')->with('error', 'Teacher Not Found.');
        }
    }


    //update education details
    public function update_education(Request $request)
    {
        //in update education
        $teacher = Teachers::where('teacher_id', $request->teacher_id)->first();
        if ($teacher) {
            if (isset($request->education_details) && count($request->education_details) > 0) {
                $education = TeacherEducation::where('teacher_id', $teacher->teacher_id)->get();
                if ($education && count($education) > 0) {
                    foreach ($education as $edu) {
                        $old_edu = TeacherEducation::where('teacher_education_id', $edu->teacher_education_id)->first()->delete();
                    }
                }

                //old data deleted insert old data nwhich is not deleted
                if (isset($request->old_education) && count($request->old_education) > 0) {
                    foreach ($request->old_education as $old) {
                        if ($old['course'] != '') {
                            $education_entry = new TeacherEducation;
                            $education_entry->fill($old);
                            $education_entry->teacher_id = $teacher->teacher_id;
                            $education_entry->save();
                        }
                    }
                }

                //insert new data
                if (isset($request->education_details) && count($request->education_details) > 0) {
                    foreach ($request->education_details as $new) {
                        if ($new['course'] != '') {
                            $education_entry = new TeacherEducation;
                            $education_entry->fill($new);
                            $education_entry->teacher_id = $teacher->teacher_id;
                            $education_entry->save();
                        }
                    }
                }
            }
            return redirect()->route('admin.teachers.edit', [$teacher->teacher_id])->with('success', 'Teacher Education Has Been Updated');
        }
    }




    //update resume
    public function update_resume(Request $request)
    {
        $request->validate([
            "resume" => "required|required|mimetypes:application/pdf"
        ]);


        $teacher = Teachers::where('teacher_id', $request->teacher_id)->first();
        if ($teacher) {
            if ($request->has('resume')) {
                $location = public_path('uploads/teachers/resume/' . $teacher->teacher_id);
                $resume = 'res_' . $teacher->teacher_id . '_' . date('his') . '.' . $request->file('resume')->getClientOriginalExtension();
                if ($request->resume->move($location, $resume)) {
                    $teacher->resume = $resume;
                    if ($teacher->save()) {
                        return redirect()->route('admin.teachers.profile', [$teacher->teacher_id])->with('success', 'Teacher Resume Has Been Updated');
                    }
                }
            }
        }
    }

    //update profile picture
    public function update_picture(Request $request)
    {
        $request->validate([
            "picture" => "mimes:jpeg,jpg,png,gif|required"
        ]);

        $teacher = Teachers::where('teacher_id', $request->teacher_id)->first();
        if ($teacher) {
            if ($request->has('picture')) {
                $location = public_path('uploads/teachers/picture/' . $teacher->teacher_id);
                $resume = 'img_' . $teacher->teacher_id . '_' . date('his') . '.' . $request->file('picture')->getClientOriginalExtension();
                if ($request->picture->move($location, $resume)) {
                    $teacher->picture = $resume;
                    if ($teacher->save()) {
                        return redirect()->route('admin.teachers.profile', [$teacher->teacher_id])->with('success', 'Teacher Resume Has Been Updated');
                    }
                }
            }
        }
    }

    //function for show documents
    public function show_documents($id){
        if(isset($id) && $id !='' || $id != 0){
            $teacher = Teachers::with('documents')->where('teacher_id',$id)->first();
            return view('backend.teacher.documents', compact('teacher'));
        }
    }

    //store documents
    public function store_documents(Request $request){
        $request->validate([
            'teacher_id'=>'required',
            'doc_name'=>'required',
            'doc_file'=>'required'
        ]);

        $ext = ['pdf','png', 'jpg', 'jpeg'];
        $file_ext = $request->file('doc_file')->getClientOriginalExtension();
        $file_name = 'doc_'.date('his').'.'.$request->doc_file->getClientOriginalExtension();

        if(!in_array($file_ext,$ext)){
           return redirect()->route('admin.teachers.documents', [$request->teacher_id])->with('error','Please Upload pdf or image file');
        }

        $location = public_path('/uploads/teachers/documents/'.$request->teacher_id);

        if($request->doc_file->move($location, $file_name)){
            $document = new TeacherDocuments;
            $data = [
                'teacher_id'=>$request->teacher_id,
                'doc_name' => $request->doc_name,
                'doc_file' => $file_name
            ];

            $document->fill($data);
            if($document->save()){
                return redirect()->route('admin.teachers.documents', [$request->teacher_id])->with('success','Document Has Been Uploaded');
            }else{
                return redirect()->route('admin.teachers.documents', [$request->teacher_id])->with('error','Something got wrong');
            }
        }else{
            return redirect()->route('admin.teachers.documents', [$request->teacher_id])->with('error','Unable to Upload Image');
        }
    }

public function delete_document($id){
    $teacher = TeacherDocuments::where('teacher_document_id', $id)->first();
  if($teacher){
    if($teacher->delete()){
        return redirect()->route('admin.teachers.documents', [$teacher->teacher_id])->with('success','Document has been deleted.');
    }else{
        return redirect()->route('admin.teachers.documents', [$teacher->teacher_id])->with('error','Unable to Delete Document.');
  }
  }
}




}  //end of class
