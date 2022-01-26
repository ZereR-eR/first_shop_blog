@extends('layouts.app')

@section('title') Test Page @stop

@section("content")
    @php $links = ['product'=>route('home.product.index')] @endphp
    <x-breadcrumb current-page="create product" :links="$links"></x-breadcrumb>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-8">
            <x-card-frame title="Create Product">
                <form method="post" action="{{ route('home.product.store') }}" id="productCreate" enctype="multipart/form-data">
                    @csrf
                    <x-input label="Product Name" name="title" ></x-input>
                    <div class="row">
                        <div class="col-6">
                            <x-input label="Price" type="number" name="price" ></x-input>
                        </div>
                        <div class="col-6">
                            <x-input label="Stock" type="number" name="stock" ></x-input>
                        </div>
                    </div>
                    <x-text-area name="description" label="Product Description" row="20"></x-text-area>
                    <div class="d-flex align-items-end justify-content-between">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" required>
                            <label class="form-check-label" for="flexSwitchCheckDefault">
                                Confirm
                            </label>
                        </div>
                        <button class="btn btn-primary">Create Product</button>
                    </div>
                </form>

            </x-card-frame>
        </div>
        <div class="col-md-12 col-lg-12 col-xl-4">
            <x-card-frame title="Select Category & Brand">

                <div class="mb-3">
                    <label class="form-label">Select Category</label>
                    <select name="category" id="" class="form-select">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @error('category')
                            <p class="invalid-feedback small">{{ $message }}</p>
                            @enderror
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Select Brand</label>
                    <select name="brand" id="" class="form-select">
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                            @error('brand')
                            <p class="invalid-feedback small">{{ $message }}</p>
                            @enderror
                        @endforeach
                    </select>
                </div>


                <div class="mb-3">
                    <label class="form-label">Select Gender</label>
                    <select name="gender" id="" class="form-select">
                        @foreach(\App\Models\Info::$gender as $key=>$gender)
                            <option value="{{ $key }}">{{ ucfirst($gender) }}</option>
                            @error('gender')
                            <p class="invalid-feedback small">{{ $message }}</p>
                            @enderror
                        @endforeach
                    </select>
                </div>



                <div class="mb-3">
                    <x-input label="Feature Image" form="productCreate" type="file" name="feature_image"></x-input>

                </div>
                <div class="mb-3">
                    <label>Product Images</label>
                    <input type="file" name="photo[]" form="productCreate" multiple class="form-control @error('photo') is-invalid @enderror">
                    @error('photo')
                    <p class="invalid-feedback small">{{ $message }}</p>
                    @enderror
                    @error('photo.*')
                    <p class="invalid-feedback small">{{ $message }}</p>
                    @enderror
                </div>
            </x-card-frame>

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
    </div>
@stop



