<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SupplierProduct;
use App\Http\Resources\SupplierProductResource;
use App\Http\Resources\SupplierProductResourceCollection;

class SupplierProductsController extends Controller
{
    public function index()
        {
            $supplierproducts = auth()->user()->supplierproducts;
     
            return response()->json([
                'success' => true,
                'data' => $supplierproducts
            ]);
        }
     
        public function show($id)
        {
            $supplierproduct = auth()->user()->supplierproducts()->find($id);
     
            if (!$supplierproduct) {
                return response()->json([
                    'success' => false,
                    'message' => 'Supplier Product with id ' . $id . ' not found'
                ], 400);
            }
     
            return response()->json([
                'success' => true,
                'data' => $supplierproduct->toArray()
            ], 400);
        }
     
        public function store(Request $request)
        {
            $this->validate($request, [
                'supply_id' => 'required',
                'product_id' => 'required'
            ]);
     
            $supplierproduct = new SupplierProduct();
            $supplierproduct->supply_id = $request->supply_id;
            $supplierproduct->product_id = $request->product_id;
            
     
            if (auth()->user()->supplierproducts()->save($supplierproduct))
                return response()->json([
                    'success' => true,
                    'data' => $supplierproduct->toArray()
                ]);
            else
                return response()->json([
                    'success' => false,
                    'message' => 'Supplier Product could not be added'
                ], 500);
        }
     
        public function update(Request $request, $id)
        {
            $supplierproduct = auth()->user()->supplierproducts()->find($id);
     
            if (!$supplierproduct) {
                return response()->json([
                    'success' => false,
                    'message' => 'Supplier Product with id ' . $id . ' not found'
                ], 400);
            }
     
            $updated = $supplierproduct->fill($request->all())->save();
     
            if ($updated)
                return response()->json([
                    'success' => true
                ]);
            else
                return response()->json([
                    'success' => false,
                    'message' => 'Supplier Product could not be updated'
                ], 500);
        }
     
        public function destroy($id)
        {
            $supplierproduct = auth()->user()->supplierproducts()->find($id);
     
            if (!$supplierproduct) {
                return response()->json([
                    'success' => false,
                    'message' => 'Supplier Product with id ' . $id . ' not found'
                ], 400);
            }
     
            if ($supplierproduct->delete()) {
                return response()->json([
                    'success' => true
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Supplier Product could not be deleted'
                ], 500);
            }
        }
}
