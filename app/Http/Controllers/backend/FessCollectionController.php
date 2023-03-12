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
use App\Models\backend\PaymentMethod;
use App\Models\backend\PaymentStatus;

use Carbon\Carbon;
use Session;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class FessCollectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        return view('backend.fees_collection.index');
    }

    //accept fees form
    public function create(){

        $students = Students::where('status',1)->pluck('student_name','student_id');
        $payment_method = PaymentMethod::pluck('payment_method','payment_method');
        $payment_status = PaymentStatus::pluck('payment_status','payment_status');
        //dd($students);
        return view('backend.fees_collection.accept_fees',compact('students','payment_method','payment_status'));
    }

    public function store(Request $request){
        dd($request);
    }


}  //end of class
