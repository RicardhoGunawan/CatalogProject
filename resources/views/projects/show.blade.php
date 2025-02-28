@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Tombol kembali --}}
    <div class="mb-6">
        <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Back to Projects
        </a>
    </div>

    {{-- Card utama proyek --}}
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        @if($project->thumbnail)
        <div class="h-80 overflow-hidden">
            <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
        </div>
        @endif

        <div class="p-8">
            {{-- Kategori dan tanggal selesai --}}
            <div class="flex flex-wrap items-center gap-3 mb-4">
                @if($project->category)
                    <span class="text-sm font-medium text-blue-600 bg-blue-100 rounded-full px-3 py-1">{{ $project->category->name }}</span>
                @endif
                @if($project->completion_date)
                    <span class="text-sm text-gray-500">Completed: {{ \Carbon\Carbon::parse($project->completion_date)->format('F Y') }}</span>
                @endif
            </div>

            {{-- Judul --}}
            <h1 class="text-3xl font-bold mb-4 text-gray-800">{{ $project->title }}</h1>
            
            {{-- Deskripsi --}}
            <div class="prose max-w-none mb-8">
                {!! nl2br(e($project->description)) !!}
            </div>
            
            {{-- Informasi tambahan --}}
            <div class="border-t border-gray-200 pt-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Teknologi yang digunakan --}}
                    <div>
                        <h3 class="text-lg font-semibold mb-2 text-gray-800">Technologies Used</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $project->technology) as $tech)
                                <span class="bg-gray-100 text-gray-800 rounded-full px-3 py-1 text-sm">{{ trim($tech) }}</span>
                            @endforeach
                        </div>
                    </div>
                    
                    {{-- Link proyek jika ada --}}
                    @if($project->url)
                    <div>
                        <h3 class="text-lg font-semibold mb-2 text-gray-800">Project Link</h3>
                        <a href="{{ $project->url }}" target="_blank" class="text-blue-600 hover:text-blue-800 flex items-center">
                            Visit Project
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    {{-- Proyek lain yang direkomendasikan --}}
    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Other Projects</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach(App\Models\Project::where('id', '!=', $project->id)->inRandomOrder()->limit(3)->get() as $otherProject)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                @if($otherProject->thumbnail)
                <img src="{{ asset('storage/' . $otherProject->thumbnail) }}" alt="{{ $otherProject->title }}" class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-400">No Image</span>
                </div>
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2 text-gray-800">{{ $otherProject->title }}</h3>
                    <p class="text-gray-600 mb-4 line-clamp-2">{{ Str::limit($otherProject->description, 100) }}</p>
                    <a href="{{ route('projects.show', $otherProject->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">View Details →</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
