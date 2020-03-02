<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OrderDetail;
use App\Http\Resources\OrderDetailResource;
use App\Http\Resources\OrderDetailResourceCollection;

class OrderDetailsController extends Controller
{
    public function index()
        {
            $orderdetails = auth()->user()->orderdetails;
     
            return response()->json([
                'success' => true,
                'data' => $orderdetails
            ]);
        }
     
        public function show($id)
        {
            $orderdetail = auth()->user()->orderdetails()->find($id);
     
            if (!$orderdetail) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order details with id ' . $id . ' not found'
                ], 400);
            }
     
            return response()->json([
                'success' => true,
                'data' => $orderdetail->toArray()
            ], 400);
        }
     
        public function store(Request $request)
        {
            $this->validate($request, [
                'order_id' => 'required',
                'product_id' => 'required'
            ]);
     
            $orderdetail = new OrderDetail();
            $orderdetail->order_id = $request->order_id;
            $orderdetail->product_id = $request->product_id;

     
            if (auth()->user()->orderdetails()->save($orderdetail))
                return response()->json([
                    'success' => true,
                    'data' => $orderdetail->toArray()
                ]);
            else
                return response()->json([
                    'success' => false,
                    'message' => 'Order detail could not be added'
                ], 500);
        }
     
        public function update(Request $request, $id)
        {
            $orderdetail = auth()->user()->orderdetails()->find($id);
     
            if (!$orderdetail) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order detail with id ' . $id . ' not found'
                ], 400);
            }
     
            $updated = $orderdetail->fill($request->all())->save();
     
            if ($updated)
                return response()->json([
                    'success' => true
                ]);
            else
                return response()->json([
                    'success' => false,
                    'message' => 'Order detail could not be updated'
                ], 500);
        }
     
        public function destroy($id)
        {
            $orderdetail = auth()->user()->orderdetails()->find($id);
     
            if (!$orderdetail) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order detail with id ' . $id . ' not found'
                ], 400);
            }
     
            if ($orderdetail->delete()) {
                return response()->json([
                    'success' => true
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Order detail could not be deleted'
                ], 500);
            }
        }
}
