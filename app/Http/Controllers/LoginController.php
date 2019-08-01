<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class LoginController extends Controller
{
    public function create()
    {
       return view('register');
    }

    public function store(Request $request)
    {
        $data=request()->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required|alphaNum',
        ]);
        $users=new User([
            'name'=>$request->get('name'),
            'email'=>$request->get('email'),
            'password'=>bcrypt($request->get('password')),
        ]);
        $users->save();
}
public function view()
    {
        $users=User::all();
        return view('users',compact('users'));
    }

    public function login(Request $request)
    {
        $login=User::all();
        $email=$request->get('email');
        $password=$request->get('password');
        foreach($login as $login){
            if($login->email==$email && $login->password==$password){
                return redirect('/users');
            }
            else{
                return 'login failed';
            }
        }
    }
}