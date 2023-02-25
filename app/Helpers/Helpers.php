<?php
use App\Models\backend\ActivityLog;
use App\Models\backend\UserActivity;


if (!function_exists('captureActivity')) {
    function captureActivity($data){
        $user_array = [];
        $id = Auth()->guard('admin')->user()->admin_user_id;
        $username = Auth()->guard('admin')->user()->first_name.' '.Auth()->guard('admin')->user()->last_name;
        $ses_id = Session::getId();

$user_array = [
    'user_id'=> $id,
    'user_name'=>$username,
    'session_id'=>$ses_id
];

$row = array_merge($user_array,$data);
        $log = new ActivityLog();
        $log->fill($row);
        $log->save();
    }
}


if (!function_exists('useractivitylogin')) {
    function useractivitylogin(){
        $id = Auth()->guard('admin')->user()->admin_user_id;
        $username = Auth()->guard('admin')->user()->first_name.' '.Auth()->guard('admin')->user()->last_name;
        $ses_id = Session::getId();
        $user = new UserActivity;
        $user->user_id= $id;
        $user->user_name = $username ;
        $user->session_id= $ses_id;
        $user->save();

    }
}

if (!function_exists('useractivitylogout')) {
    function useractivitylogout(){
        $id = Auth()->guard('admin')->user()->admin_user_id;
        $username = Auth()->guard('admin')->user()->first_name.' '.Auth()->guard('admin')->user()->last_name;
        $ses_id = Session::getId();
        $user = UserActivity::where('session_id', $ses_id)->first();
        if($user){
            $user->logout_time= date('Y-m-d H:i:s');
            $user->save();
            }

    }
}


if (!function_exists('captureActivityupdate')) {
    function captureActivityupdate($upd, $data){
        $user_array = [];
        $id = Auth()->guard('admin')->user()->admin_user_id;
        $username = Auth()->guard('admin')->user()->first_name.' '.Auth()->guard('admin')->user()->last_name;
        $ses_id = Session::getId();
        $user_array = ['user_id'=>$id, 'user_name'=>$username, 'session_id'=>$ses_id];
        $dataAttributes = array_map(function($value, $key) {
            return $key.'="'.$value.'"';
        }, array_values($upd), array_keys($upd));
        $dataAttributes = implode(' ', $dataAttributes);


        $data['description'] = $data['description'].' '.$dataAttributes;

$row = array_merge($user_array,$data);
        $log = new ActivityLog();
        $log->fill($row);
        $log->save();
    }
}


if (!function_exists('IND_money_format')) {
    function IND_money_format($num){
        $amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $num);
        return $amount;
    }
}

?>
