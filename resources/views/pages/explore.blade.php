<x-app title="Discover Events">
    <!-- Main Content Section -->
    <section class="py-16 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <h1 class="text-5xl font-bold text-black mb-4">Discover Events</h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Find amazing events happening around you. Filter by category, location, or date to discover your next experience.
                </p>
            </div>
            
            <!-- Search Bar -->
            <div class="max-w-2xl mx-auto mb-12">
                <form action="{{ route('explore') }}" method="GET">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                            <x-heroicon-s-magnifying-glass class="h-5 w-5 text-gray-500" />
                        </div>
                        
                        <div class="absolute inset-y-0 right-0 pr-6 flex items-center">
                            <button type="button" onclick="toggleFilters()" class="text-black hover:text-gray-700 transition-colors duration-200 hover:cursor-pointer">
                                <x-heroicon-s-adjustments-horizontal class="h-5 w-5" />
                            </button>
                        </div>
                        
                        <!-- Search Input -->
                        <input type="text" 
                               name="query" 
                               placeholder="Search for events, venues, or organizers..." 
                               value="{{ request('query') }}"
                               class="w-full pl-14 pr-14 py-4 text-lg text-gray-900 bg-gray-100 rounded-full border-0 focus:ring-4 focus:ring-blue-300 focus:outline-none focus:bg-white placeholder-gray-500 transition-colors duration-200">
                    </div>
                </form>
            </div>

            <!-- Filters Section -->
            <div id="filtersSection" class="max-w-4xl mx-auto mb-12 hidden">
                <div class="rounded-2xl p-8">
                    <h3 class="text-2xl font-bold text-black mb-6">Filters</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Category Dropdown -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                            <div class="relative">
                                <button type="button" onclick="toggleCategoryDropdown()" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg text-left focus:ring-2 focus:ring-blue-300 focus:border-transparent flex items-center justify-between">
                                    <span class="text-gray-500" id="selectedCategory">All Categories</span>
                                    <x-heroicon-s-chevron-down class="h-5 w-5 text-gray-400" />
                                </button>
                                
                                <!-- Category Dropdown -->
                                <div id="categoryDropdown" class="hidden absolute top-full left-0 right-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg max-h-48 overflow-y-auto z-10">
                                    <div class="py-1">
                                        <button type="button" onclick="selectCategory('', 'All Categories')" class="w-full px-4 py-2 text-left hover:bg-gray-50 text-sm">All Categories</button>
                                        @foreach($categories as $category)
                                            <button type="button" onclick="selectCategory('{{ $category->id }}', '{{ $category->name }}')" class="w-full px-4 py-2 text-left hover:bg-gray-50 text-sm">{{ $category->name }}</button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Date Range Dropdown -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
                            <div class="relative">
                                <button type="button" onclick="toggleDatePicker()" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg text-left focus:ring-2 focus:ring-blue-300 focus:border-transparent flex items-center justify-between">
                                    <span class="text-gray-500" id="selectedDateRange">Select dates</span>
                                    <x-heroicon-s-calendar-days class="h-5 w-5 text-gray-400" />
                                </button>
                                
                                <!-- Date Range Dialog -->
                                <div id="datePicker" class="hidden absolute top-full left-0 right-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg p-4 z-10">
                                    <div class="space-y-3">
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">From Date</label>
                                            <input type="date" id="fromDate" class="w-full px-3 py-2 border border-gray-200 rounded text-sm focus:ring-1 focus:ring-blue-300">
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">To Date</label>
                                            <input type="date" id="toDate" class="w-full px-3 py-2 border border-gray-200 rounded text-sm focus:ring-1 focus:ring-blue-300">
                                        </div>
                                        <div class="flex gap-2">
                                            <button type="button" onclick="clearDateRange()" class="flex-1 bg-gray-100 text-gray-700 py-2 rounded text-sm hover:bg-gray-200 transition-colors">
                                                Clear
                                            </button>
                                            <button type="button" onclick="applyDateRange()" class="flex-1 bg-blue-500 text-white py-2 rounded text-sm hover:bg-blue-600 transition-colors">
                                                Apply
                                            </button>
                                        </div>
                                        
                                        <!-- Quick Date Options -->
                                        <div class="border-t pt-3 mt-3">
                                            <p class="text-xs text-gray-500 mb-2">Quick select:</p>
                                            <div class="grid grid-cols-2 gap-2">
                                                <button type="button" onclick="selectQuickDate('today')" class="px-2 py-1 bg-gray-50 hover:bg-gray-100 rounded text-xs transition-colors">
                                                    Today
                                                </button>
                                                <button type="button" onclick="selectQuickDate('tomorrow')" class="px-2 py-1 bg-gray-50 hover:bg-gray-100 rounded text-xs transition-colors">
                                                    Tomorrow
                                                </button>
                                                <button type="button" onclick="selectQuickDate('thisWeek')" class="px-2 py-1 bg-gray-50 hover:bg-gray-100 rounded text-xs transition-colors">
                                                    This Week
                                                </button>
                                                <button type="button" onclick="selectQuickDate('nextWeek')" class="px-2 py-1 bg-gray-50 hover:bg-gray-100 rounded text-xs transition-colors">
                                                    Next Week
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Price Range Dropdown -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
                            <div class="relative">
                                <button type="button" onclick="togglePriceRange()" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg text-left focus:ring-2 focus:ring-blue-300 focus:border-transparent flex items-center justify-between">
                                    <span class="text-gray-500" id="selectedPriceRange">Any price</span>
                                    <x-heroicon-s-currency-dollar class="h-5 w-5 text-gray-400" />
                                </button>
                                
                                <!-- Price Range Dialog -->
                                <div id="priceRange" class="hidden absolute top-full left-0 right-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg p-4 z-10">
                                    <div class="space-y-3">
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Min Price</label>
                                            <input type="number" id="minPrice" placeholder="0" min="0" class="w-full px-3 py-2 border border-gray-200 rounded text-sm focus:ring-1 focus:ring-blue-300">
                                        </div>
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Max Price</label>
                                            <input type="number" id="maxPrice" placeholder="1000" min="0" class="w-full px-3 py-2 border border-gray-200 rounded text-sm focus:ring-1 focus:ring-blue-300">
                                        </div>
                                        <div class="flex gap-2">
                                            <button type="button" onclick="clearPriceRange()" class="flex-1 bg-gray-100 text-gray-700 py-2 rounded text-sm hover:bg-gray-200 transition-colors">
                                                Clear
                                            </button>
                                            <button type="button" onclick="applyPriceRange()" class="flex-1 bg-blue-500 text-white py-2 rounded text-sm hover:bg-blue-600 transition-colors">
                                                Apply
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sort By Dropdown -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                            <div class="relative">
                                <button type="button" onclick="toggleSortDropdown()" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg text-left focus:ring-2 focus:ring-blue-300 focus:border-transparent flex items-center justify-between">
                                    <span class="text-gray-500" id="selectedSort">Date (Ascending)</span>
                                    <x-heroicon-s-chevron-down class="h-5 w-5 text-gray-400" />
                                </button>
                                
                                <!-- Sort Dropdown -->
                                <div id="sortDropdown" class="hidden absolute top-full left-0 right-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg z-10">
                                    <div class="py-1">
                                        <button type="button" onclick="selectSort('asc', 'Date (Ascending)')" class="w-full px-4 py-2 text-left hover:bg-gray-50 text-sm">Date (Ascending)</button>
                                        <button type="button" onclick="selectSort('desc', 'Date (Descending)')" class="w-full px-4 py-2 text-left hover:bg-gray-50 text-sm">Date (Descending)</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Events and filters will be added here...</p>
            </div>
        </div>
    </section>

    <script>
        function toggleFilters() {
            const filtersSection = document.getElementById('filtersSection');
            filtersSection.classList.toggle('hidden');
        }

        function toggleDatePicker() {
            const datePicker = document.getElementById('datePicker');
            datePicker.classList.toggle('hidden');
        }

        function togglePriceRange() {
            const priceRange = document.getElementById('priceRange');
            priceRange.classList.toggle('hidden');
        }

        function toggleCategoryDropdown() {
            const categoryDropdown = document.getElementById('categoryDropdown');
            categoryDropdown.classList.toggle('hidden');
        }

        function toggleSortDropdown() {
            const sortDropdown = document.getElementById('sortDropdown');
            sortDropdown.classList.toggle('hidden');
        }

        function selectCategory(value, text) {
            document.getElementById('selectedCategory').textContent = text;
            document.getElementById('categoryDropdown').classList.add('hidden');
            // Store the value for form submission
            // Can be connected to actual form processing later
        }

        function selectSort(value, text) {
            document.getElementById('selectedSort').textContent = text;
            document.getElementById('sortDropdown').classList.add('hidden');
            // Store the value for form submission
            // Can be connected to actual form processing later
        }

        function applyPriceRange() {
            const minPrice = document.getElementById('minPrice').value;
            const maxPrice = document.getElementById('maxPrice').value;
            const selectedPriceRange = document.getElementById('selectedPriceRange');
            
            // Validate inputs
            if (minPrice && maxPrice && parseFloat(minPrice) > parseFloat(maxPrice)) {
                alert('Min price cannot be greater than max price');
                return;
            }
            
            // Update display text
            let displayText = 'Any price';
            
            if (minPrice && maxPrice) {
                displayText = `$${minPrice} - $${maxPrice}`;
            } else if (minPrice) {
                displayText = `$${minPrice}+`;
            } else if (maxPrice) {
                displayText = `Up to $${maxPrice}`;
            }
            
            selectedPriceRange.textContent = displayText;
            selectedPriceRange.classList.remove('text-gray-500');
            selectedPriceRange.classList.add('text-gray-900');
            
            // Close dropdown
            document.getElementById('priceRange').classList.add('hidden');
            
            // Store values for form submission
            // Can be connected to actual form processing later
        }

        function clearPriceRange() {
            document.getElementById('minPrice').value = '';
            document.getElementById('maxPrice').value = '';
            const selectedPriceRange = document.getElementById('selectedPriceRange');
            selectedPriceRange.textContent = 'Any price';
            selectedPriceRange.classList.remove('text-gray-900');
            selectedPriceRange.classList.add('text-gray-500');
            
            // Close dropdown
            document.getElementById('priceRange').classList.add('hidden');
        }

        function applyDateRange() {
            const fromDate = document.getElementById('fromDate').value;
            const toDate = document.getElementById('toDate').value;
            const selectedDateRange = document.getElementById('selectedDateRange');
            
            // Validate dates
            if (fromDate && toDate && new Date(fromDate) > new Date(toDate)) {
                alert('From date cannot be later than to date');
                return;
            }
            
            // Update display text
            let displayText = 'Select dates';
            
            if (fromDate && toDate) {
                const fromFormatted = formatDateDisplay(fromDate);
                const toFormatted = formatDateDisplay(toDate);
                displayText = `${fromFormatted} - ${toFormatted}`;
            } else if (fromDate) {
                displayText = `From ${formatDateDisplay(fromDate)}`;
            } else if (toDate) {
                displayText = `Until ${formatDateDisplay(toDate)}`;
            }
            
            selectedDateRange.textContent = displayText;
            selectedDateRange.classList.remove('text-gray-500');
            selectedDateRange.classList.add('text-gray-900');
            
            // Close dropdown
            document.getElementById('datePicker').classList.add('hidden');
        }

        function clearDateRange() {
            document.getElementById('fromDate').value = '';
            document.getElementById('toDate').value = '';
            const selectedDateRange = document.getElementById('selectedDateRange');
            selectedDateRange.textContent = 'Select dates';
            selectedDateRange.classList.remove('text-gray-900');
            selectedDateRange.classList.add('text-gray-500');
            
            // Close dropdown
            document.getElementById('datePicker').classList.add('hidden');
        }

        function selectQuickDate(period) {
            const today = new Date();
            const fromDateInput = document.getElementById('fromDate');
            const toDateInput = document.getElementById('toDate');
            
            let fromDate, toDate;
            
            switch(period) {
                case 'today':
                    fromDate = toDate = today;
                    break;
                case 'tomorrow':
                    fromDate = toDate = new Date(today.getTime() + 24 * 60 * 60 * 1000);
                    break;
                case 'thisWeek':
                    fromDate = today;
                    toDate = new Date(today.getTime() + (6 - today.getDay()) * 24 * 60 * 60 * 1000);
                    break;
                case 'nextWeek':
                    const daysUntilNextWeek = 7 - today.getDay();
                    fromDate = new Date(today.getTime() + daysUntilNextWeek * 24 * 60 * 60 * 1000);
                    toDate = new Date(fromDate.getTime() + 6 * 24 * 60 * 60 * 1000);
                    break;
            }
            
            fromDateInput.value = formatDateInput(fromDate);
            toDateInput.value = formatDateInput(toDate);
            
            // Auto-apply the selection
            applyDateRange();
        }

        function formatDateInput(date) {
            return date.toISOString().split('T')[0];
        }

        function formatDateDisplay(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', { 
                month: 'short', 
                day: 'numeric',
                year: date.getFullYear() !== new Date().getFullYear() ? 'numeric' : undefined
            });
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const datePicker = document.getElementById('datePicker');
            const priceRange = document.getElementById('priceRange');
            const categoryDropdown = document.getElementById('categoryDropdown');
            const sortDropdown = document.getElementById('sortDropdown');
            
            if (!event.target.closest('#datePicker') && !event.target.closest('button[onclick="toggleDatePicker()"]')) {
                datePicker.classList.add('hidden');
            }
            
            if (!event.target.closest('#priceRange') && !event.target.closest('button[onclick="togglePriceRange()"]')) {
                priceRange.classList.add('hidden');
            }

            if (!event.target.closest('#categoryDropdown') && !event.target.closest('button[onclick="toggleCategoryDropdown()"]')) {
                categoryDropdown.classList.add('hidden');
            }

            if (!event.target.closest('#sortDropdown') && !event.target.closest('button[onclick="toggleSortDropdown()"]')) {
                sortDropdown.classList.add('hidden');
            }
        });
    </script>
</x-app>
