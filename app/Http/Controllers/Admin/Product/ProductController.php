<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Brand;
use DB;

class ProductController extends Controller
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
    public function index(Request $request,$category_id = null)
    {
        $product = DB::table('products')
        ->join('categories','products.category_id','categories.id')
        	->join('brands','products.brand_id','brands.id')
    				->select('products.*','categories.category_name','brands.brand_name')
    				->get();
        return view('admin.product.index', compact('product'));
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $brand = Brand::all();
        return view('admin.product.create', compact('category', 'brand'));
    }

    public function GetSubcat($category_id){
        $cat = SubCategory::where('category_id',$category_id)->get();
        return json_encode($cat);
 
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, []);

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->product_quantity = $request->product_quantity;
        $product->discount_price = $request->discount_price;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->brand_id = $request->brand_id;
        $product->product_size = $request->product_size;
        $product->product_color = $request->product_color;
        $product->selling_price = $request->selling_price;
        $product->product_details = $request->product_details;
        $product->video_link = $request->video_link;
        $product->main_slider = $request->main_slider;
        $product->hot_deal = $request->hot_deal;
        $product->best_rated = $request->best_rated;
        $product->trend = $request->trend;
        $product->mid_slider = $request->mid_slider;
        $product->hot_new = $request->hot_new;
        $product->buyone_getone = $request->buyone_getone;
        $product->status = 1;

        $image_one = $request->image_one;
        $image_two = $request->image_two;
        $image_three = $request->image_three;


        if ($image_one && $image_two && $image_three) {
     
            $image_full_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            $upload_path = 'public/media/product/';
            $image_url = $upload_path . $image_full_name;
            $success = $request->file('image_one')->move($upload_path, $image_full_name);
            $product->image_one = $image_url;


     
            $image_full_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            $upload_path = 'public/media/product/';
            $image_url = $upload_path . $image_full_name;
            $success = $request->file('image_two')->move($upload_path, $image_full_name);
            $product->image_two = $image_url;


    
            $image_full_name =hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            $upload_path = 'public/media/product/';
            $image_url = $upload_path . $image_full_name;
            $success = $request->file('image_three')->move($upload_path, $image_full_name);
            $product->image_three = $image_url;

            $product->save();
            $notification = array(
                'messege' => 'Product Inserted Successfully',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = DB::table('products')
        ->join('categories', 'products.category_id', 'categories.id')
        ->join('sub_categories', 'products.subcategory_id', 'sub_categories.id')
        ->join('brands', 'products.brand_id', 'brands.id')
        ->select('products.*','categories.category_name','brands.brand_name','sub_categories.subcategory_name')
        ->where('products.id',$id)
        ->first();
        return view('admin.product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product =Product::where('id',$id)->first();
        
        return view('admin.product.edit',compact('product'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $data = Product::where('id', $id)->first();
        $image = $data->image_one;
        $image2 = $data->image_two;
        $image3 = $data->image_three;
        unlink($image);
        unlink($image2);
        unlink($image3);
        Product::where('id', $id)->delete();
        $notification = array(
            'messege' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    
    }

    public function inactive($id)
    {
       Product::where('id', $id)->update(['status'=> 0]);
        $notification = array(
            'messege' => 'Product inactived Successfully',
            'alert-type' => 'success'
        );
        return Redirect(route('product.index'))->with($notification);
    }
    public function active($id)
    {
       Product::where('id', $id)->update(['status'=> 1]);
        $notification = array(
            'messege' => 'Product active Successfully',
            'alert-type' => 'success'
        );
        return Redirect(route('product.index'))->with($notification);
    }

    public function UpdateProductWithoutPhoto(Request $request,$id){
    
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['product_quantity'] = $request->product_quantity;
        $data['discount_price'] = $request->discount_price;
        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['selling_price'] = $request->selling_price;
        $data['product_details'] = $request->product_details;
        $data['video_link'] = $request->video_link;
        $data['main_slider'] = $request->main_slider;
        $data['hot_deal'] = $request->hot_deal;
        $data['best_rated'] = $request->best_rated;
        $data['trend'] = $request->trend;
        $data['mid_slider'] = $request->mid_slider;
        $data['hot_new'] = $request->hot_new;
        $data['buyone_getone'] = $request->buyone_getone;
        
        $update = DB::table('products')->where('id',$id)->update($data);
        if ($update) {
            $notification=array(
                'messege'=>'Product Successfully Updated',
                'alert-type'=>'success'
                 );
               return Redirect()->route('product.index')->with($notification);
        }else{
            $notification=array(
                'messege'=>'Nothing TO Update',
                'alert-type'=>'success'
                 );
               return Redirect()->route('product.index')->with($notification);
    
        }
    
     }
    
    
      public function UpdateProductPhoto(Request $request,$id){
    
          $old_one = $request->old_one;
          $old_two = $request->old_two;
          $old_three = $request->old_three;
    
        $data = array();
         
         $image_one = $request->file('image_one');
         $image_two = $request->file('image_two');
         $image_three = $request->file('image_three');
    
    
         if ($image_one) {
             unlink($old_one);
           $image_name = date('dmy_H_s_i');
           $ext = strtolower($image_one->getClientOriginalExtension());
           $image_full_name = $image_name.'.'.$ext;
           $upload_path = 'public/media/product/';
           $image_url = $upload_path.$image_full_name;
           $success = $image_one->move($upload_path,$image_full_name);
    
           $data['image_one'] = $image_url;
           $productimg = DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Image One Updated Successfully',
                'alert-type'=>'success'
                 );
               return Redirect()->route('product.index')->with($notification);
      }
      if ($image_two) {
             unlink($old_two);
           $image_name = date('dmy_H_s_i');
           $ext = strtolower($image_two->getClientOriginalExtension());
           $image_full_name = $image_name.'.'.$ext;
           $upload_path = 'public/media/product/';
           $image_url = $upload_path.$image_full_name;
           $success = $image_two->move($upload_path,$image_full_name);
    
           $data['image_two'] = $image_url;
           $productimg = DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Image Two Updated Successfully',
                'alert-type'=>'success'
                 );
               return Redirect()->route('product.index')->with($notification);
    
      }
      if ($image_three) {
             unlink($old_three);
           $image_name = date('dmy_H_s_i');
           $ext = strtolower($image_three->getClientOriginalExtension());
           $image_full_name = $image_name.'.'.$ext;
           $upload_path = 'public/media/product/';
           $image_url = $upload_path.$image_full_name;
           $success = $image_three->move($upload_path,$image_full_name);
    
           $data['image_three'] = $image_url;
           $productimg = DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Image Three Updated Successfully',
                'alert-type'=>'success'
                 );
               return Redirect()->route('product.index')->with($notification);
      }
    
    }
    

    }
    