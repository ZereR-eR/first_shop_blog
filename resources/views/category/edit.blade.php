@extends('layouts.app')

@section('title') Update Category @stop

@section("content")
    @php $links = ["Manage Category"=>route('home.category.create')] @endphp
    <x-breadcrumb current-page="Edit Category" :links="$links"></x-breadcrumb>

    <div class="row">
        <div class="col-12">
            <x-card-frame title="Update Category" right-menu-text="Create Category" right-menu-link="{{ route('home.category.create') }}">
                <form action="{{ route('home.category.update',$category->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row align-items-end">
                        <div class="col-4">
                            <x-input name="title" label="Edit Category" value="{{ $category->title }}"></x-input>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-lg btn-primary mb-3">Update</button>
                        </div>
                    </div>

                </form>
                @include('category.list')
            </x-card-frame>
        </div>
    </div>
@stop



