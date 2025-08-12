<x-app title="Register">
    <x-logo />
    <div class="pt-20 flex flex-col justify-center items-center">
        <p class="font-bold font-sans text-3xl">Create an account</p>
        <div class="w-1/3 pt-8">
            <x-textInput type="text" name="email" placeholder="Email address" />
        </div>
        <div class="w-1/3 pt-8">
            <x-button> Continue with email </x-button>
        </div>

        <p class="pt-8 text-gray-500">Or continue with</p>

        <div class="w-1/3 pt-8">
            <x-googleButton />
        </div>

        <p class="pt-8 text-gray-500">Want to be an organizer? <a href="?role=organizer" class="underline">Click
                here</a>
        </p>

        <p class="pt-8 text-gray-500">By continuing, you agree to Evently's <a href="terms" class="underline">Terms of
                Service</a> and acknowledge you've read
            our <a href="privacy" class="underline">Privacy Policy</a>.</p>

    </div>
</x-app>
