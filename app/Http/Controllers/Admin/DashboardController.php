<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technology;
use App\Models\Category;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        $technologies = Technology::all();
        $categories = Category::all();
        $counts = [];
        $numOfCount = [];

        foreach ($technologies as $technology) {
            array_push($counts, $technology->name);
            array_push($numOfCount, Project::whereHas('technologies', fn($query) => $query->where('technologies.name', $technology->name))->count());
        }

        $numOfCategory = [];
        foreach ($categories as $category) {

            array_push($numOfCategory, Project::where('category_id', $category->id)->count());
        }

        return view('admin.dashboard', compact('technologies', 'categories', 'counts', 'numOfCount', 'numOfCategory'));
    }
}
