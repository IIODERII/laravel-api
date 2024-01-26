<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        if ($request->query('category')) {
            $projects = Project::where('category_id', $request->query('category'))->get();
        } else {
            $projects = Project::all();
        }
        return response()->json([
            'success' => true,
            'data' => $projects
        ]);
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->with(['category', 'technologies'])->first();
        return response()->json([
            'success' => true,
            'data' => $project
        ]);
    }


}
