<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Info;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        return view("brand.create",compact("brands"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        $request->validate([
            "title" => "required|min:3|max:200|unique:brands,title",
            "logo" => "required|mimes:jpg,bmp,png",
        ]);
        $brand = new Brand();
        $brand->title = $request->title;
        $brand->slug = Str::slug($request->title);
        $brand->user_id = Auth::id();

        $file = $request->file("logo");
        $newName = uniqid()."_logo.".$file->extension();
        $file->storeAs('public/logo',$newName);
        $brand->logo = $newName;

        $brand->save();
        return redirect()->route('home.brand.create')->with("toast",Info::showToast("success","New Category Added"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        $brands = Brand::all();
        return view("brand.edit",compact("brand","brands"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $request->validate([
            "title" => "required|min:3|max:200|unique:brands,title,".$brand->id,
            "logo" => "required|mimes:jpg,png",
        ]);

        $brand->title = $request->title;
        $brand->slug = Str::slug($request->title);

        Storage::delete("public/logo/".$brand->logo);

        $file = $request->file('logo');
        $newName = uniqid()."_logo.".$file->extension();
        $file->storeAs('public/logo/',$newName);
        $brand->logo = $newName;

        $brand->update();
        return redirect()->route('home.brand.create')->with("toast",Info::showToast("success","New Category Added"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
