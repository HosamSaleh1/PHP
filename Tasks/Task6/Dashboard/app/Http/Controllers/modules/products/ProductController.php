<?php

namespace App\Http\Controllers\modules\products;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\traits\media;

class ProductController extends Controller
{
    use media;
    public function index()
    {
        $products = DB::table('products')->select('id','name_en AS name','price','quantity','status','code','created_at')->latest()->get();
        return view('modules.products.index',compact('products'));
    }

    public function create()
    {
        $subcategories = DB::table('subcategories')->select('id','name_en')->where('status',1)->get();
        $brands = DB::table('brands')->select('id','name_en')->where('status',1)->get();
        return view('modules.products.create',compact('brands','subcategories'));
    }

    public function edit($id)
    {
        $subcategories = DB::table('subcategories')->select('id','name_en')->where('status',1)->get();
        $brands = DB::table('brands')->select('id','name_en')->where('status',1)->get();
        $product = DB::table('products')->where('id',$id)->first();
        return view('modules.products.edit',compact('brands','subcategories','product'));
    }

    public function store(StoreProductRequest $request)
    {
        // upload image
        $photoName = $this->uploadImage($request->image,'products');
        // store product
        $data = $request->except('_token','submit','image');
        $data['image'] = $photoName;
        $data['code'] = date('dmY') . '-' . DB::table('subcategories')->select('name_en')->where('id',$request->subcategory_id)->first()->name_en . '-' . time();
        // dd($data);
        DB::table('products')->insert($data);
        // return page (depending on buttton) -> with message
        if($request->submit == 'index'){
            return redirect()->route('products.index')->with('success','Successfull Oepration');
        }else{
            return redirect()->back()->with('success','Successfull Oepration');;
        }
    }

    public function update(UpdateProductRequest $request,$id)
    {
        // if image exists => upload it => delete old one
        $data = $request->except('_token','_method','image');
        if($request->has('image')){
             // upload image
             $photoName = $this->uploadImage($request->image,'products');
            // delete image
            $product = DB::table('products')->where('id',$id)->first();
            $this->deleteImage($product->image,'products');
            $data['image'] = $photoName;
        }
        // update data in DB
        DB::table('products')->where('id',$id)->update($data);
        // redirect and display messaget 
        return redirect()->route('products.index')->with('success','Product Updated Successfully');

    }

    public function destroy($id)
    {
        // check if id exists
        $product = DB::table('products')->where('id',$id)->first();
        
        if($product){
            // delete image
            $this->deleteImage($product->image,'products');
            // delete product from db
            DB::table('products')->where('id',$id)->delete();
            return redirect()->back()->with('success','Product Deleted Successfully');
        }else{
            return redirect()->back()->with('error','Invalid Operation');
        }
        
    }

    public function changeStatus(Request $request,$id)
    {
        DB::table('products')->where('id',$id)->update(['status'=>(int) ! $request->status]);
        return redirect()->back()->with('success','Status Updated Successfully Successfully');
    }
}

// update => delete old photo

