<div
    class="px-15 py-5 border-b border-gray-200 flex justify-between items-center"
>
    <div class="flex items-center space-x-2 gap-x-1.5">
        <span
            ><img
                class="w-5 h-5"
                src="{{ asset('images/logos/evently-logo.svg') }}"
                alt="Evently Logo"
        /></span>
        <p class="font-bold">Evently</p>
    </div>
    <div class="flex items-center space-x-10">
        <a href="{{ route('register') }}" class="text-black hover:font-semibold"
            >Register</a
        >
        <a href="{{ route('login') }}" class="text-black hover:font-semibold"
            >Login</a
        >
        <a href="#" class="text-black hover:font-semibold">Home</a>
    </div>
</div>
