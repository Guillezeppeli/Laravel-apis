<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecipeController;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

 //   --> Routes for managing Users <--
// Route for retrieving all users
Route::get('/users', [UserController::class, 'index']);

// Route for creating a new user
Route::post('/users', [UserController::class, 'store']);

// Route for retrieving a specific user
Route::get('/users/{user}', [UserController::class, 'show']);

// Route for updating a specific user
Route::put('/users/{user}', [UserController::class, 'update']);

// Route for deleting a specific user
Route::delete('/users/{user}', [UserController::class, 'destroy']);


//    --> Routes for managing Categories <--
// Route for retrieving all categories
Route::get('/categories', [CategoryController::class, 'index']);

// Route for creating a new category
Route::post('/categories', [CategoryController::class, 'store']);

// Route for retrieving a specific category
Route::get('/categories/{category}', [CategoryController::class, 'show']);

// Route for updating a specific user
Route::put('/categories/{category}', [CategoryController::class, 'update']);

// Route for deleting a specific category
Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);


//    --> Routes for managing Recipes <--
// Route for retrieving all recipes
Route::get('/recipes', [RecipeController::class, 'index']);

// Route for creating a new recipe
Route::post('/recipes', [RecipeController::class, 'store']);

// Route for retrieving a specific recipe
Route::get('/recipes/{recipe}', [RecipeController::class, 'show']);

// Route for updating a specific recipe
Route::put('/recipes/{recipe}', [RecipeController::class, 'update']);

Route::patch('/recipes/{recipe}', [RecipeController::class, 'update']);

// Route for deleting a specific recipe
Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy']);


//      --> Routes for managing Favorites <--
// Route for retrieving all favorites
Route::get('/favorites', [FavoriteController::class, 'index']);

// Route for creating a new favorite
Route::post('/favorites', [FavoriteController::class, 'store']);

// Route for retrieving a specific favorite
Route::get('/favorites/{favorite}', [FavoriteController::class, 'show']);

// Route for updating a specific favorite
Route::put('/favorites/{favorite}', [FavoriteController::class, 'update']);

// Route for deleting a deleting a specific favorite
Route::delete('/favorites/{favorite}', [FavoriteController::class, 'destroy']);


//    --> Routes for managing Comments <--
// Route for retrieving all comments
Route::get('/comments', [CommentController::class, 'index']);

// Route for creating a new comment
Route::post('/comments', [CommentController::class, 'store']);

// Route for retrieving a specific comment
Route::get('/comments/{comment}', [CommentController::class, 'show']);

// Route for updating a specific comment
Route::put('/comments/{comment}', [CommentController::class, 'update']);

// Route for deleting a deleting a specific comment
Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);