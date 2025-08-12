<x-app title="Register">
    <div class="pt-10 md:pt-20 flex flex-col justify-center items-center px-4 md:px-0">
        <p class="font-bold font-sans text-2xl md:text-3xl text-center">Create an account</p>
        <div class="w-full md:w-1/3 pt-6 md:pt-8 max-w-md">
            <x-textInput type="text" name="email" placeholder="Email address" />
        </div>
        <div class="w-full md:w-1/3 pt-6 md:pt-8 max-w-md">
            <x-button> Continue with email </x-button>
        </div>

        <p class="pt-6 md:pt-8 text-gray-500">Or continue with</p>

        <div class="w-full md:w-1/3 pt-6 md:pt-8 max-w-md">
            <x-googleButton />
        </div>

        <p class="pt-6 md:pt-8 text-gray-500 text-center">Want to be an organizer? <a href="?role=organizer"
                class="underline">Click
                here</a>
        </p>

        <p class="pt-6 md:pt-8 text-gray-500 text-sm md:text-base text-center max-w-md">By continuing, you agree to
            Evently's <a href="terms" class="underline">Terms of
                Service</a> and acknowledge you've read
            our <a href="privacy" class="underline">Privacy Policy</a>.</p>
    </div>
</x-app>
