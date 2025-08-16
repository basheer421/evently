<x-app title="Home">
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/home-bg.jpg') }}" 
                 class="w-full h-full object-cover" 
                 alt="Events Background">
            <div class="absolute inset-0 bg-black/60"></div>
        </div>
        
        <!-- Hero Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 w-full">
            <div class="text-center">
                <!-- Main Heading -->
                <h1 class="text-5xl md:text-7xl font-bold text-white mb-8 leading-tight">
                    Find & Book
                    <span class="bg-gradient-to-r from-blue-400 to-cyan-500 bg-clip-text text-transparent">
                        Events
                    </span>
                </h1>
                
                <!-- Description -->
                <p class="text-xl md:text-2xl text-gray-200 mb-12 max-w-3xl mx-auto leading-relaxed">
                    Discover amazing events happening around you. From concerts to conferences, workshops to festivals - find your next unforgettable experience.
                </p>
                
                <!-- Search Bar -->
                <div class="max-w-3xl mx-auto">
                    <form action="{{ route('search') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <input type="text" 
                                   name="query" 
                                   placeholder="Search for events, venues, or organizers..." 
                                   class="w-full px-6 py-4 text-lg text-gray-900 bg-white rounded-full border-0 shadow-xl focus:ring-4 focus:ring-blue-300 focus:outline-none placeholder-gray-500">
                        </div>
                        <button type="submit" 
                                class="px-10 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-full hover:from-blue-600 hover:to-blue-700 transform hover:scale-105 transition-all duration-200 shadow-xl whitespace-nowrap hover:cursor-pointer">
                            Search Events
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </section>

    <!-- Featured Events Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Featured Events</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Don't miss out on these amazing upcoming events
                </p>
            </div>
            
            <!-- Horizontally Scrollable Events -->
            @if($events->count() > 0)
                <div class="overflow-x-auto scrollbar-hide">
                    <div class="flex space-x-6 pb-4" style="width: max-content;">
                        @foreach($events->take(12) as $event)
                            <div class="flex-shrink-0 w-80 bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 cursor-pointer">
                                <!-- Event Image -->
                                <div class="relative h-48 overflow-hidden">
                                    @if($event->image_link)
                                        <img src="{{ $event->image_link }}" 
                                             alt="{{ $event->title }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Event Content -->
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-black mb-3 line-clamp-2">{{ $event->title }}</h3>
                                    <p class="text-gray-500 text-sm line-clamp-3 leading-relaxed">{{ $event->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- View All Events Link -->
                <div class="text-center mt-8">
                    <a href="{{ route('explore') }}" 
                       class="inline-block text-blue-600 hover:text-blue-800 font-semibold transition-colors duration-200">
                        View All Events →
                    </a>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Events Available</h3>
                    <p class="text-gray-600">Check back soon for upcoming events!</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Event Categories Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Browse by Category</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Find events that match your interests
                </p>
            </div>
            
            <!-- Horizontally Scrollable Categories -->
            @if($categories->count() > 0)
                <div class="overflow-x-auto scrollbar-hide">
                    <div class="flex space-x-6 pb-4" style="width: max-content;">
                        @foreach($categories as $category)
                            <div class="flex-shrink-0 w-64 bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 cursor-pointer">
                                <!-- Category Image -->
                                <div class="relative h-40 overflow-hidden">
                                    @if($category->image_link)
                                        <img src="{{ $category->image_link }}" 
                                             alt="{{ $category->name }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Category Content -->
                                <div class="p-6">
                                    <h3 class="text-lg font-bold text-black text-center">{{ $category->name }}</h3>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Categories Available</h3>
                    <p class="text-gray-600">Categories will be added soon!</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-black mb-4">Create your event</h2>
            <p class="text-lg text-black mb-8">
                Start selling tickets in minutes
            </p>
            <div class="flex justify-center">
                <a href="{{ route('register') }}?role=organizer" 
                   class="inline-block px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-full hover:from-blue-600 hover:to-blue-700 transition-all duration-200 transform hover:scale-105">
                    Get Started
                </a>
            </div>
        </div>
    </section>
</x-app>
