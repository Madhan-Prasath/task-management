<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $projectId = $request->get('project_id', null);
        $projects = Project::all();
        $tasks = Task::when($projectId, function ($query) use ($projectId) {
            return $query->where('project_id', $projectId);
        })->orderBy('priority', 'asc')->get();

        return view('tasks.index', compact('tasks', 'projects', 'projectId'));
    }

    public function create()
    {
        $projects = Project::all();

        return view('tasks.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $highestPriority = Task::where('project_id', $request->project_id)->max('priority') ?? 0;

        $task = new Task;

        $task->name = $request->name;
        $task->priority = $highestPriority + 1;
        $task->project_id = $request->project_id;

        $task->save();

        $notification = [
            'message' => 'Task created successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('tasks.index')->with($notification);
    }

    public function edit(Task $task)
    {
        $projects = Project::all();

        return view('tasks.edit', compact('task', 'projects'));
    }

    public function update(Request $request, Task $task)
    {
        $task->name = $request->name;
        $task->project_id = $request->project_id;

        $task->save();

        $notification = [
            'message' => 'Task updated successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('tasks.index')->with($notification);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        $notification = [
            'message' => 'Task deleted successfully!',
            'alert-type' => 'warning',
        ];

        return redirect()->route('tasks.index')->with($notification);
    }

    public function reorder(Request $request)
    {
        $projectId = $request->project_id;

        if ($projectId) {
            // Handle reordering for a specific project
            $tasks = Task::where('project_id', $projectId)->orderBy('priority')->get();

            // Map task IDs to priorities within the project range
            foreach ($request->tasks as $index => $taskId) {
                Task::where('id', $taskId)
                    ->where('project_id', $projectId)
                    ->update(['priority' => $index + $tasks->first()->priority]);
            }
        } else {
            // Handle reordering globally
            foreach ($request->tasks as $index => $taskId) {
                Task::where('id', $taskId)->update(['priority' => $index + 1]);
            }
        }

        return response()->json(['status' => 'success']);
    }
}
