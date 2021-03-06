<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductResourceCollection;


class ProductsController extends Controller
{
   
        public function index()
        {
            $products = auth()->user()->products;
     
            return response()->json([
                'success' => true,
                'data' => $products
            ]);
        }
     
        public function show($id)
        {
            $product = auth()->user()->products()->find($id);
     
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product with id ' . $id . ' not found'
                ], 400);
            }
     
            return response()->json([
                'success' => true,
                'data' => $product->toArray()
            ], 400);
        }
     
        public function store(Request $request)
        {
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
                'quantity' => 'required'
            ]);
     
            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->quantity = $request->quantity;

     
            if (auth()->user()->products()->save($product))
                return response()->json([
                    'success' => true,
                    'data' => $product->toArray()
                ]);
            else
                return response()->json([
                    'success' => false,
                    'message' => 'Product could not be added'
                ], 500);
        }
     
        public function update(Request $request, $id)
        {
            $product = auth()->user()->products()->find($id);
     
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product with id ' . $id . ' not found'
                ], 400);
            }
     
            $updated = $product->fill($request->all())->save();
     
            if ($updated)
                return response()->json([
                    'success' => true
                ]);
            else
                return response()->json([
                    'success' => false,
                    'message' => 'Product could not be updated'
                ], 500);
        }
     
        public function destroy($id)
        {
            $product = auth()->user()->products()->find($id);
     
            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product with id ' . $id . ' not found'
                ], 400);
            }
     
            if ($product->delete()) {
                return response()->json([
                    'success' => true
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Product could not be deleted'
                ], 500);
            }
        }
    }