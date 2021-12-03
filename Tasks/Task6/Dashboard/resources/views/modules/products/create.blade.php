@extends('layout.parent')
@section('title', 'Create Product')
@section('content')
    <div class="col-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    @include('includes.message')
    <div class="col-12">
        <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="col-6">
                    <label for="name_en">Name EN</label>
                    <input type="text" name="name_en" id="name_en" class="form-control" placeholder="" aria-describedby="helpId" value="{{old('name_en')}}">
                </div>
                <div class="col-6">
                    <label for="name_ar">Name AR</label>
                    <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder="" aria-describedby="helpId" value="{{old('name_ar')}}">
                </div>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" class="form-control" placeholder="" aria-describedby="helpId" value="{{old('price')}}">
                </div>
                <div class="col-6">
                    <label for="quauntity">Quantity</label>
                    <input type="number" name="quantity" id="quauntity" class="form-control" placeholder="" aria-describedby="helpId" value="{{old('quantity',1)}}">
                </div>
            </div>
            <div class="form-row">
                <div class="col-4">
                    <label for="">Status</label>
                    <div class="custom-control custom-radio">
                        <input {{old('status') === 1 ? 'checked' : ''}} class="custom-control-input" type="radio" id="customRadio1" name="status" value="1">
                        <label for="customRadio1" class="custom-control-label">Active</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input  {{old('status') === 0 ? 'checked' : ''}} class="custom-control-input" type="radio" id="customRadio12" name="status" value="0">
                        <label for="customRadio12" class="custom-control-label">Not Active</label>
                    </div>
                </div>
                <div class="col-4">
                    <label for="sub">Sub Category</label>
                    <select name="subcategory_id" id="sub" class="form-control">
                        <option value="" disabled selected>Choose..</option>
                       @foreach ($subcategories as $sub)
                            <option {{old('subcategory_id') == $sub->id ? 'selected' : ''}} value="{{$sub->id}}">{{$sub->name_en}}</option>
                       @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <label for="Brand">Brand</label>
                    <select name="brand_id" id="Brand" class="form-control">
                        <option value="" disabled selected>Choose..</option>
                        @foreach ($brands as $brand)
                            <option {{old('brand_id') == $brand->id ? 'selected' : ''}} value="{{$brand->id}}">{{$brand->name_en}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="col-6">
                    <label for="desc_en">Description EN</label>
                    <textarea name="desc_en" class="form-control" id="desc_en" cols="30" rows="10">{{old('desc_en')}}</textarea>
                </div>
                <div class="col-6">
                    <label for="desc_ar">Description AR</label>
                    <textarea name="desc_ar" class="form-control" id="desc_ar" cols="30" rows="10">{{old('desc_ar')}}</textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="col-12">
                    <input type="file" name="image" class="form-control" id="">
                </div>
            </div>
            <div class="form-group mt-3">
                    <button class="btn btn-primary" name="submit" value="create"> Create Product & Return </button>
                    <button class="btn btn-warning" name="submit" value="index"> Create Product </button>
            </div>
            </div>
        </form>
    </div>
@endsection
