<a
    class="flex items-center justify-between w-full bg-[#F0F2F5] rounded-4xl shadow-sm p-3 md:p-4 cursor-pointer hover:bg-gray-200 transition duration-400"
    href="{{ route('google.redirect') }}/?role={{ request()->get('role', 'user') }}" id="google-button"
    >
    <x-fab-google class="w-5 h-5" />
    <p class="font-semibold text-sm md:text-base">Continue with Google</p>
    <span></span>
</a>
