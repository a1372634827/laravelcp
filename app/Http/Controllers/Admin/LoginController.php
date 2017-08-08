<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use App\Http\Model\User;





require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
    public function login()
    {
        if($input=Input::all()){

            if(strtolower($input['yzm'])!= $_SESSION['code'] ){
                return back()->with('msg','验证码错误！');
            }
            $user=User::first();
         if($user->user_name!=$input['user_name']||Crypt::decrypt($user->user_pass)!=$input['user_pass'])
           {
               return back()->with('msg','用户名或者密码错误！');

           }
              session(['user'=>$user]);

           return redirect('admin/index');

        }else{


            return view('admin.login');
        }

    }

    public function code()
    {
        $code=new \Code;
      echo $code->doimg();
        $_SESSION['code'] = $code->getCode();


    }
    public function quit()
    {
        session(['user'=>null]);
        return view('admin.login');

    }

   /* public function crypt()
    {
        //产生的密码字符串少于256
      $str='123456';
      echo Crypt::encrypt($str);

    }*/



}
