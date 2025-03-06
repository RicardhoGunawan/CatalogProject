@extends('layouts.app')

@section('styles')
    <!-- <style>
        .bg-pattern {
            background-size: 60px 60px;
            background-repeat: repeat;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style> -->
@endsection

@section('content')
    <!-- Hero Section with Parallax Effect -->
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-purple-850 h-[600px] flex items-center">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-pattern opacity-5"
                style="background-image: url('data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.3'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
            </div>
        </div>

        <div class="relative container mx-auto px-6 md:px-12 h-full flex flex-col md:flex-row items-center">
            <!-- Bagian Kiri (Teks) -->
            <div class="flex-1 md:text-left" data-aos="fade-right">
                <h1
                    class="text-4xl md:text-6xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white to-red-500 mb-6 leading-tight mt-6">
                    codingsalatiga
                </h1>


                <p class="text-lg md:text-xl text-white opacity-90 mb-8 max-w-2xl">
                    Showcasing my creative work and professional expertise in web development.
                </p>
                <div class="flex flex-wrap md:justify-start gap-4">
                    <a href="#projects"
                        class="bg-white text-blue-600 px-8 py-3 rounded-lg font-medium hover:bg-blue-50 transition duration-300 hover:shadow-lg hover:-translate-y-1">
                        View Projects
                    </a>
                    <a href="#contact"
                        class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-medium hover:bg-white hover:text-blue-600 transition duration-300 hover:shadow-lg hover:-translate-y-1">
                        Contact Me
                    </a>
                </div>
            </div>

            <!-- Bagian Kanan (Gambar) -->
            <div class="flex-1 flex justify-center md:justify-end mt-4 md:mt-0 mb-8 md:mb-0" data-aos="fade-left">
                <img src="{{ asset('images/catalog_banner.jpg') }}" alt="Catalog Banner" class="max-w-[400px] sm:max-w-[400px] md:max-w-[500px] lg:max-w-[500px] rounded-lg shadow-2xl drop-shadow-lg object-cover 
                    transition duration-300 ease-in-out transform hover:scale-105 hover:-translate-y-3 hover:shadow-3xl">
            </div>


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
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
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
                <div class="project-card bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden 
                                                                                    transition-transform ease-in-out duration-500 hover:shadow-xl transform hover:scale-105"
                    data-title="{{ $project->title }}" data-category="{{ $project->category->name }}">
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
                                {{ $project->category->name }}
                            </span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $project->completion_date->format('M Y') }}
                            </span>
                        </div>
                        <h3 class="text-xl font-bold mb-3 text-gray-800 dark:text-white">{{ $project->title }}</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">{{ $project->description }}</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach(explode(',', $project->technology) as $tech)
                                <span
                                    class="text-xs bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-2 py-1 rounded">
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
                            <a href="{{ route('projects.show', $project->id) }}"
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