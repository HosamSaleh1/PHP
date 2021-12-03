<?php

namespace App\Http\Controllers\apis;

use App\Models\Brand;
use App\Models\Product;
use App\Http\traits\media;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\traits\apiTrait;
use Illuminate\Support\Facades\App;

class ProductController extends Controller
{
    use media, apiTrait;
    public function index(Request $request)
    {
        $lang = App::getLocale();
        $products = Product::select('id', "name_$lang AS name", "desc_$lang AS desc", 'price', 'quantity', 'status', 'created_at', 'image')->latest()->get();
        foreach ($products as $index => $product) {
            $product->image = url("/images/products/$product->image");
        }
        return $this->returnData(compact('products'));
    }

    public function create(Request $request)
    {
        $lang = $request->header('accept-language');
        $brands = Brand::select('id', "name_$lang AS name")->orderBy('name_'.$lang )->get();
        $subcategories = Subcategory::select('id', "name_$lang AS name")->orderBy('name_'.$lang )->get();
        return $this->returnData(compact('brands', 'subcategories'));
    }
    public function edit(Request $request,$id)
    {
        $lang = $request->header('accept-language');
        $brands = Brand::select('id', "name_$lang AS name")->orderBy('name_'.$lang )->get();
        $subcategories = Subcategory::select('id', "name_$lang AS name")->orderBy('name_'.$lang )->get();
        $product = Product::find($id);
        return $this->returnData(compact('product', 'brands', 'subcategories'));
    }

    public function store(StoreProductRequest $request)
    {
        $lang = $request->header('accept-language');
        // upload image
        $photoName = $this->uploadImage($request->image, 'products');
        // store product
        $data = $request->except('image');
        $data['image'] = $photoName;
        $data['code'] = date('dmY') . '-' . Subcategory::select('name_'.$lang )->where('id', $request->subcategory_id)->first()->{'name_'.$lang} . '-' . time();
        // dd($data);
        Product::insert($data);
        $message = __('message.product.success');
        return $this->returnSuccessMessage($message, 201);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        // if image exists => upload it => delete old one
        $data = $request->except('_method', 'image');
        if ($request->has('image')) {
            // upload image
            $photoName = $this->uploadImage($request->image, 'products');
            // delete image
            $product = Product::find($id);
            $this->deleteImage($product->image, 'products');
            $data['image'] = $photoName;
        }
        // update data in DB
        Product::where('id', $id)->update($data);
        // redirect and display messaget 
        $message = "Product Updated Successfully";
        return  $this->returnSuccessMessage($message);
    }

    public function destroy($id)
    {
        // check if id exists
        $product = Product::find($id);

        if ($product) {
            // delete image
            $this->deleteImage($product->image, 'products');
            // delete product from db
            Product::where('id', $id)->delete();
            $message = 'product deleted successfully';
            return $this->returnSuccessMessage($message);
        } else {
            $message = 'product Not Found ';
            return $this->returnErrorMessage($message, 404);
        }
    }
}
