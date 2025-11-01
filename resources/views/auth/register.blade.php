
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRD Admin - Register</title>
    <!-- Load Tailwind CSS for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Custom styles for the background gradient and font */
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #c7d2fe 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
        }
        /* Style for the message box, initially hidden */
        #messageBox {
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        /* Show message box when it has content */
        #messageBox:not(:empty) {
            opacity: 1;
        }
    </style>
</head>
<body>

    <div class="w-full max-w-md bg-white p-8 md:p-10 shadow-2xl rounded-xl transform hover:scale-[1.01] transition duration-300">
        <!-- Logo -->
        <div class="text-center mb-6">
            <img src="/logo_hr.png" alt="HRD Admin Logo" class="h-16 mx-auto mb-4">
        </div>

        <!-- Register Header -->
        <h1 class="text-3xl font-extrabold text-gray-900 mb-2 text-center">
            Create Account
        </h1>
        <p class="text-gray-500 mb-8 text-center">
            Join our HRD management system.
        </p>

        <!-- Dynamic Message Box (Success/Error) -->
        <div id="messageBox" role="alert" class="p-3 mb-6 rounded-lg text-sm font-medium">
            @if(session('success'))
                <div class="bg-green-100 border-green-400 text-green-700 p-3 rounded-lg text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="bg-red-100 border-red-400 text-red-700 p-3 rounded-lg text-sm font-medium">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf
            <!-- Username Input -->
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="Enter your username"
                    value="{{ old('username') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 transition duration-150 shadow-sm placeholder:text-gray-400 @error('username') border-red-500 @enderror"
                >
                @error('username')
                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    autocomplete="email"
                    placeholder="you@example.com"
                    value="{{ old('email') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 transition duration-150 shadow-sm placeholder:text-gray-400 @error('email') border-red-500 @enderror"
                >
                @error('email')
                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Input -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Enter your password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 transition duration-150 shadow-sm placeholder:text-gray-400 @error('password') border-red-500 @enderror"
                >
                @error('password')
                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password Input -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Confirm your password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 transition duration-150 shadow-sm placeholder:text-gray-400"
                >
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-150 ease-in-out transform hover:scale-[1.005]"
            >
                Create Account
            </button>
        </form>

        <!-- Sign In Link -->
        <p class="mt-8 text-center text-sm text-gray-600">
            Already have an account?
            <a href="{{ route('login') }}" class="font-medium text-green-600 hover:text-green-700 transition duration-150">
                Sign in here
            </a>
        </p>
    </div>

    <script>
        /**
         * Display message function for dynamic feedback
         */
        function displayMessage(message, classes) {
            const messageBox = document.getElementById('messageBox');
            
            // Clear existing content
            messageBox.innerHTML = '';
            
            // Set the content and style
            const messageDiv = document.createElement('div');
            messageDiv.textContent = message;
            messageDiv.className = `p-3 rounded-lg text-sm font-medium border ${classes}`;
            messageBox.appendChild(messageDiv);

            // Show the box with fade-in
            messageBox.style.opacity = '1';

            // Hide the box after 5 seconds
            setTimeout(() => {
                messageBox.style.opacity = '0';
            }, 5000);
        }

        // Enhanced form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const usernameInput = document.getElementById('username');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            
            const username = usernameInput.value.trim();
            const email = emailInput.value.trim();
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            // Client-side validation
            if (username === '' || email === '' || password === '' || confirmPassword === '') {
                e.preventDefault();
                displayMessage('All fields are required.', 'bg-red-100 border-red-400 text-red-700');
                return false;
            }

            if (password !== confirmPassword) {
                e.preventDefault();
                displayMessage('Passwords do not match.', 'bg-red-100 border-red-400 text-red-700');
                return false;
            }

            if (password.length < 6) {
                e.preventDefault();
                displayMessage('Password must be at least 6 characters.', 'bg-red-100 border-red-400 text-red-700');
                return false;
            }

            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            submitButton.disabled = true;
            submitButton.textContent = 'Creating Account...';
            submitButton.classList.add('opacity-75');

            // Re-enable button after 5 seconds (fallback)
            setTimeout(() => {
                submitButton.disabled = false;
                submitButton.textContent = originalText;
                submitButton.classList.remove('opacity-75');
            }, 5000);
        });

        // Set the initial focus to the username field on load
        window.addEventListener('load', () => {
            document.getElementById('username').focus();
        });

        // Auto-hide existing messages after 5 seconds
        window.addEventListener('load', () => {
            const messageBox = document.getElementById('messageBox');
            if (messageBox.children.length > 0) {
                setTimeout(() => {
                    messageBox.style.opacity = '0';
                }, 5000);
            }
        });
    </script>
</body>
</html>
