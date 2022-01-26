<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
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
        $categories = Category::all();
        $brands = Brand::all();
        return view('product.create',compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $request->validate([
            "title" => "required|min:3|max:100",
            "price" => "required|integer|min:10",
            "stock" => "required|integer|min:1",
            "description" => "required",
            "category" => "required",
            "feature_image" => "required|mimes:jpg,bmp,png",
            "photo" => "required",
            "photo.*" => "mimes:jpg,bmp,png",
        ]);

        $featureImg = $request->file("feature_image");
        $newFeatureImageName = uniqid()."_feature_image.".$featureImg->extension();
        $featureImg->storeAs("public/feature-image/",$newFeatureImageName);

        $product = new Product();
        $product->title = $request->title;
        $product->slug = Str::slug($request->title);
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;
        $product->excerpt = Str::words($request->description,30);
        $product->feature_image = $newFeatureImageName;
        $product->user_id = Auth::id();
        $product->categoy_id = $request->category;
        $product->brand_id = $request->brand;
        $product->gender = $request->gender;
        $product->save();


        foreach ($request->file("photo") as $photo){
            $newName = uniqid()."_product_image.".$photo->extension();
            $photo->storeAs("public/product_image/",$newName);
            $photo = new Photo();
            $photo->name = $newName;
            $photo->product_id = $product->id;
            $photo->user_id = Auth::id();
            $photo->save();
        }


        return redirect()->route("home.product.index")->with("toast",Info::showToast("success","New Product Added"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
