<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
   
    public function __construct()
    {
        
        $this->middleware('auth:admin');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/home';
   
    public function index()
    {
        return view('admin.home');
    }

    public function logout()
    {
        Auth::logout();
        $notification=array(
            'messege'=>' Admin Logout Successfully ',
            'alert-type'=>'success'
             );
         return Redirect()->route('admin.show')->with($notification);
    }
    public function ChangePassword(){
        return view('admin.auth.passwords.change');
    }
    public function Update_pass(Request $request)
    {
      $password=Auth::user()->password;
      $oldpass=$request->oldpass;
      $newpass=$request->password;
      $confirm=$request->password_confirmation;
      if (Hash::check($oldpass,$password)) {
           if ($newpass === $confirm) {
                      $user=Admin::find(Auth::id());
                      $user->password=Hash::make($request->password);
                      $user->save();
                      Auth::logout();  
                      $notification=array(
                        'messege'=>'Password Changed Successfully ! Now Login with Your New Password',
                        'alert-type'=>'success'
                         );
                       return Redirect(route('admin'))->with($notification); 
                 }else{
                     $notification=array(
                        'messege'=>'New password and Confirm Password not matched!',
                        'alert-type'=>'error'
                         );
                       return Redirect()->back()->with($notification);
                 }     
      }else{
        $notification=array(
                'messege'=>'Old Password not matched!',
                'alert-type'=>'error'
                 );
               return Redirect()->back()->with($notification);
      }
    }

}
