<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function changepassword(Request $request)
    {
        return view('auth.passwords.change');
    }
    public function updatepassword(Request $request)
    {
        $this->validate($request,[
            'oldpassword'=>'required',
            'password'=>'required|confirmed',
        ]);
       
        $hashedPassword = Auth::user()->password; 
        if(Hash::check($request->oldpassword, $hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success','Password is Changed Successfully !');
        }else {
            return redirect()->back()->with("error","Current Password is Invalid ");
        }

        }
        public function logout()
        {
            Auth::logout();
            $notification=array(
                'messege'=>'Successfully Logout',
                'alert-type'=>'success'
                 );
             return Redirect()->route('login')->with($notification);
        }
    }

