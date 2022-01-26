@extends('layouts.app')

@section('title') Brand Manager @stop

@section("content")
    <x-breadcrumb current-page="Brand Manager"></x-breadcrumb>

    <div class="row">
        <div class="col-12">
            <x-card-frame title="Brand Manager">
                <form action="{{ route('home.brand.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row align-items-end">
                        <div class="col-4">
                            <x-input name="title" label="New Brand" focus="autofocus"></x-input>
                        </div>
                        <div class="col-4">
                            <x-input name="logo" type="file" label="Logo" ></x-input>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-lg btn-primary mb-3">Add New</button>
                        </div>
                    </div>

                </form>
                @include('brand.list')
            </x-card-frame>
        </div>
    </div>
@stop



