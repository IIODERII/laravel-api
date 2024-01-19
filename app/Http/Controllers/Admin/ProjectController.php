<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Technology;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUserId = Auth::id();
        if ($currentUserId === 1) {
            $projects = Project::paginate(3);
        } else {
            $projects = Project::where('user_id', $currentUserId)->get();
        }

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('categories', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();
        $slug = Str::slug($data['title'], '-');
        $userId = Auth::id();
        $data['user_id'] = $userId;
        $data['category_id'] = $request->category_id;
        $data['slug'] = $slug;
        if ($request->hasFile('image')) {
            $path = Storage::put('uploads', $request->image);
            $data['image'] = $path;
        }

        $newProject = Project::create($data);

        if ($request->has('technologies')) {
            $newProject->technologies()->attach($request->technologies);
        }

        return redirect()->route('admin.projects.show', ['project' => $newProject->slug]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $currentUserId = Auth::id();
        if ($currentUserId === 1 || $project->user_id === $currentUserId) {
            return view('admin.projects.show', compact('project'));
        }
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $currentUserId = Auth::id();
        if ($currentUserId === 1 || $project->user_id === $currentUserId) {
            $categories = Category::all();
            $technologies = Technology::all();

            return view('admin.projects.edit', compact('project', 'categories', 'technologies'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();
        if ($project->title !== $data['title']) {
            $slug = Project::getSlug($data['title'], '-');
        } else {
            $slug = $project->slug;
        }
        $data['slug'] = $slug;
        $data['category_id'] = $request->category_id;
        if ($request->hasFile('image')) {
            if (Storage::exists($project->image)) {
                Storage::delete($project->image);
            }
            $path = Storage::put('images', $request->image);
            $data['image'] = $path;
        }
        $project->update($data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        } else {
            $project->technologies()->detach();
        }


        return redirect()->route('admin.projects.show', ['project' => $project->slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $currentUserId = Auth::id();
        if ($currentUserId !== 1 && $project->user_id != $currentUserId) {
            abort(403);
        }
        if ($project->image) {
            Storage::delete($project->image);
        }

        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', "Il progetto $project->title è stato eliminato con successo");
    }
}
