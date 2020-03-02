<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Supplier;
use App\Http\Resources\SupplierResource;
use App\Http\Resources\SupplierResourceCollection;

class SuppliersController extends Controller
{
    public function index()
    {
        $suppliers = auth()->user()->suppliers;
 
        return response()->json([
            'success' => true,
            'data' => $suppliers
        ]);
    }
 
    public function show($id)
    {
        $supplier = auth()->user()->suppliers()->find($id);
 
        if (!$supplier) {
            return response()->json([
                'success' => false,
                'message' => 'Supplier with id ' . $id . ' not found'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $supplier->toArray()
        ], 400);
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
 
        $supplier = new Supplier();
        $supplier->name = $request->name;

 
        if (auth()->user()->suppliers()->save($supplier))
            return response()->json([
                'success' => true,
                'data' => $supplier->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Supplier could not be added'
            ], 500);
    }
 
    public function update(Request $request, $id)
    {
        $supplier = auth()->user()->suppliers()->find($id);
 
        if (!$supplier) {
            return response()->json([
                'success' => false,
                'message' => 'Supplier with id ' . $id . ' not found'
            ], 400);
        }
 
        $updated = $supplier->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Supplier could not be updated'
            ], 500);
    }
 
    public function destroy($id)
    {
        $supplier = auth()->user()->suppliers()->find($id);
 
        if (!$supplier) {
            return response()->json([
                'success' => false,
                'message' => 'Supplier with id ' . $id . ' not found'
            ], 400);
        }
 
        if ($supplier->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Supplier could not be deleted'
            ], 500);
        }
    }
}
