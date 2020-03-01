<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductResourceCollection;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ProductResourceCollection
     */
    public function index():ProductResourceCollection
    {

        return new ProductResourceCollection(Product::paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate product data entry
        $request->validate([
            'name'=>'required|string',
            'description'=>'required|string',
            'quantity'=>'required|string',
        ]);

        //create new product
        $product=Product::create($request->all());

        $accessToken=$product->createToken('authToken')->accessToken;


        return new ProductResource($product,$accessToken);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product):ProductResource
    {
        //puts product into an array through the ProductResource.
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, Request $request):ProductResource
    {
        //update product
        $product->update($request->all());

        return new ProductResource($product);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json();
    }
}
