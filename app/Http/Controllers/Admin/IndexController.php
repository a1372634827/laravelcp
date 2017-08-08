<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;






class IndexController extends CommonController
{
    public function index()
    {
        return view('admin.index');
    }
    public function info()
    {
        return view('admin.info');
    }

//修改管理员密码
    public function pass()
    {
          if($input=Input::all()){

              $rules=[
                 'newpassword'=>'required|between:6,20|confirmed',

              ];

              $message=[
                  'newpassword.required'=>'新密码不能为空！',
                  'newpassword.between'=>'新密码必须在6-20位之间!',
                  'newpassword.confirmed'=>'再次填入密码必须与新密码一致!',


              ];
              $validator=Validator::make($input,$rules,$message);
                 if($validator->passes()){
                   $user=User::first();
                      $_pass=Crypt::decrypt($user->user_pass);
                      if($input['oldpassword']==$_pass){
                                 $user->user_pass=Crypt::encrypt($input['newpassword']);
                                 $user->update();
                          $errors='密码修改成功！';
                          return back()->withErrors(compact('errors'));

                      }else{
                          $errors='旧密码输入错误！';
                          return back()->withErrors(compact('errors'));


                      }



                 }else{

                 // dd($validator->errors()->all());
                     return back()->withErrors($validator);


                 }




          }else{


              return view('admin.pass');}

    }
}
