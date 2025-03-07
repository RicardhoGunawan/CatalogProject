@extends('layouts.app')


@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Header dengan breadcrumb dan tombol kembali --}}
    <div class="flex flex-wrap justify-between items-center mb-8">
        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 mb-4 md:mb-0">
            <a href="{{ route('home') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-gray-800 dark:text-gray-200 font-medium">{{ $project->title }}</span>
        </div>
        
        <a href="{{ route('home') }}" class="flex items-center py-2 px-4 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-600 dark:text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Back to Projects
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            {{-- Card utama proyek dengan desain yang ditingkatkan --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden">
                @if($project->thumbnail)
                <div class="relative h-96 overflow-hidden group">
                    <img src="{{ asset('storage/' . $project->thumbnail) }}" 
                         alt="{{ $project->title }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500 ease-in-out">
                         @if($project->featured)
                            <div class="absolute top-4 right-4">
                                <div class="bg-yellow-400 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    {!! $project->featured !!}
                                </div>
                            </div>
                        @endif
                </div>
                @else
                <div class="h-96 bg-gradient-to-r from-blue-100 to-indigo-100 dark:from-blue-900 dark:to-indigo-900 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-blue-300 dark:text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                @endif

                <div class="p-8">
                    {{-- Bagian meta informasi --}}
                    <div class="flex flex-wrap items-center gap-3 mb-4">
                        @if($project->category->slug)
                            <span class="text-sm font-medium text-blue-600 dark:text-blue-400 bg-blue-100 dark:bg-blue-900 rounded-full px-3 py-1">{{ $project->category->name }}</span>
                        @endif
                        @if($project->completion_date)
                            <span class="text-sm text-gray-600 dark:text-gray-400 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                                Completed: {{ \Carbon\Carbon::parse($project->completion_date)->format('F Y') }}
                            </span>
                        @endif
                        @if(isset($project->duration))
                            <span class="text-sm text-gray-600 dark:text-gray-400 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                {{ $project->duration }} weeks
                            </span>
                        @endif
                    </div>

                    {{-- Judul dengan styling yang lebih baik --}}
                    <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-white">{{ $project->title }}</h1>
                    
                    {{-- Tab navigasi untuk konten proyek --}}
                    <div class="mb-8" x-data="{ activeTab: 'description' }">
                        <div class="border-b border-gray-200 dark:border-gray-700 mb-4">
                            <nav class="flex space-x-8">
                                <button @click="activeTab = 'description'" 
                                    :class="{ 'border-blue-500 text-blue-600 dark:text-blue-400': activeTab === 'description', 
                                            'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'description' }" 
                                    class="py-3 px-1 border-b-2 font-medium text-sm focus:outline-none">
                                    Description
                                </button>
                                <button @click="activeTab = 'gallery'" 
                                    :class="{ 'border-blue-500 text-blue-600 dark:text-blue-400': activeTab === 'gallery', 
                                            'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'gallery' }" 
                                    class="py-3 px-1 border-b-2 font-medium text-sm focus:outline-none">
                                    Gallery
                                </button>
                            </nav>
                        </div>
                        
                        {{-- Tab content --}}
                        <div>
                            {{-- Description tab --}}
                            <div x-show="activeTab === 'description'" class="prose max-w-none dark:prose-invert">
                                {!! $project->description !!}
                            </div>

                            <div x-show="activeTab === 'gallery'" x-cloak class="space-y-4">
                                @if(isset($project->gallery) && count($project->gallery) > 0)
                                    <div class="mt-8">
                                        <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white">Project Gallery</h3>

                                        <!-- Carousel -->
                                        <div id="default-carousel" class="relative w-full" data-carousel="slide">
                                            <!-- Carousel wrapper -->
                                            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                                                @foreach($project->gallery as $image)
                                                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                                        <img src="{{ asset('storage/' . $image) }}" 
                                                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                            alt="Project Image">
                                                    </div>
                                                @endforeach
                                            </div>

                                            <!-- Slider indicators -->
                                            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                                                @foreach($project->gallery as $index => $image)
                                                    <button type="button" class="w-3 h-3 rounded-full"
                                                            aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}">
                                                    </button>
                                                @endforeach
                                            </div>

                                            <!-- Slider controls -->
                                            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                                    </svg>
                                                    <span class="sr-only">Previous</span>
                                                </span>
                                            </button>
                                            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                                    </svg>
                                                    <span class="sr-only">Next</span>
                                                </span>
                                            </button>
                                        </div>

                                        <!-- Grid Gallery -->
                                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-4" x-data="{ activeImage: null }">
                                            @foreach($project->gallery as $image)
                                                <div class="aspect-w-16 aspect-h-9 bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden cursor-pointer"
                                                    @click="activeImage = '{{ asset('storage/' . $image) }}'">
                                                    <img src="{{ asset('storage/' . $image) }}" alt="Project image"
                                                        class="w-full h-full object-cover hover:opacity-90 transition">
                                                </div>
                                            @endforeach

                                            <!-- Modal -->
                                            <div x-show="activeImage" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75"
                                                @click="activeImage = null">
                                                <div class="max-w-4xl w-full max-h-screen p-4" @click.stop>
                                                    <img :src="activeImage" class="max-h-full mx-auto" alt="Enlarged project image">
                                                    <button class="absolute top-4 right-4 bg-white rounded-full p-1 shadow-lg"
                                                            @click="activeImage = null">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                    {{-- Informasi tambahan dan testimoni --}}
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-8 mt-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            {{-- Teknologi yang digunakan dengan ikon --}}
                            <div>
                                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Technologies Used
                                </h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach(explode(',', $project->technology) as $tech)
                                        <span class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg px-3 py-1.5 text-sm flex items-center shadow-sm">
                                            <span class="w-2 h-2 rounded-full bg-blue-500 mr-2"></span>
                                            {{ trim($tech) }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            
                            {{-- Link proyek dan Button --}}
                            <div>
                                @if($project->url)
                                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                    Project Links
                                </h3>
                                <div class="space-y-3">
                                    <a href="{{ $project->url }}" target="_blank" class="flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition w-full sm:w-auto justify-center sm:justify-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                        Visit Live Project
                                    </a>
                                    @if(isset($project->github_url))
                                    <a href="{{ $project->github_url }}" target="_blank" class="flex items-center bg-gray-800 text-white px-4 py-2 rounded-lg shadow-md hover:bg-gray-900 transition w-full sm:w-auto justify-center sm:justify-start">
                                        <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1
                                                                                    </svg>
                                        View Source Code
                                    </a>
                                    @endif
                                </div>
                                @endif
                                
                                {{-- Rating sistem --}}
                                @if(isset($project->rating))
                                <div class="mt-6">
                                    <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                        Project Rating
                                    </h3>
                                    <div class="flex items-center">
                                        <div class="flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $project->rating)
                                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                @else
                                                    <svg class="w-5 h-5 text-gray-300 dark:text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ number_format($project->rating, 1) }} out of 5</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Sidebar --}}
        <div class="lg:col-span-1">
            {{-- Client testimonial --}}
            @if(isset($project->testimonial) && !empty($project->testimonial))
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    Client Testimonial
                </h3>
                <div class="relative">
                    <svg class="absolute top-0 left-0 w-10 h-10 text-gray-200 dark:text-gray-700 transform -translate-x-6 -translate-y-3" fill="currentColor" viewBox="0 0 32 32">
                        <path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" />
                    </svg>
                    <blockquote class="pl-6 italic text-gray-600 dark:text-gray-400">{!! nl2br(e($project->testimonial)) !!}</blockquote>
                    @if(isset($project->client_name))
                    <div class="mt-4 flex items-center">
                        <div class="h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-400 font-bold">
                            {{ substr($project->client_name, 0, 1) }}
                        </div>
                        <div class="ml-3">
                            <div class="font-medium text-gray-800 dark:text-white">{{ $project->client_name }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $project->client_position ?? 'Client' }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
            
            {{-- Related projects --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    Similar Projects
                </h3>
                <div class="space-y-4">
                    @isset($project->category_id)
                        @php
                            $relatedProjects = App\Models\Project::where('category_id', $project->category_id)
                                ->where('id', '!=', $project->id)
                                ->orderBy('created_at', 'desc')
                                ->take(3)
                                ->get();
                        @endphp

                        @if ($relatedProjects->count())
                            @foreach ($relatedProjects as $relatedProject)
                                <a href="{{ route('projects.show', $relatedProject->slug) }}" class="block group">
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            @if ($relatedProject->thumbnail)
                                                <img src="{{ asset('storage/' . $relatedProject->thumbnail) }}" alt="{{ $relatedProject->title }}" class="w-16 h-16 object-cover rounded-md">
                                            @else
                                                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 flex items-center justify-center rounded-md">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-800 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">
                                                {{ $relatedProject->title }}
                                            </h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2">
                                                {!! Str::limit($relatedProject->description, 50) !!}
                                            </p>

                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <p class="text-gray-500 dark:text-gray-400 text-sm">No related projects found.</p>
                        @endif
                    @else
                        <p class="text-gray-500 dark:text-gray-400 text-sm">No related projects found.</p>
                    @endisset
                </div>
            </div>

            {{-- Project Features --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                    Project Features
                </h3>
                <div class="space-y-3">
                    @if(!empty($project->features))
                        <div class="prose max-w-none dark:prose-invert">
                            {!! $project->features !!}
                        </div>

                    @else
                        <ul class="list-disc pl-5 space-y-2 text-gray-600 dark:text-gray-400">
                            <li>Responsive design for optimal viewing on all devices</li>
                            <li>Modern user interface with intuitive navigation</li>
                            <li>Optimized performance and loading speed</li>
                            <li>Secure data handling and user authentication</li>
                            <li>Integration with third-party services</li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection