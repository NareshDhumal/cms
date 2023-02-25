<?php

namespace App\Http\Controllers\backend;
use App\Models\backend\Years;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use Session;

class AccountController extends Controller
{

  public function __construct()
  {
    $this->middleware('guest:admin', ['except' => ['logout','changeYear']]);
  }

  public function showloginform()
  {
      $years = Years::pluck('year', 'year');
      return view('backend.account.loginform', compact('years'));
  }

  public function login(Request $request)
    {

      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);

      // Attempt to log the user in
      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember, 'account_status',1))
      {
        // if successful, then redirect to their intended location
        // return redirect()->back();
        // dd(Auth()->guard('admin')->user());
        if (isset(Auth()->guard('admin')->user()->admin_user_id))
        {
            // dd(Auth()->guard('admin')->user());
            if(Auth()->guard('admin')->user()->account_status == 0)
            {
                Auth::guard('admin')->logout();
                return back()->withErrors([
                    'message' => 'Your account has been deactivated, Please contact 3P team to reactivate your account.'
                ]);
            }
        }
        Session::put('year',$request->year);
        return redirect()->intended(route('admin.dashboard'));
        // return redirect()->intended(url()->previous());
      }
      else
      {
        return back()->withErrors([
            'message' => 'The email or password is incorrect, please try again'
        ]);
      }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

    public function changeYear(Request $request){
        Session::put('year',$request->year);
    }

}
