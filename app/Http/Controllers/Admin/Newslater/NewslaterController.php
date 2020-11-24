<?php

namespace App\Http\Controllers\Admin\Newslater;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Newslater;


class NewslaterController extends Controller
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
        $sub = Newslater::all();
        return view('admin.newslater.index', compact('sub'));
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Newslater::where('id', $id)->delete();
        $notification = array(
            'messege' => 'Subscriber Deleted Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
