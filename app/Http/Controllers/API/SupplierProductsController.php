<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SupplierProduct;
use App\Http\Resources\SupplierProductResource;
use App\Http\Resources\SupplierProductResourceCollection;

class SupplierProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():SupplierProductResourceCollection
    {

        return new SupplierProductResourceCollection(SupplierProduct::paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate supplier product data entry
        $request->validate([
            'supply_id'=>'required|string',
            'product_id'=>'required|string'
        ]);

        //create new supplier product
        $supplierproduct=SupplierProduct::create($request->all());

        $accessToken=$supplierproduct->createToken('authToken')->accessToken;


        return new SupplierProductResource($supplierproduct,$accessToken);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierProduct $supplierproduct):SupplierProductResource
    {
        //puts supplier product into an array through the SupplierProductResource.
        return new SupplierProductResource($supplierproduct);
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
    public function update(SupplierProduct $supplierproduct, Request $request):SupplierProductResource
    {
        //update supplier product
        $supplierproduct->update($request->all());

        return new SupplierProductResource($supplierproduct);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierProduct $supplierproduct)
    {
        $supplierproduct->delete();

        return response()->json();
    }
}
