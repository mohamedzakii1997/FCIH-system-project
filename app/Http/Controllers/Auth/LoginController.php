<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function customLogin(Request $req){
        if(Auth::attempt(['username'=>$req->input('username'),'password'=> $req->input('password')],false)){
            session(['guard'=>'web']);
            return redirect()->intended('/home');
        }else{
            if(Auth::guard('professor')->attempt(['username'=>$req->input('username'),'password'=> $req->input('password')],false)){
                session(['guard'=>'professor']);
                return redirect()->intended('/home');
            }else{
                if(Auth::guard('assistant')->attempt(['username'=>$req->input('username'),'password'=> $req->input('password')],false)){
                    session(['guard'=>'assistant']);
                    return redirect()->intended('/home');
                }else{
                    if(Auth::guard('admin')->attempt(['username'=>$req->input('username'),'password'=> $req->input('password')],false)){
                        session(['guard'=>'admin']);
                        return redirect()->intended('/admin/dashboard');
                    }else{
                        return view('loginPage',['error'=>true]);
                    }
                }
            }
        }
    }

}
