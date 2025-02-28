<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $featured = Project::where('is_featured', true)->take(3)->get();
        $projects = Project::with('category')->latest()->paginate(9);
        $categories = Category::all(); // Ambil semua kategori

        return view('projects.index', compact('featured', 'projects', 'categories'));
    }
    
    public function show($id)
    {
        $project = Project::with('category')->findOrFail($id);
        
        return view('projects.show', compact('project'));
    }
    
    public function category($name)
    {
        // Cari kategori berdasarkan nama
        $category = Category::where('name', $name)->firstOrFail();

        // Ambil semua proyek dalam kategori yang ditemukan
        $projects = Project::with('category')->where('category_id', $category->id)->paginate(9);
        $categories = Category::all(); // Tetap ambil semua kategori untuk dropdown

        return view('projects.index', compact('projects', 'category', 'categories'));
    }
}
