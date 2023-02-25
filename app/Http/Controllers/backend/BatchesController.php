<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//models
use App\Models\backend\Batches;
use Carbon\Carbon;
use Session;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class BatchesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin',['except' => ['fetch_batches']]);
    }

    public function index()
    {
        $batches = Batches::all();
        return view('backend.batch.index', compact('batches'));
    }

    public function create()
    {
        return view('backend.batch.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_name' => 'required|unique:batches,batch_name',
            'full_fees' => ['required', 'regex:/^(\d+(\.\d*)?)|(\.\d+)$/'],
            'fees' => ['required', 'regex:/^(\d+(\.\d*)?)|(\.\d+)$/'],
            'teaching_rate' => ['required', 'regex:/^(\d+(\.\d*)?)|(\.\d+)$/'],
            'status' => 'required',
        ]);

        $batch = new Batches;
        $batch->fill($request->all());
        if ($batch->save()) {
            return redirect()->route('admin.batches')->with('success', 'New Batch Has Been Added');
        } else {
            return redirect()->route('admin.batches')->with('error', 'Unable to Create Batch');
        }
    }

    public function edit($id)
    {
        if ($id != '' && $id != '') {
            $batch = Batches::where('batch_id', $id)->first();
            if ($batch) {
                return view('backend.batch.edit', compact('batch'));
            } else {
                return redirect()->route('admin.batches')->with('error', 'Batch not Found');
            }
        } else {
            return redirect()->route('admin.batches')->with('error', 'Invalid Request');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'batch_name' => 'required',
            'full_fees' => ['required', 'regex:/^(\d+(\.\d*)?)|(\.\d+)$/'],
            'fees' => ['required', 'regex:/^(\d+(\.\d*)?)|(\.\d+)$/'],
            'teaching_rate' => ['required', 'regex:/^(\d+(\.\d*)?)|(\.\d+)$/'],
            'status' => 'required',
        ]);

        $batch = Batches::where('batch_id', $request->batch_id)->first();
        if ($batch) {
            $batch->fill($request->all());
            if ($batch->save()) {
                return redirect()->route('admin.batches')->with('success', 'Batch Has Been Updated');
            } else {
                return redirect()->route('admin.batches')->with('error', 'Unable to Update Batch');
            }
        } else {
            return redirect()->route('admin.batches')->with('error', 'Something got wrong');
        }
    }

    public function delete($id)
    {
        $batch = Batches::where('batch_id', $id)->first();
        if ($batch) {
            if ($batch->delete()) {
                return redirect()->route('admin.batches')->with('error', 'Batch Has  been deleted');
            } else {
                return redirect()->route('admin.batches')->with('info', 'Unable to delete Batch');
            }
        } else {
            return redirect()->route('admin.batches')->with('info', 'Something got wrong');
        }
    }


    //function for load batched using ajax
    public function fetch_fees($id){
        $fees = Batches::where('batch_id',$id)->first();
        if($fees){
            print_r(json_encode($fees->toArray()));
        }


    }
}
