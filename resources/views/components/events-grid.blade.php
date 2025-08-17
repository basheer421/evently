@if($events->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($events as $event)
            <x-event-card :event="$event" container-class="w-full" :show-details="true" />
        @endforeach
    </div>
    
    <!-- Pagination -->
    @if($events->hasPages())
        <div class="mt-8 flex justify-center">
            {{ $events->appends(request()->query())->links() }}
        </div>
    @endif
@else
    <div class="text-center py-12">
        <x-heroicon-s-x-mark class="w-16 h-16 text-gray-400 mx-auto mb-4" />
        <h3 class="text-xl font-semibold text-gray-900 mb-2">No Events Found</h3>
        <p class="text-gray-600">Try adjusting your search criteria or check back later for new events.</p>
    </div>
@endif
