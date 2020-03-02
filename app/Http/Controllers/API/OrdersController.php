<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderResourceCollection;

class OrdersController extends Controller
{
    public function index()
        {
            $orders = auth()->user()->orders;
     
            return response()->json([
                'success' => true,
                'data' => $orders
            ]);
        }
     
        public function show($id)
        {
            $order = auth()->user()->orders()->find($id);
     
            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order with id ' . $id . ' not found'
                ], 400);
            }
     
            return response()->json([
                'success' => true,
                'data' => $order->toArray()
            ], 400);
        }
     
        public function store(Request $request)
        {
            $this->validate($request, [
                'order_number' => 'required'
            ]);
     
            $order = new Order();
            $order->order_number = $request->order_number;

     
            if (auth()->user()->orders()->save($order))
                return response()->json([
                    'success' => true,
                    'data' => $order->toArray()
                ]);
            else
                return response()->json([
                    'success' => false,
                    'message' => 'Order could not be added'
                ], 500);
        }
     
        public function update(Request $request, $id)
        {
            $order = auth()->user()->orders()->find($id);
     
            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order with id ' . $id . ' not found'
                ], 400);
            }
     
            $updated = $order->fill($request->all())->save();
     
            if ($updated)
                return response()->json([
                    'success' => true
                ]);
            else
                return response()->json([
                    'success' => false,
                    'message' => 'Order could not be updated'
                ], 500);
        }
     
        public function destroy($id)
        {
            $order = auth()->user()->orders()->find($id);
     
            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order with id ' . $id . ' not found'
                ], 400);
            }
     
            if ($order->delete()) {
                return response()->json([
                    'success' => true
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Order could not be deleted'
                ], 500);
            }
        }
}
