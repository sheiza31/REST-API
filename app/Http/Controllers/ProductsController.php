<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\UpdateProductsRequest;
use App\Models\Products;
use App\Models\Categories;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::with('categories')->paginate(10);
        return response()->json([
            'response'=> [
            'status'=> true,
            'messages'=> 'Resource Product',
            'data'=> $products,
           ],
        
        ],200
    );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductsRequest $request)
    {
        $validated  = $request->validated();
        if ($request->hasFile('image')) {
            $filePath = Storage::disk('public')->put('files/product/image', request()->file('image'));
            $validated['image'] = $filePath;
        }
        $products = new Products($validated);
        $products->save();

        return response()->json([
            'response'=> [
            'status'=> true,
            'messages'=> 'Succesfully Created Product',
            'data'=> $products,
           ],
        ],201
    );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id,Products $products)
    {
        $products = Products::findOrFail($id);
        return response()->json([
            'response'=>[
                'status'=>true,
                'message'=>'Show Specific Resource Product',
                'data'=>$products,
              ],
            ],200
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,UpdateProductsRequest $request)
    {
        $products = Products::findOrFail($id);

        $validated = $request->validated();

        // If an info file is uploaded, update the file path and delete the old file if exists
        if ($request->hasFile('image')) {
            if (isset($products->image)) {
                Storage::disk('public')->delete($products->image);
            }
            $filePath = Storage::disk('public')->put('files/product/image', request()->file('image'), 'public');
            $validated['image'] = $filePath;
        }

        // Update the task with the validated data
       $products->update($validated);

       return response()->json([
        'response'=> [
        'status'=> true,
        'messages'=> 'Succesfully Updated Product',
        'data'=> $products,
       ],
    ],201
    );


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,Products $products)
    {
        $products = Products::findOrFail($id);

        // If an info file exists, delete it from storage
        if (isset($products->image)) {
            Storage::disk('public')->delete($products->image);
        }
        
        // Delete the products
        $products->delete($id);

        return response()->json([
            'response'=> [
            'status'=> true,
            'messages'=> 'Succesfully Deleted Product',
            'data'=> $products,
           ],
        ],200
        );
    }
}
