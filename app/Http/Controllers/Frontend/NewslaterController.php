<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Newslater;
use Illuminate\Http\Request;

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
}
