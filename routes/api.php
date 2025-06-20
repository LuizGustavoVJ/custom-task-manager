<?php

use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
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

// Rotas de autenticação (não protegidas por auth:sanctum)
Route::post("register", [AuthController::class, "register"]);
Route::post("login", [AuthController::class, "login"]);

Route::middleware("auth:sanctum")->group(function () {
    Route::post("logout", [AuthController::class, "logout"]);
    Route::get("/user", function (Request $request) {
        return $request->user();
    });

    // Rotas de usuários
    Route::get("/users", [UserController::class, "index"]);
    Route::get("/users/{id}", [UserController::class, "show"]);

    // Rotas de projetos
    Route::apiResource("projects", ProjectController::class);

    // Rotas de tarefas
    Route::get("/projects/{project}/tasks", [TaskController::class, "index"]);
    Route::post("/projects/{project}/tasks", [TaskController::class, "store"]);
    Route::get("/tasks/{task}", [TaskController::class, "show"]);
    Route::put("/tasks/{task}", [TaskController::class, "update"]);
    Route::delete("/tasks/{task}", [TaskController::class, "destroy"]);

    // Rotas de comentários
    Route::get("/tasks/{task}/comments", [CommentController::class, "index"]);
    Route::post("/tasks/{task}/comments", [CommentController::class, "store"]);
    Route::put("/comments/{comment}", [CommentController::class, "update"]);
    Route::delete("/comments/{comment}", [CommentController::class, "destroy"]);
});


