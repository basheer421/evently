<nav class="bg-white border-b border-gray-200">
    <div class="px-4 md:px-15 py-5 mx-auto">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2 gap-x-1.5">
                <a href=" {{ route('home') }} " class="flex items-center">
                    <img class="w-5 h-5" src="{{ asset('images/logos/evently-logo.svg') }}" alt="Evently Logo" />
                    <p class="font-bold ml-1.5">Evently</p>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-10">
                @auth
                    <a href="{{ route('home') }}"
                        class="text-black hover:font-semibold transition-all duration-200">Home</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="text-black hover:font-semibold transition-all duration-200 hover:cursor-pointer">Log
                            out</button>
                    @else
                        <a href="{{ route('register') }}"
                            class="text-black hover:font-semibold transition-all duration-200">Register</a>
                        <a href="{{ route('login') }}"
                            class="text-black hover:font-semibold transition-all duration-200">Login</a>
                    @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button id="menu-button" type="button" class="text-gray-600 hover:text-gray-900 focus:outline-none p-2"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!-- Burger icon -->
                    <svg class="h-6 w-6 transform transition-transform duration-300" id="menu-icon" fill="none"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"
                            class="origin-center transition-all duration-300" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden mt-4 overflow-hidden transition-all duration-300 max-h-0">
            <div class="flex flex-col space-y-4 pb-3 pt-2">
                @auth
                    <a href="{{ route('home') }}"
                        class="text-black hover:font-semibold px-2 py-2 text-base transition-all duration-200 hover:bg-gray-50 rounded-lg">Home</a>
                @else
                    <a href="{{ route('register') }}"
                        class="text-black hover:font-semibold px-2 py-2 text-base transition-all duration-200 hover:bg-gray-50 rounded-lg">Register</a>
                    <a href="{{ route('login') }}"
                        class="text-black hover:font-semibold px-2 py-2 text-base transition-all duration-200 hover:bg-gray-50 rounded-lg">Login</a>
                @endauth

            </div>
        </div>
    </div>
</nav>
