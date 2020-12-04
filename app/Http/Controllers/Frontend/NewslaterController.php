<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Newslater;
use Illuminate\Http\Request;
use DB;

class NewslaterController extends Controller
{
    public function StoreNewslater(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|unique:newslaters|max:55',
        ]);
        $newslater = new Newslater();
        $newslater->email = $request->email;
        $newslater->save();
        $notification = array(
            'messege' => 'Thanks for Subscribing',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    
 public function OrderTraking(Request $request){
    $code = $request->code;
  
    $track = DB::table('orders')->where('status_code',$code)->first();
    if ($track) {
      
      return view('pages.tracking',compact('track'));
  
    }else{
      $notification=array(
              'messege'=>'Status Code Invalid',
              'alert-type'=>'error'
               );
             return redirect()->back()->with($notification);
  
    }
  
  
  
   }
  
  
}
