<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\backend\AdminUsers;
use Carbon\Carbon;
use Auth;
use Hash;
use Session;

class AdminController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth:admin');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // echo "string";exit;
    return view('backend.admin.dashboard');
  }
  public function showusers()
    {
      //  dd('welcoome');
        $adminusers = AdminUsers::orderBy('admin_user_id', 'DESC')->get();
        return view('backend.internalusers.index', compact('internalusers'));
    }



} //end of class
