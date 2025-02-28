@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg shadow-xl p-8 mb-10 text-white text-center">
            <h1 class="text-4xl font-bold mb-4">My Project Portfolio</h1>
            <p class="text-xl mb-6">Showcasing my work and expertise in web development</p>
            <a href="#projects" class="bg-white text-blue-600 px-6 py-2 rounded-lg font-medium hover:bg-blue-50 transition">
                View Projects
            </a>
        </div>

        @if($featured->count() > 0)
            <div class="mb-16">
                <h2 class="text-3xl font-bold mb-6 text-gray-800">Featured Projects</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($featured as $project)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transition transform hover:scale-105">
                            <img src="{{ $project->thumbnail ? asset('storage/' . $project->thumbnail) : asset('images/no-image.png') }}"
                                alt="{{ $project->title }}" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <span class="text-sm font-medium text-blue-600 bg-blue-100 rounded-full px-3 py-1">
                                    {{ $project->category->name ?? 'Uncategorized' }}
                                </span>
                                <h3 class="text-xl font-bold mt-2 mb-2 text-gray-800">{{ $project->title }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $project->description }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500">{{ $project->completion_date->format('M Y') }}</span>
                                    <a href="{{ route('projects.show', $project->id) }}"
                                        class="text-blue-600 hover:text-blue-800 font-medium">View Details →</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif


        <!-- All Projects -->
        <div id="projects">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800">All Projects</h2>
                <select id="category-filter"
                    class="bg-white border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $project)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        <img src="{{ $project->thumbnail ? asset('storage/' . $project->thumbnail) : asset('images/no-image.png') }}"
                            alt="{{ $project->title }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-sm font-medium text-blue-600 bg-blue-100 rounded-full px-3 py-1">
                                    {{ $project->category->name ?? 'Uncategorized' }}
                                </span>
                                <span class="text-xs text-gray-500">{{ $project->completion_date->format('M Y') }}</span>
                            </div>
                            <h3 class="text-xl font-bold mb-2 text-gray-800">{{ $project->title }}</h3>
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ $project->description }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">{{ $project->technology }}</span>
                                <a href="{{ route('projects.show', $project->id) }}"
                                    class="text-blue-600 hover:text-blue-800 font-medium">Details →</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $projects->links() }}
            </div>
        </div>
    </div>

    <script>
        document.getElementById('category-filter').addEventListener('change', function () {
            const category = this.value;
            window.location.href = category ? `{{ url('category') }}/${encodeURIComponent(category)}` : `{{ route('home') }}`;
        });
    </script>
@endsection