<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\AdminUsers;
use App\Models\backend\forget;
use Illuminate\Http\Request;
use App\Models\backend\Years;

use Session;
use Redirect;
use PHPMailer\PHPMailer;
use DB;
use Hash;
use Illuminate\Support\Facades\Hash as FacadesHash;
use phpseclib3\Crypt\Hash as CryptHash;
use Symfony\Component\Console\Input\Input;

class FrgtpassController extends Controller
{
    public function frgtpassword()
    {
      return view('backend.account.forget_password');
    }




    public function sendotp(Request $request)
    {


        // dd($request->all());
        $this->validate(request(), [
            'email' => 'required',
        ]);
        $user=AdminUsers::where('email',$request->email)->first();
        // dd($user->toarray());
                //   $user = $request->admin_user_id;

        if($user==null){
            return redirect()->route('frgtpassword')->withErrors(['Inavlid Email!!!Please Try with Valid Email']);
        }
        try
        {
//             $token = random();
// dd($token);
            $email = $request->email;
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < 10; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }
            // dd($randomString);
            // return $randomString;
            $mail = new PHPMailer\PHPMailer();
            $mail->IsSMTP();

            $mail->CharSet = "utf-8";// set charset to utf8
            //   $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            //for live start
            // $mail->Host       = "localhost";
            // $mail->SMTPSecure = "tls";
            // $mail->SMTPDebug  = 0;
            // $mail->SMTPAuth   = false;
            // $mail->Mailer     ="smtp";
            // $mail->Port       = 25;
            // $mail->Username = "";
            // $mail->Password = '';
            //for live end

            //for local start
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587; // or 465
            $mail->Username = "irfanp@parasightsolutions.com";
            $mail->Password = 'irf@np@th@n7778';
            //for local end
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->isHTML(true);
            $mail->SetFrom('info@podar.com','Podar');
            $mail->AddAddress($email);
            $mail->Subject = "Passowrd Reset link";
            // $mail->Body = 'Password reset <a href="url("resettoken/{token}")' . $randomString.'">Click Here to change Password</a>';
            $mail->Body = 'Password reset <a href="'.url("/resettoken/".$randomString).'">Click Here to change Password</a>';
// dd($mail->Body);
            $mail->Send();

            Session::put('email',$email);
            Session::put('admin_user_id ',$user->admin_user_id);

            if($user->otp!=null){
                $user=DB::table('admin_users')
                        ->where('email',$email)
                    ->update(array(
                        'token'=>$randomString
                    ));
            }else{
                $user->token=$randomString;
                $user->save();
            }


            // return redirect()->route('passwordform',['email'=>$email]);
            // view('frontend.users.login_password',compact('email'));
            //return view('frontend.users.otp',compact('email'));

             return redirect()->to('/thankyou')->with('success','Mobile Number Verified Successfully');

            return redirect()->to('/resettoken/'.$randomString)->with('success','Mobile Number Verified Successfully');

        }
        catch (phpmailerException $e) {
            echo $e->errorMessage();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }


    public function showResetPasswordForm(request $request) {


        // echo"hello";
$resetdata = AdminUsers::where('token',$request->token)->get();
// dd($resetdata);
if(isset($request->token) && count($resetdata) > 0){
    $user = AdminUsers::where('email' , $resetdata[0]['email'])->get();
    // dd($user);

}
       return view('backend.account.setpasswordform',compact('user'));
     }





    public function changeforgotpassword (request $request) {



        // $this->validate(request(), [
        //         'password' => 'required',
        //         'password_conformation' => 'required',

        //     ]);


        //     $new_password = $request->input('password');
        //     $newpassword = Hash::make($new_password);
        //     DB::table('admin_users')->where('id', $id)->update(array(
        //             'password' => $newpassword,

        //         ));









        // dd($request->all());
        $this->validate(request(), [
            'password' => 'required',
            'password_conformation' => 'required',

        ]);

        $user = AdminUsers::find($request->id);
        $user->password = ($request->password);
        // dd($user);
        $user->save();

        $years = Years::pluck('year', 'year');
        // return view('backend.account.loginform', compact('years'))->with('success', 'password changed succesfully');
         return redirect()->to('admin/login')->with('success', 'password changed succesfully');
        // return"<h1>your password was changed successfully</h1>";
        // return view('backend.account.//oginform');

     }





     public function forthankyou() {
        return view('backend.account.thankyou');
     }

    }
