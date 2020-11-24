<?php

namespace App\Http\Controllers\Admin\Coupon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Coupon;
use App\Models\Admin\Newslater;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupon = Coupon::all();
        return view('admin.coupon.index', compact('coupon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'coupon'=>'required',
            'discount'=>'required',
        ]);
        $coupon = new Coupon();
        $coupon->coupon = $request->coupon;
        $coupon->discount = $request->discount;
        $coupon->save();
        $notification=array(
            'messege'=>'Category Added Successfully',
            'alert-type'=>'success'
             );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::where('id',$id)->first();
        return view('admin.coupon.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'coupon'=>'required',
            'discount'=>'required',
        ]);
        $coupon = Coupon::find($id);
        $coupon->coupon = $request->coupon;
        $coupon->discount = $request->discount;
        $coupon->save();
        $notification=array(
            'messege'=>'Category Added Successfully',
            'alert-type'=>'success'
             );
        return redirect(route('coupon.index'))->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon =Coupon::find($id)->delete();
        $notification = array(
            'messege' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
    
   
   
}
