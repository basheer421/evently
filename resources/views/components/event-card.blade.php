<div {{ $attributes->merge(['class' => "flex-shrink-0 {$containerClass} bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 cursor-pointer"]) }}>
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
        
        @if(isset($showDetails) && $showDetails)
            <!-- Event Details for Grid View -->
            <div class="mt-4 space-y-2">
                <div class="flex items-center text-sm text-gray-500">
                    <x-heroicon-s-calendar-days class="w-4 h-4 mr-2" />
                    {{ \Carbon\Carbon::parse($event->start_time)->format('M j, Y • g:i A') }}
                </div>
                @if($event->location)
                    <div class="flex items-center text-sm text-gray-500">
                        <x-heroicon-s-map-pin class="w-4 h-4 mr-2" />
                        {{ Str::limit($event->location, 30) }}
                    </div>
                @endif
                <div class="flex items-center text-sm text-gray-500">
                    <x-heroicon-s-tag class="w-4 h-4 mr-2" />
                    {{ ucfirst($event->type) }}
                </div>
            </div>
        @endif
    </div>
</div>