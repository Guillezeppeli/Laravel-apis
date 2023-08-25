<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
      //
      $recipes = Recipe::with('category')->where('status', 'active')->get();

      // Return the recipes as a JSON response
      return response()->json($recipes);
      
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
      //
      $validatedData = $request->validate([
          'title' => 'required',
          'description' => 'required',
          'ingredients' => 'required',
          'preparation_steps' => 'required',
          'cooking_time' => 'required',
          'category_id' => 'required|exists:categories,id',
          'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      ]);

      // Handle image upload (if provided)
      if ($request->hasFile('image')) {
          $imagePath = $request->file('image')->store('public/images');
          $validatedData['image'] = str_replace('public/', '', $imagePath);
  }

      // Create a new recipe using the validated data
      $recipe = Recipe::create($validatedData);

      // Load the associated category
      $recipe->load('category');

        // Return the created recipe as a JSON response with a 201 status code
        return response()->json($recipe, 201);

  }

  /**
   * Display the specified resource.
   */
  public function show(Recipe $recipe)
    {
          // Check if the recipe is active
        if ($recipe->status !== 'active') {
        // Return a 404 response if the recipe is not active
        return response()->json(['message' => 'Recipe not found'], 404);
    }
        // If the recipe is active, load the associated category and return it
        //Load the associated category
        $recipe->load('category');

        // Return the specified recipe as a JSON response
        return response()->json($recipe);
  }

  
  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Recipe $recipe)
{

    // Validate the request data
    $validatedData = $request->validate([
        'title' => 'required',
        'description' => 'required',
        'ingredients' => 'required',
        'preparation_steps' => 'required',
        'cooking_time' => 'required',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    // Handle image upload (if provided)
    if ($request->hasFile('image')) {
        // Delete the existing image if it exists
        if ($recipe->image) {
            Storage::delete('public/' . $recipe->image);
        }

        // Upload and save the new image
        $imagePath = $request->file('image')->store('public/images');
        $validatedData['image'] = str_replace('public/', '', $imagePath);
    }
    // Update the recipe with the validated data
    $recipe->update($validatedData);

    // Load the associated category
    $recipe->load('category');

    // Return the updated recipe as a JSON response
    return response()->json($recipe);
}

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Recipe $recipe)
  {
      // Delete the specified recipe
      $recipe->update(['status' => 'inactive']);

      // Return a JSON response with a success message
      return response()->json(['message' => 'Recipe status changed to inactive successfully']);
  }
}
