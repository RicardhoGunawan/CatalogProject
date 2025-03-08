@extends('layouts.app')

@section('title', 'All Projects - codingsalatiga')

@section('content')
    <!-- All Projects Header -->
    <div
        class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-800 dark:from-blue-800 dark:via-indigo-700 dark:to-purple-900">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div
                class="absolute w-96 h-96 -top-10 -left-10 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
            </div>
            <div
                class="absolute w-96 h-96 -bottom-10 -right-10 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
            </div>
            <div
                class="absolute w-96 h-96 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000">
            </div>
        </div>

        <!-- Content -->
        <div class="relative container mx-auto px-6 py-24">
            <div class="text-center space-y-6">
                <div class="inline-block">
                    <h1 class="text-4xl md:text-6xl font-black text-white mb-2 relative">
                        All Projects
                        <div
                            class="absolute -bottom-2 left-0 w-full h-1 bg-gradient-to-r from-yellow-500 to-red-500 transform scale-x-0 transition-transform duration-300 group-hover:scale-x-100">
                        </div>
                    </h1>
                </div>
                <p class="text-xl md:text-2xl text-white/90 max-w-2xl mx-auto font-light leading-relaxed">
                    Explore our complete collection of projects and discover our diverse portfolio of work.
                </p>
                <div class="w-24 h-1 bg-white/20 mx-auto rounded-full"></div>
            </div>
        </div>

        <!-- Wave Effect -->
        <div class="absolute bottom-0 left-0 w-full">
            <svg class="w-full" viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="fill-white dark:fill-gray-900"
                    d="M0,32L48,37.3C96,43,192,53,288,58.7C384,64,480,64,576,58.7C672,53,768,43,864,42.7C960,43,1056,53,1152,53.3C1248,53,1344,43,1392,37.3L1440,32L1440,100L1392,100C1344,100,1248,100,1152,100C1056,100,960,100,864,100C768,100,672,100,576,100C480,100,384,100,288,100C192,100,96,100,48,100L0,100Z">
                </path>
            </svg>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="container mx-auto px-4 -mt-8 relative z-10">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6" data-aos="fade-up">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between" x-data="filterProjects">
                <div class="relative flex-1 w-full">
                    <input type="text" x-model="searchTerm" @input="filterProjects()" placeholder="Search projects..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-900 dark:text-white">
                    <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                    <select x-model="selectedCategory" @change="filterProjects()"
                        class="bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:text-white">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}">{{ $category->slug }}</option>
                        @endforeach
                    </select>
                    <select x-model="sortMethod" @change="filterProjects()"
                        class="bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:text-white">
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
                    data-title="{{ $project->title }}" data-category="{{ $project->category->slug }}"
                    data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="relative">
                        <img src="{{ $project->thumbnail ? asset('storage/' . $project->thumbnail) : asset('images/no-image.png') }}"
                            alt="{{ $project->title }}"
                            class="w-full h-56 object-cover transition-transform ease-in-out duration-500">
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
                        <div class="flex flex-wrap gap-2 mb-4 mt-4">
                            @foreach(explode(',', $project->technology) as $tech)
                                <span
                                    class="text-base bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-2 py-1 rounded">
                                    {{ trim($tech) }}
                                </span>
                            @endforeach
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="ml-1 text-sm font-medium">{{ number_format($project->rating, 1) }}</span>
                            </div>
                            <a href="{{ route('projects.show', $project->slug) }}"
                                class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium flex items-center group">
                                View Details
                                <svg class="h-5 w-5 ml-1 transform transition-transform duration-300 ease-in-out group-hover:translate-x-1"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
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

                        switch (sortMethod) {
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