<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use App\Models\Categories;

class CategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Categories = Categories::paginate(10);
        return response()->json([
            'response'=> [
            'status'=> true,
            'messages'=> 'Resource Categories',
            'data'=> $Categories,
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
    public function store(StoreCategoriesRequest $request)
    {
       $validated = $request->validated();
       $categories = new Categories($validated);
       $categories->save();

       return response()->json([
        'response'=> [
        'status'=> true,
        'messages'=> 'Successfully Created Data',
        'data'=> $categories,
       ],
    ],201
);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id,Categories $categories)
    {
        $categories = Categories::findOrFail($id);
        
        return response()->json([
            'response'=> [
            'status'=> true,
            'messages'=> 'Show Specific Categories',
            'data'=> $categories,
           ],
        ],
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,UpdateCategoriesRequest $request)
    {
        $categories = Categories::findOrFail($id);
        $validated = $request->validated();
        $categories->update($validated);
 
        return response()->json([
         'response' => [
         'status'=> true,
         'messages'=> 'Successfully Updated Data',
         'data'=> $categories,
        ],
    ],
    );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id,Categories $categories)
    {
        $categories = Categories::findOrFail($id);
        $categories->delete();

        return response()->json([
            'response'=> [
            'status'=> true,
            'messages'=> 'Successfully Deleted Data',
            'data'=> $categories,
           ],
        ],
        );
    }
}
