<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::all();

        // Return the categories as a JSON response
        return response()->json($categories);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|unique:categories',
        ]);

        // Create a new category using the validated data
        $category = Category::create($validatedData);

        // Return the created category as a JSON response with a 201 status code
        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
        ]);

        // Update the category with the validated data
        $category->update($validatedData);

        // Return the updated category as a JSON response
        return response()->json($category);
    }

        /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Set the category as inactive by updating the 'active' field to 'inactive'
        $category->update(['status' => 'inactive']);

        // Return a JSON response with a success message
        return response()->json(['message' => 'Category status changed to inactive successfully']);
    }
}
