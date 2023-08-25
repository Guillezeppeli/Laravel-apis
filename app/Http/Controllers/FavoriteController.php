<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Retrieve all favorites from the database
        $favorites = Favorite::all();

        // Return the favorites as a JSON response
        return response()->json($favorites);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'recipe_id' => 'required|exists:recipes,id',
        ]);

        // Create a new favorite using the validated data
        $favorite = Favorite::create($validatedData);

        // Return the created favorite as a JSON response with a 201 status code
        return response()->json($favorite, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        // Return the specified favorite as a JSON response
        return response()->json($favorite);
    }
    /**

     * Update the specified resource in storage.
     */
    public function update(Request $request, Favorite $favorite)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'recipe_id' => 'required|exists:recipes,id',
        ]);

        // Update the favorite with the validated data
        $favorite->update($validatedData);

        // Return the updated favorite as a JSON response
        return response()->json($favorite);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorite $favorite)
    {
        // Delete the specified favorite
        $favorite->update(['status' => 'inactive']);

        // Return a JSON response with a success message
        return response()->json(['message' => 'Favorite status changed to inactive successfully']);
    }
}
