<?php

namespace App\Http\Controllers\Admin\BackOrder;

use App\Http\Controllers\Controller;
use DB;

class ReturnController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function ReturnRequest()
    {

        $order = DB::table('orders')->where('return_order', 1)->get();
        return view('admin.return.request', compact('order'));
    }


    public function ApproveReturn($id)
    {
        DB::table('orders')->where('id', $id)->update(['return_order' => 2]);
        $notification = array(
            'messege' => 'Order Return Success',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }


    public function AllReturn()
    {
        $order = DB::table('orders')->where('return_order', 2)->get();
        return view('admin.return.all', compact('order'));
    }


    public function ProductStock()
    {

        $stock = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('brands', 'products.brand_id', 'brands.id')
            ->select('products.*', 'categories.category_name', 'brands.brand_name')
            ->get();
    
        return view('admin.stock.show', compact('stock'));
    }
}
