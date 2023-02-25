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

use Illuminate\Support\Facades\Validator;

use Spatie\Permission\Models\Role;


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


        // dd(Auth::user()->toArray());
        //    dd(Session::getId());




        return view('backend.admin.dashboard');
    }

    public function showusers()
    {
        //  dd('welcoome');
        $adminusers = AdminUsers::orderBy('admin_user_id', 'DESC')->get();
        return view('backend.admin.index', compact('adminusers'));
    }

    public function create()
    {
        $role = Role::get(['id', 'name'])->toArray();
        return view('backend.admin.create', compact('role'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:admin_users,email',
            'role' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password|min:6'
        ]);

        $user = new AdminUsers;
        $user->fill($request->all());
        if($user->save()){
             //activity Log
          $log = ['module'=>'Internal User', 'action' =>'Internal User Created' , 'description'=> 'New Internal User Created : '.$request->first_name];
          captureActivity($log);
        }
        return redirect('/admin/users')->with('success', 'New User Registered');
    }

    public function edit($id)
    {
        $userdata = AdminUsers::where('admin_user_id', $id)->first();
        $role = Role::get(['id', 'name']);
        return view('backend.admin.edit', compact('userdata', 'role'));
    }
    public function update(Request $request)
    {
        $update_data = $request->all();
        //unset($update_data['_token']);
        //  dd($update_data);
        $data = AdminUsers::where('admin_user_id', $request->admin_user_id)->get();
        if (count($data) > 0) {
            // $userdata = InternalUser::where('user_id', $request->id)->update($update_data);
            $userdata = AdminUsers::where('admin_user_id', $request->admin_user_id)->first();
            $original_cat = $userdata->first_name;
            $userdata->fill($request->all());
            if ($userdata->save()) {
                if($userdata->getChanges()){
                    // $upd = json_encode($school->getChanges());

                    //activity Log
                    $upd = $userdata->getChanges();


                    unset($upd['updated_at']);
                    $str = ['module'=>'Internal User', 'action' =>'Internal User Update' , 'description'=> 'Internal User Details Updated : '.$original_cat];

                    captureActivityupdate($upd , $str);
                }

                return redirect('/admin/users')->with('success', 'User Has Been Updated');
            }
        }
    }

    //delete user
    public function destroyUser($id)
    {
        $user = AdminUsers::where('admin_user_id', $id)->get();
        if (count($user) > 0) {
            if (AdminUsers::where('admin_user_id', $id)->delete()) {
                //activity log
            $dcat = '';

            if(isset($user[0]['first_name'])){
                $dcat =$user[0]['first_name'];
            }

            $log = ['module'=>'Internal User', 'action' =>'Internal User Deleted' , 'description'=> 'Internal User deleted : Internal User Name  = '. $dcat];
            captureActivity($log);
            //activity log
                return redirect('/admin/users')->with('success', 'User Has Been Deleted');
            }
        }
    }

    //update Status
    public function  updatestatus(Request $request)
    {
        $data = AdminUsers::where('admin_user_id', $request->admin_user_id)->get();
        if (count($data) > 0) {
            $userdata = AdminUsers::where('admin_user_id', $request->admin_user_id)->first();
            $userdata->fill($request->all());
            if ($userdata->save()) {
                return redirect('/admin/users')->with('success', 'User Status Been Updated');
            }
        }
    }

    public function myProfile()
    {

        $user_id = Auth::user()->admin_user_id;
        $details = AdminUsers::where('admin_user_id', $user_id)->first();
        return view('backend.admin.myprofile', compact('details'));
    }

    //update profile
    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'mobile_no' => 'required',
        ]);
        $userdata = AdminUsers::where('admin_user_id', $request->admin_user_id)->first();
        $userdata->fill($request->all());
        if ($userdata->save()) {
            return redirect('/admin')->with('success', 'User Details Has Been Updated');
        }
    }

    //change password
    public function changePassword()
    {
        $user_id = Auth::user()->admin_user_id;
        $details = AdminUsers::where('admin_user_id', $user_id)->first();
        return view('backend.admin.changepassword');
    }

    public function updatePassword(Request $request)
    {
        // dd($request->all() ,  bcrypt($request->new_password));
        $user_id = Auth::user()->admin_user_id;
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:5',
            'new_password_confirmation' => 'required|same:new_password|min:5'
        ]);
        $userdata = AdminUsers::where('admin_user_id', $user_id)->first();
        // dd($userdata->password);
        if (Hash::check($request->current_password, $userdata->password)) {
            $userdata->password = $request->new_password;
            if($userdata->save()){
                return redirect('/admin')->with('success', 'Password Has Been Changes');
            }else{
                dd('failed');
            }
        } else {
            dd('failed to hash');
            return redirect('/admin/changepassword')->with('error', 'You Enter Invalid Credentials');
        }
    }


}//end of class
