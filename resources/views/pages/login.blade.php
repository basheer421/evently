<x-app title="Login">
    <div class="pt-10 md:pt-20 flex flex-col justify-center items-center px-4 md:px-0 pb-10">
        <div class="flex items-center gap-5">
            <x-iconic-arrow-left class="hidden w-6 h-6 text-gray-500 hover:cursor-pointer" id="arrow-icon" />
            <p class="font-bold font-sans text-2xl md:text-3xl text-center">Login to your account</p>
            <span id="arrow-icon-span" class="hidden"></span>
        </div>
        <form id="login-form" class="w-full md:w-1/3 pt-6 md:pt-8 max-w-md" method="post"
            action="{{ route('login.post') }}">
            @csrf

            @if ($errors->any())
                <div class="mb-4">
                    <ul class="list-disc list-inside text-red-500">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <input type="hidden" name="role" value="{{ request()->get('role', 'user') }}">
            <div id="email-wrapper">
                <x-textInput class="" id="email" type="text" name="email" placeholder="Email address" />
            </div>
            <div id="password-wrapper" class="hidden">
                <div class="flex flex-col space-y-4">
                    <x-textInput class="" id="password" type="password" name="password" placeholder="Password" />
                </div>

            </div>
            <div class="pt-6 ">
                <button id="login-button"
                    class="bg-blue-500 text-white p-4 rounded-3xl w-full hover:bg-blue-600 hover:cursor-pointer transition duration-200 h-12 flex justify-center items-center font-semibold">
                    Continue with email
                </button>

            </div>
        </form>

        <p class="pt-6 md:pt-8 text-gray-500">Or continue with</p>

        <div class="w-full md:w-1/3 pt-6 md:pt-8 max-w-md">
            <x-googleButton />
        </div>

        <p class="pt-6 md:pt-8 text-gray-500 text-sm md:text-base text-center max-w-md">By continuing, you agree to
            Evently's <a href="terms" class="underline">Terms of
                Service</a> and acknowledge you've read
            our <a href="privacy" class="underline">Privacy Policy</a>.</p>
    </div>

    <script>
        const emailWrapper = document.getElementById('email-wrapper');
        const email = document.getElementById('email');
        const passwordWrapper = document.getElementById('password-wrapper');
        const password = document.getElementById('password');
        const loginButton = document.getElementById('login-button');
        const form = document.getElementById('login-form');
        const arrowIcon = document.getElementById('arrow-icon');
        const arrowIconSpan = document.getElementById('arrow-icon-span');

        function showInputError(input, message) {
            // Add error styles to input
            input.classList.add('ring-2', 'ring-red-500', 'bg-red-50');
            input.classList.remove('hover:bg-gray-200', 'focus:ring-blue-500');

            // Show error message
            const errorDiv = input.parentElement.querySelector('.error-message');
            errorDiv.textContent = message;
            errorDiv.classList.remove('hidden');
        }

        function clearInputError(input) {
            // Remove error styles
            input.classList.remove('ring-2', 'ring-red-500', 'bg-red-50');
            input.classList.add('hover:bg-gray-200');

            // Clear and hide error message
            const errorDiv = input.parentElement.querySelector('.error-message');
            errorDiv.textContent = '';
            errorDiv.classList.add('hidden');
        }

        function validateEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }

        if (loginButton) {
            loginButton.addEventListener('click', function(event) {
                event.preventDefault();

                if (passwordWrapper.classList.contains('hidden')) {
                    // Email validation step
                    clearInputError(email);

                    if (email.value.trim() === '') {
                        showInputError(email, 'Email is required');
                        return;
                    }

                    if (!validateEmail(email.value.trim())) {
                        showInputError(email, 'Please enter a valid email address');
                        return;
                    }

                    // Show password fields if email is valid
                    passwordWrapper.classList.remove('hidden');
                    emailWrapper.classList.add('hidden');
                    loginButton.textContent = 'Login';
                    arrowIconSpan.classList.remove('hidden');
                    arrowIcon.classList.remove('hidden');
                } else {
                    // Password validation step
                    let isValid = true;

                    if (password.value.trim().length < 8) {
                        showInputError(password, 'Password must be at least 8 characters');
                        isValid = false;
                    } else {
                        clearInputError(password);
                    }

                    if (isValid) {
                        form.submit();
                    }
                }
            });

            // Clear error when user types
            email.addEventListener('input', () => clearInputError(email));
            password.addEventListener('input', () => clearInputError(password));
            passwordConfirmation.addEventListener('input', () => clearInputError(passwordConfirmation));
        }

        if (arrowIcon) {
            arrowIcon.addEventListener('click', function() {
                if (!passwordWrapper.classList.contains('hidden')) {
                    passwordWrapper.classList.add('hidden');
                    emailWrapper.classList.remove('hidden');
                    loginButton.textContent = 'Continue with email';
                    arrowIconSpan.classList.add('hidden');
                    arrowIcon.classList.add('hidden');

                    // Clear any existing errors
                    clearInputError(password);
                    clearInputError(passwordConfirmation);
                }
            });
        }
    </script>
</x-app>
