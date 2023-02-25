<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\ActivityLog;
use App\Models\backend\AdminUsers;
use App\Models\backend\UserActivity;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(){

         $users = ActivityLog::orderby('activity_log_id', 'desc')->get();
         return view('backend.logs.index', compact('users'));

    }

    public function userlogs()
    {
        return view('backend.logs.userlogs');
    }
}
