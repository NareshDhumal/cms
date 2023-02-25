<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//models
use App\Models\backend\AcademicYears;
use Carbon\Carbon;
use Session;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class AcademicYearController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $years = AcademicYears::orderBy('academic_year_id', 'desc')->get();
        return view('backend.academic_year.index', compact('years'));
    }

    public function create()
    {
        return view('backend.academic_year.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'academic_year' => 'required|unique:academic_years,academic_year'
        ]);

        $year = new AcademicYears;
        $year->fill($request->all());
        if ($year->save()) {
            return redirect()->route('admin.year')->with('success', 'New Academice Year Has Been Added');
        } else {
            return redirect()->route('admin.year')->with('error', 'Unable to Create Year');
        }
    }

    public function edit($id)
    {
        if ($id != '' && $id != '') {
            $year = AcademicYears::where('academic_year_id', $id)->first();
            if ($year) {
                return view('backend.academic_year.edit', compact('year'));
            } else {
                return redirect()->route('admin.year')->with('error', 'Data not Found');
            }
        } else {
            return redirect()->route('admin.year')->with('error', 'Invalid Request');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'academic_year' => 'required'
        ]);

        $year = AcademicYears::where('academic_year_id', $request->academic_year_id)->first();
        if ($year) {
            $year->fill($request->all());
            if ($year->save()) {
                return redirect()->route('admin.year')->with('success', 'Academice Year Has Been Updated');
            } else {
                return redirect()->route('admin.year')->with('error', 'Unable to Update Year');
            }
        }else{
            return redirect()->route('admin.year')->with('error', 'Something got wrong');
        }
    }

    public function delete($id)
    {
        $year = AcademicYears::where('academic_year_id', $id)->first();
        if ($year) {
           if ( $year->delete()) {
                return redirect()->route('admin.year')->with('error', 'Academic Year deleted');
            } else {
                return redirect()->route('admin.year')->with('info', 'Unable to delete Year');
            }
        }else{
            return redirect()->route('admin.year')->with('info', 'Something got wrong');
        }
    }
}
