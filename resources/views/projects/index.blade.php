@extends('layouts.app')


@section('content')
    <!-- Hero Section with Parallax Effect -->
    <div class="relative overflow-hidden min-h-screen flex items-center bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-800 dark:from-blue-800 dark:via-indigo-700 dark:to-purple-900">
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

        <!-- Animated Particles -->
        <div class="absolute inset-0">
            <div id="particles" class="absolute inset-0 opacity-30"></div>
        </div>

        <div class="relative container mx-auto px-6 md:px-12 h-full flex flex-col md:flex-row items-center z-10">
            <!-- Left Content -->
            <div class="flex-1 md:text-left space-y-8">
                <div class="space-y-4">
                    <h1 class="text-5xl md:text-7xl font-black text-white mb-6 leading-tight">
                        coding<span
                            class="bg-clip-text text-transparent bg-gradient-to-r from-red-500 to-yellow-500">salatiga</span>
                    </h1>
                    <p class="text-xl md:text-2xl text-white/90 max-w-2xl font-light leading-relaxed">
                        Transforming ideas into elegant digital experiences through creative web development solutions.
                    </p>
                </div>

                <div class="flex flex-wrap gap-6 mt-8">
                    <a href="#projects"
                        class="group relative inline-flex items-center justify-center overflow-hidden rounded-full p-4 px-8 py-3 font-medium text-indigo-600 shadow-xl transition duration-300 ease-out bg-white hover:ring-2 hover:ring-white">
                        <span
                            class="absolute inset-0 w-full h-full bg-gradient-to-br from-blue-600 via-purple-600 to-pink-700"></span>
                        <span
                            class="absolute bottom-0 right-0 block w-64 h-64 mb-32 mr-4 transition duration-500 origin-bottom-left transform rotate-45 translate-x-24 bg-pink-500 rounded-full opacity-30 group-hover:rotate-90"></span>
                        <span class="relative text-white">View Projects</span>
                    </a>

                    <a href="#contact"
                        class="relative inline-flex items-center justify-center overflow-hidden rounded-full p-4 px-8 py-3 font-medium text-white border-2 border-white/50 hover:border-white/100 transition duration-300 backdrop-blur-sm hover:backdrop-blur-lg">
                        Contact Me
                    </a>
                </div>
            </div>

            <!-- Right Content -->
            <div class="flex-1 flex justify-center md:justify-end mt-12 md:mt-0">
                <div class="relative w-full max-w-lg">
                    <!-- Decorative Elements -->
                    <div
                        class="absolute top-0 -left-4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob">
                    </div>
                    <div
                        class="absolute top-0 -right-4 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000">
                    </div>
                    <div
                        class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000">
                    </div>

                    <!-- Main Image -->
                    <div class="relative">
                        <img src="{{ asset('images/catalog_banner.jpg') }}" alt="Catalog Banner"
                            class="relative rounded-2xl shadow-2xl transition-all duration-500 transform hover:scale-105 hover:shadow-[0_35px_60px_-15px_rgba(0,0,0,0.3)]">
                    </div>
                </div>
            </div>
        </div>

        <!-- Wave Effect -->
        <div class="absolute bottom-0 left-0 w-full">
            <svg class="w-full" viewBox="0 0 1440 320" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="fill-white dark:fill-gray-900"
                    d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,229.3C1248,213,1344,203,1392,197.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>
        </div>
    </div>
    
    <!-- Filter Section -->
    <div id="projects" class="container mx-auto px-4 relative z-10">
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
                    data-title="{{ $project->title }}" data-category="{{ $project->category->slug }}">
                    <div class="relative">
                        <img src="{{ $project->thumbnail ? asset('storage/' . $project->thumbnail) : asset('images/no-image.png') }}"
                            alt="{{ $project->title }}"
                            class="w-full h-56 object-cover transition-transform ease-in-out duration-500">

                        @if($project->is_featured || $loop->first)
                            <div class="absolute top-4 right-4">
                                <span class="bg-yellow-400 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full">
                                    {{ $project->is_featured ? 'Featured' : 'New' }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-sm font-medium text-blue-600 bg-blue-100 rounded-full px-3 py-1">
                                {{ $project->category->slug}}
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
    </div>

    <!-- Call to Action -->
    <div id="contact" class="container mx-auto px-4 py-12">
        <div class="bg-gradient-to-r from-blue-600 to-purple-850 rounded-xl shadow-xl p-8 text-white text-center"
            data-aos="fade-up">
            <h2 class="text-3xl font-bold mb-4">Ready to Start Your Project?</h2>
            <p class="text-xl mb-6 max-w-3xl mx-auto">Let's work together to create something amazing.</p>
            <a href="mailto:yourname@example.com"
                class="bg-white text-blue-600 px-8 py-3 rounded-lg font-medium hover:bg-blue-50 transition duration-300 inline-block transform hover:scale-105">
                Get in Touch
            </a>
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

                    // Get all project cards
                    const projectCards = document.querySelectorAll('.project-card');

                    // Filter and sort projects
                    projectCards.forEach(card => {
                        const title = card.dataset.title.toLowerCase();
                        const category = card.dataset.category;

                        // Filter by search term and category
                        const matchesSearch = title.includes(searchTerm);
                        const matchesCategory = selectedCategory === '' || category === selectedCategory;

                        // Show/hide based on filters
                        if (matchesSearch && matchesCategory) {
                            card.classList.remove('hidden');
                        } else {
                            card.classList.add('hidden');
                        }
                    });

                    // Sort the visible cards
                    const projectsContainer = document.querySelector('.grid');
                    const visibleCards = Array.from(projectCards).filter(card => !card.classList.contains('hidden'));

                    visibleCards.sort((a, b) => {
                        const titleA = a.dataset.title.toLowerCase();
                        const titleB = b.dataset.title.toLowerCase();

                        if (sortMethod === 'a-z') {
                            return titleA.localeCompare(titleB);
                        } else if (sortMethod === 'z-a') {
                            return titleB.localeCompare(titleA);
                        } else if (sortMethod === 'newest') {
                            // This would need actual date info in the dataset
                            return -1; // Default to newest first without actual date
                        } else if (sortMethod === 'oldest') {
                            // This would need actual date info in the dataset
                            return 1; // Default to oldest first without actual date
                        }
                        return 0;
                    });

                    // Reorder the DOM elements
                    visibleCards.forEach(card => {
                        projectsContainer.appendChild(card);
                    });
                }
            }));
        });
    </script>
@endsection