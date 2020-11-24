<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use DB;

class SubCategoryController extends Controller
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
        $category = Category::all();
        $subcategory = SubCategory::with('category')->get();

        return view('admin.subcat.index', compact('category', 'subcategory'));
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
        $validateData = $request->validate([
            'category_id' => 'required',
            'subcategory_name' => 'required',

        ]);
        $subcat = new Subcategory();
        $subcat->subcategory_name = $request->subcategory_name;
        $subcat->category_id = $request->category_id;
        $subcat->save();
        $notification = array(
            'messege' => 'Sub Category Inserted Successfully',
            'alert-type' => 'success'
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
        $subcat = DB::table('sub_categories')->where('id',$id)->first();
        $category = DB::table('categories')->get();
        return view('admin.subcat.edit',compact('subcat','category'));
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
        $data = array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        DB::table('sub_categories')->where('id',$id)->update($data);
        $notification=array(
                'messege'=>'Sub Category Updated Successfully',
                'alert-type'=>'success'
                 );
               return Redirect()->route('subcategory.index')->with($notification); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('sub_categories')->where('id',$id)->delete();
    $notification=array(
            'messege'=>'Sub Category Deleted Successfully',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }
}
