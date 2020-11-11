<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
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
         return Redirect()->route('admin.login')->with($notification);
    }
}
