@extends('layouts.app')

@section('title') Update Brand @stop

@section("content")
    @php $links = ["Manage Category"=>route('home.brand.create')] @endphp
    <x-breadcrumb current-page="Edit Brand" :links="$links"></x-breadcrumb>

    <div class="row">
        <div class="col-12">
            <x-card-frame title="Update Brand" right-menu-text="Create Brand" right-menu-link="{{ route('home.brand.create') }}">
                <form action="{{ route('home.brand.update',$brand->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row align-items-end">

                        <div class="col-6">
                            <div class="mb-3">
                                <x-input name="title" label="Edit Brand" value="{{ $brand->title }}"></x-input>
                            </div>
                            <div class="mb-3">
                                <x-input name="logo" type="file" label="Logo" ></x-input>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-lg btn-primary mb-3 float-end">Update</button>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="">
                                <img src="{{ asset("storage/logo/".$brand->logo) }}" width="400" height="400" class="float-end" alt="">
                            </div>
                        </div>
                    </div>

                </form>
            </x-card-frame>
        </div>
    </div>
@stop



