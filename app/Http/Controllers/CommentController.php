<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Retrieve all comments from the database
        $comments = Comment::all();

        // Return the comments as a JSON response
        return response()->json($comments);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validate the request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'recipe_id' => 'required|exists:recipes,id',
            'content' => 'required',
        ]);

        // Create a new comment using the validated data
        $comment = Comment::create($validatedData);

        // Return the created comment as a JSON response with a 201 status code
        return response()->json($comment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        // Return the specified comment as a JSON response
        return response()->json($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'recipe_id' => 'required|exists:recipes,id',
            'content' => 'required',
        ]);

        // Update the comment with the validated data
        $comment->update($validatedData);

        // Return the updated comment as a JSON response
        return response()->json($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        // Delete the specified comment
        $comment->update(['status' => 'inactive']);

        // Return a JSON response with a success message
        return response()->json(['message' => 'Comment status changed to inactive successfully']);
    }
}
