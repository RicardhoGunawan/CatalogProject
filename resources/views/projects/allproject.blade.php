@extends('layouts.app')

@section('title', 'All Projects - codingsalatiga')

@section('content')
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-850 py-12">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">All Projects</h1>
                <p class="text-lg text-white/90 max-w-2xl mx-auto">
                    Explore our complete collection of projects and discover our diverse portfolio of work.
                </p>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="container mx-auto px-4 -mt-8 relative z-10">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6" data-aos="fade-up">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between" x-data="filterProjects">
                <div class="relative flex-1 w-full">
                    <input 
                        type="text" 
                        x-model="searchTerm" 
                        @input="filterProjects()" 
                        placeholder="Search projects..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-900 dark:text-white"
                    >
                    <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                    <select 
                        x-model="selectedCategory" 
                        @change="filterProjects()"
                        class="bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:text-white"
                    >
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}">{{ $category->slug }}</option>
                        @endforeach
                    </select>
                    <select 
                        x-model="sortMethod" 
                        @change="filterProjects()"
                        class="bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:text-white"
                    >
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="a-z">Name (A-Z)</option>
                        <option value="z-a">Name (Z-A)</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Grid -->
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($projects as $project)
                <div class="project-card bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transition-transform ease-in-out duration-500 hover:shadow-xl transform hover:scale-105"
                     data-title="{{ $project->title }}" 
                     data-category="{{ $project->category->slug }}"
                     data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="relative">
                        <img 
                            src="{{ $project->thumbnail ? asset('storage/' . $project->thumbnail) : asset('images/no-image.png') }}"
                            alt="{{ $project->title }}"
                            class="w-full h-56 object-cover transition-transform ease-in-out duration-500"
                        >
                        @if($project->is_featured)
                            <div class="absolute top-4 right-4">
                                <span class="bg-yellow-400 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full">
                                    Featured
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-sm font-medium text-blue-600 bg-blue-100 rounded-full px-3 py-1">
                                {{ $project->category->slug }}
                            </span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $project->completion_date->format('M Y') }}
                            </span>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800 dark:text-white">{{ $project->title }}</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">{!! $project->description !!}</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach(explode(',', $project->technology) as $tech)
                                <span class="text-xs bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-2 py-1 rounded">
                                    {{ trim($tech) }}
                                </span>
                            @endforeach
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="ml-1 text-sm font-medium">{{ number_format($project->rating, 1) }}</span>
                            </div>
                            <a href="{{ route('projects.show', $project->slug) }}" 
                               class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium flex items-center group">
                                View Details
                                <svg class="h-5 w-5 ml-1 transform transition-transform duration-300 ease-in-out group-hover:translate-x-1"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $projects->links() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Define Alpine.js data
        document.addEventListener('alpine:init', () => {
            Alpine.data('filterProjects', () => ({
                searchTerm: '',
                selectedCategory: '',
                sortMethod: 'newest',

                filterProjects() {
                    const searchTerm = this.searchTerm.toLowerCase();
                    const selectedCategory = this.selectedCategory;
                    const sortMethod = this.sortMethod;

                    const projectCards = document.querySelectorAll('.project-card');

                    projectCards.forEach(card => {
                        const title = card.dataset.title.toLowerCase();
                        const category = card.dataset.category;

                        const matchesSearch = title.includes(searchTerm);
                        const matchesCategory = selectedCategory === '' || category === selectedCategory;

                        if (matchesSearch && matchesCategory) {
                            card.classList.remove('hidden');
                        } else {
                            card.classList.add('hidden');
                        }
                    });

                    const projectsContainer = document.querySelector('.grid');
                    const visibleCards = Array.from(projectCards).filter(card => !card.classList.contains('hidden'));

                    visibleCards.sort((a, b) => {
                        const titleA = a.dataset.title.toLowerCase();
                        const titleB = b.dataset.title.toLowerCase();

                        switch(sortMethod) {
                            case 'a-z':
                                return titleA.localeCompare(titleB);
                            case 'z-a':
                                return titleB.localeCompare(titleA);
                            case 'newest':
                                return -1;
                            case 'oldest':
                                return 1;
                            default:
                                return 0;
                        }
                    });

                    visibleCards.forEach(card => {
                        projectsContainer.appendChild(card);
                    });
                }
            }));
        });
    </script>
@endsection