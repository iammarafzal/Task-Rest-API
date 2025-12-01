<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // GET /api/tasks
    public function index()
    {
        return response()->json(Task::all(), 200);
    }

    // POST /api/tasks
    public function store(Request $request)
    {
        $data = $request->validate([
            'text'     => 'required|string|max:255',
            'day'      => 'required|date|after_or_equal:today',   
            'reminder' => 'boolean',
        ]);

        $task = Task::create($data);

        return response()->json($task, 201);
    }

    // GET /api/tasks/{task}
    public function show(Task $task)
    {
        return response()->json($task, 200);
    }

    // PUT/PATCH /api/tasks/{task}
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'text'     => 'sometimes|required|string|max:255',
            'day'      => 'sometimes|nullable|date|after_or_equal:today',
            'reminder' => 'sometimes|boolean',
        ]);

        $task->update($data);

        return response()->json($task, 200);
    }

    // PATCH /api/tasks/{task}/reminder
    public function updateReminder(Request $request, Task $task)
    {
        $data = $request->validate([
            'reminder' => 'required|boolean',
        ]);

        $task->update(['reminder' => $data['reminder']]);

        return response()->json($task, 200);
    }

    // DELETE /api/tasks/{task}
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json(null, 204);
    }

    // GET /api/tasks/deleted
    public function deleted(){
        $tasks = Task::onlyTrashed()->get();
        return response()->json($tasks, 200);
    }

    // POST /api/tasks/{id}/restore
    public function restore($id){
        $task = Task::onlyTrashed()->findOrFail($id);

        if ($task->trashed()){
            $task->restore();
            return response()->json(['message' => 'Task restored successfully.', 'data' => $task], 200); 
        } else {
            return response()->json(['message' => 'Task is not deleted.'], 422);
        }
    }
}