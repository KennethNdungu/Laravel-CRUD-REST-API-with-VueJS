<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OrderDetail;
use App\Http\Resources\OrderDetailResource;
use App\Http\Resources\OrderDetailResourceCollection;

class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():OrderDetailResourceCollection
    {

        return new OrderDetailResourceCollection(OrderDetail::paginate());
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
        //validate order detail data entry
        $request->validate([
            'order_id'=>'required|string',
            'product_id'=>'required|string'
        ]);

        //create new order detail
        $orderdetail=OrderDetail::create($request->all());
        $accessToken=$orderdetail->createToken('authToken')->accessToken;

        return new OrderDetailResource($orderdetail,$accessToken);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(OrderDetail $orderdetail):OrderDetailResource
    {
        //puts order detail into an array through the OrderDetailResource.
        return new OrderDetailResource($orderdetail);
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
    public function update(OrderDetail $orderdetail, Request $request):OrderDetailResource
    {
        //update order detail
        $orderdetail->update($request->all());

        return new OrderDetailResource($orderdetail);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderDetail $orderdetail)
    {
        $orderdetail->delete();

        return response()->json();
    }
}
