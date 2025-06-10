<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CommentController extends Controller
{
    /**
     * Display a listing of comments for a specific task.
     */
    public function index(string $taskId): JsonResponse
    {
        $task = Task::find($taskId);
        if (!$task) {
            return response()->json(['message' => 'Tarefa não encontrada'], 404);
        }

        $comments = Comment::where('task_id', $taskId)->with('user')->get();
        return response()->json($comments);
    }

    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, string $taskId): JsonResponse
    {
        $task = Task::find($taskId);
        if (!$task) {
            return response()->json(['message' => 'Tarefa não encontrada'], 404);
        }

        try {
            $validated = $request->validate([
                'content' => 'required|string',
            ]);

            $validated['task_id'] = $taskId;
            $validated['user_id'] = Auth::id();

            $comment = Comment::create($validated);
            $comment->load('user');

            return response()->json($comment, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * Display the specified comment.
     */
    public function show(string $id): JsonResponse
    {
        $comment = Comment::with('user')->find($id);

        if (!$comment) {
            return response()->json(['message' => 'Comentário não encontrado'], 404);
        }

        return response()->json($comment);
    }

    /**
     * Update the specified comment in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json(['message' => 'Comentário não encontrado'], 404);
        }

        // Verificar se o usuário é o dono do comentário
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['message' => 'Não autorizado'], 403);
        }

        try {
            $validated = $request->validate([
                'content' => 'required|string',
            ]);

            $comment->update($validated);
            $comment->load('user');

            return response()->json($comment);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json(['message' => 'Comentário não encontrado'], 404);
        }

        // Verificar se o usuário é o dono do comentário
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['message' => 'Não autorizado'], 403);
        }

        $comment->delete();

        return response()->json(null, 204);
    }
}

