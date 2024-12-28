<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::paginate(25);

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $project = new Project;
        $project->name = $request->name;
        $project->save();

        $notification = [
            'message' => 'Project created successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('projects.index')->with($notification);
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $project->name = $request->name;
        $project->save();

        $notification = [
            'message' => 'Project updated successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('projects.index')->with($notification);
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function destroy(Project $project)
    {
        $project->delete();

        $notification = [
            'message' => 'Project deleted successfully!',
            'alert-type' => 'warning',
        ];

        return redirect()->route('projects.index')->with($notification);
    }
}
