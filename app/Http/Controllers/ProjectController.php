<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ProjectController extends Controller
{
    /**
     * Menampilkan daftar proyek pada halaman utama
     */
    public function index()
    {
        // Menggunakan eager loading untuk featured projects juga
        $featured = Project::where('is_featured', true)->take(3)->get();
        
        // Menggunakan select untuk memilih kolom yang dibutuhkan saja dengan nama yang benar
        $projects = Project::with('category:id,slug')
                    ->select(['id', 'title','is_featured', 'slug', 'description', 'features', 'gallery','url', 'thumbnail', 'category_id', 'created_at', 'completion_date', 'technology'])
                    ->latest()
                    ->paginate(9);
                    
        // Hanya ambil kolom yang diperlukan dari kategori
        $categories = Category::select(['id', 'name', 'slug'])->get();

        return view('projects.index', compact('featured', 'projects', 'categories'));
    }

    /**
     * Menampilkan detail proyek berdasarkan slug
     * 
     * @param string $slug Slug proyek
     */
    public function show($slug)
    {
        $project = Project::with('category')
                    ->select(['id', 'title','is_featured', 'slug', 'description','features','gallery','url', 'thumbnail', 'category_id', 'created_at', 'completion_date', 'technology']) // Tambahkan 'technology'
                    ->where('slug', $slug)
                    ->firstOrFail();

        // Menggunakan whereNot Laravel 8+ untuk kode yang lebih bersih
        // Dan menggunakan select untuk memilih kolom yang dibutuhkan saja
        $similarProjects = Project::select(['id', 'title', 'slug', 'thumbnail','gallery', 'category_id', 'technology']) // Tambahkan 'technology'
                ->where('category_id', $project->category_id)
                ->whereNot('id', $project->id)
                ->take(3)
                ->get();

        return view('projects.show', compact('project', 'similarProjects'));
    }

    /**
     * Menampilkan proyek berdasarkan kategori
     * 
     * @param string $slug Slug kategori
     */
    public function category($slug)
    {
        // Cari kategori berdasarkan slug
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $projects = Project::with('category:id,slug')
                    ->select(['id', 'title','is_featured', 'slug', 'description','features', 'thumbnail','gallery','url', 'category_id', 'created_at', 'completion_date', 'technology']) // Tambahkan 'technology'
                    ->where('category_id', $category->id)
                    ->paginate(9);
                    
        $categories = Category::select(['id', 'name', 'slug'])->get();

        return view('projects.index', compact('projects', 'category', 'categories'));
    }
    
    /**
     * Menampilkan semua proyek
     */
    public function allProjects()
    {
        $projects = Project::with('category:id,slug')
                    ->select(['id', 'title','is_featured', 'slug', 'description','features', 'thumbnail','gallery','url', 'category_id', 'created_at', 'completion_date', 'technology']) // Tambahkan 'technology'
                    ->latest()
                    ->paginate(12);
                    
        $categories = Category::select(['id', 'name', 'slug'])->get();

        return view('projects.allproject', compact('projects', 'categories'));
    }

    /**
     * Mencari proyek berdasarkan kata kunci
     * 
     * @param Request $request
     */
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        
        $projects = Project::with('category:id,slug')
                    ->select(['id', 'title','is_featured', 'slug', 'description','features', 'thumbnail','gallery','url', 'category_id', 'created_at', 'completion_date', 'technology']) // Tambahkan 'technology'
                    ->when($keyword, function (Builder $query, $keyword) {
                        return $query->where('title', 'like', "%{$keyword}%")
                                     ->orWhere('description', 'like', "%{$keyword}%");
                    })
                    ->latest()
                    ->paginate(9);
                    
        $categories = Category::select(['id', 'name', 'slug'])->get();
        
        return view('projects.search', compact('projects', 'categories', 'keyword'));
    }
}