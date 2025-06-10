<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    /**
     * Display a listing of tasks for a specific project.
     */
    public function index(Request $request, string $projectId = null): JsonResponse
    {
        if ($projectId) {
            $project = Project::find($projectId);
            if (!$project) {
                return response()->json(['message' => 'Projeto não encontrado'], 404);
            }
            $tasks = Task::where('project_id', $projectId)->with(['user', 'project'])->get();
        } else {
            $tasks = Task::with(['user', 'project'])->get();
        }

        return response()->json($tasks);
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(Request $request, string $projectId): JsonResponse
    {
        $project = Project::find($projectId);
        if (!$project) {
            return response()->json(['message' => 'Projeto não encontrado'], 404);
        }

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'status' => 'nullable|string|in:pending,in_progress,completed',
                'due_date' => 'nullable|date',
                'user_id' => 'nullable|exists:users,id',
            ]);

            $validated['project_id'] = $projectId;
            $validated['status'] = $validated['status'] ?? 'pending';

            $task = Task::create($validated);
            $task->load(['user', 'project']);

            return response()->json($task, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * Display the specified task.
     */
    public function show(string $id): JsonResponse
    {
        $task = Task::with(['user', 'project'])->find($id);

        if (!$task) {
            return response()->json(['message' => 'Tarefa não encontrada'], 404);
        }

        return response()->json($task);
    }

    /**
     * Update the specified task in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Tarefa não encontrada'], 404);
        }

        try {
            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'description' => 'nullable|string',
                'status' => 'nullable|string|in:pending,in_progress,completed',
                'due_date' => 'nullable|date',
                'user_id' => 'nullable|exists:users,id',
            ]);

            $task->update($validated);
            $task->load(['user', 'project']);

            return response()->json($task);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Tarefa não encontrada'], 404);
        }

        $task->delete();

        return response()->json(null, 204);
    }
}

