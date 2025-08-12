<x-app title="Register">
    <div class="pt-10 md:pt-20 flex flex-col justify-center items-center px-4 md:px-0 pb-10">
        <div class="flex items-center gap-5">
            <x-iconic-arrow-left class="hidden w-6 h-6 text-gray-500 hover:cursor-pointer" id="arrow-icon" />
            <p class="font-bold font-sans text-2xl md:text-3xl text-center">Create an account</p>
            <span id="arrow-icon-span" class="hidden"></span>
        </div>
        <form id="register-form" class="w-full md:w-1/3 pt-6 md:pt-8 max-w-md" method="post"
            action="{{ route('register') }}">
            @csrf
            <div id="email-wrapper">
                <x-textInput id="email" type="text" name="email" placeholder="Email address" />
            </div>
            <div id="password-wrapper" class="hidden">
                <div class="flex flex-col space-y-4">
                    <x-textInput id="password" type="password" name="password" placeholder="Password" />
                    <x-textInput id="password_confirmation" type="password" name="password_confirmation"
                        placeholder="Confirm Password" />
                </div>

            </div>
            <div class="pt-6 ">
                {{-- <x-button id="register-button"> Continue with email </x-button> --}}
                <button id="register-button"
                    class="bg-blue-500 text-white p-4 rounded-3xl w-full hover:bg-blue-600 hover:cursor-pointer transition duration-200 h-12 flex justify-center items-center font-semibold">
                    Continue with email
                </button>

            </div>
        </form>

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

    <script>
        const emailWrapper = document.getElementById('email-wrapper');
        const passwordWrapper = document.getElementById('password-wrapper');
        const registerButton = document.getElementById('register-button');
        const form = document.getElementById('register-form');
        const arrowIcon = document.getElementById('arrow-icon');
        const arrowIconSpan = document.getElementById('arrow-icon-span');

        if (registerButton) {
            registerButton.addEventListener('click', function(event) {
                event.preventDefault();
                if (passwordWrapper.classList.contains('hidden')) {
                    passwordWrapper.classList.remove('hidden');
                    emailWrapper.classList.add('hidden');
                    registerButton.textContent = 'Register';
                    arrowIconSpan.classList.remove('hidden');
                    arrowIcon.classList.remove('hidden');
                } else {
                    form.submit();
                }
            });
        }

        if (arrowIcon) {
            arrowIcon.addEventListener('click', function() {
                if (!passwordWrapper.classList.contains('hidden')) {
                    passwordWrapper.classList.add('hidden');
                    emailWrapper.classList.remove('hidden');
                    registerButton.textContent = 'Continue with email';
                    arrowIconSpan.classList.add('hidden');
                    arrowIcon.classList.add('hidden');
                }
            });
        }
    </script>
</x-app>
