@extends('layout.parent')
@section('title', 'Update Product')
@section('content')
    <div class="col-12">
        <form action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="col-6">
                    <label for="name_en">Name EN</label>
                    <input type="text" name="name_en" id="name_en" class="form-control" placeholder="" aria-describedby="helpId" value="{{$product->name_en}}">
                    @error('name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="name_ar">Name AR</label>
                    <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder="" aria-describedby="helpId" value="{{$product->name_ar}}">
                    @error('name_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" class="form-control" placeholder="" aria-describedby="helpId" value="{{$product->price}}">
                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" placeholder="" aria-describedby="helpId" value="{{$product->quantity}}">
                    @error('quantity')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-4">
                    <label for="">Status</label>
                    <div class="custom-control custom-radio">
                        <input {{$product->status == 1 ? 'checked' : ''}} class="custom-control-input" type="radio" id="customRadio1" name="status" value="1">
                        <label  for="customRadio1" class="custom-control-label">Active</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input {{$product->status == 0 ? 'checked' : ''}} class="custom-control-input" type="radio" id="customRadio12" name="status" value="0">
                        <label for="customRadio12" class="custom-control-label">Not Active</label>
                    </div>
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="sub">Sub Category</label>
                    <select name="subcategory_id" id="sub" class="form-control">
                       @foreach ($subcategories as $sub)
                            <option {{$product->subcategory_id == $sub->id ? 'selected' : ''}} value="{{$sub->id}}">{{$sub->name_en}}</option>
                       @endforeach
                    </select>
                    @error('subcategory_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="Brand">Brand</label>
                    <select name="brand_id" id="Brand" class="form-control">
                        @foreach ($brands as $brand)
                            <option {{$product->brand_id == $brand->id ? 'selected' : ''}}  value="{{$brand->id}}">{{$brand->name_en}}</option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <label for="desc_en">Description EN</label>
                    <textarea name="desc_en" class="form-control" id="desc_en" cols="30" rows="10">{{$product->desc_en}}</textarea>
                    @error('desc_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="desc_ar">Description AR</label>
                    <textarea name="desc_ar" class="form-control" id="desc_ar" cols="30" rows="10">{{$product->desc_ar}}</textarea>
                    @error('desc_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-12">
                    <input type="file" name="image" class="form-control" id="">
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-3 my-5">
                    <img src="{{url('images/products/'.$product->image)}}" alt="" class="w-100">
                </div>
            </div>
            <div class="form-group">
                    <button class="btn btn-warning" > Update Product </button>
            </div>
        </form>
    </div>
@endsection
