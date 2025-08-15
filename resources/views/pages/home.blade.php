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
                    <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">
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
                                   class="w-full px-6 py-4 text-lg text-gray-900 bg-white rounded-full border-0 shadow-xl focus:ring-4 focus:ring-orange-300 focus:outline-none placeholder-gray-500">
                        </div>
                        <button type="submit" 
                                class="px-10 py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-full hover:from-orange-600 hover:to-red-600 transform hover:scale-105 transition-all duration-200 shadow-xl whitespace-nowrap">
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
            
            <!-- Events Grid -->
            @if($events->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($events->take(6) as $event)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group">
                            <!-- Event Image -->
                            <div class="relative h-48 overflow-hidden">
                                @if($event->image_link)
                                    <img src="{{ $event->image_link }}" 
                                         alt="{{ $event->title }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                <!-- Event Type Badge -->
                                <div class="absolute top-4 left-4">
                                    <span class="inline-block px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-sm font-medium text-gray-800">
                                        {{ ucfirst($event->type) }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Event Content -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">{{ $event->title }}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $event->description }}</p>
                                
                                <!-- Event Details -->
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($event->start_time)->format('M j, Y • g:i A') }}
                                    </div>
                                    @if($event->location)
                                        <div class="flex items-center text-sm text-gray-500">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            {{ $event->location }}
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- View Event Button -->
                                <button class="w-full py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105">
                                    View Event
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- View All Events Button -->
                <div class="text-center mt-12">
                    <a href="{{ route('explore') }}" 
                       class="inline-block px-8 py-4 bg-gradient-to-r from-gray-800 to-gray-900 text-white font-semibold rounded-full hover:from-gray-900 hover:to-black transition-all duration-200 transform hover:scale-105">
                        View All Events
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
            
            <!-- Categories Grid -->
            @if($categories->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($categories as $category)
                        <div class="group cursor-pointer">
                            <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-8 text-center hover:from-blue-100 hover:to-purple-100 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                                <!-- Category Icon -->
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-200">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                
                                <!-- Category Name -->
                                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $category->name }}</h3>
                                
                                <!-- Category Description -->
                                @if($category->description)
                                    <p class="text-sm text-gray-600 line-clamp-2">{{ $category->description }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
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
    <section class="py-16 bg-gradient-to-r from-blue-600 to-purple-600">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl font-bold text-white mb-4">Ready to Discover Amazing Events?</h2>
            <p class="text-xl text-blue-100 mb-8">
                Join thousands of event-goers and never miss out on the best experiences in your area.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('explore') }}" 
                   class="inline-block px-8 py-4 bg-white text-blue-600 font-semibold rounded-full hover:bg-gray-100 transition-all duration-200 transform hover:scale-105">
                    Explore Events
                </a>
                @guest
                    <a href="{{ route('register') }}" 
                       class="inline-block px-8 py-4 border-2 border-white text-white font-semibold rounded-full hover:bg-white hover:text-blue-600 transition-all duration-200 transform hover:scale-105">
                        Sign Up Free
                    </a>
                @endguest
            </div>
        </div>
    </section>
</x-app>
