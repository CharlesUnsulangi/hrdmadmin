<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRD Admin - Forgot Password</title>
    <!-- Load Tailwind CSS for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Custom styles for the background gradient and font */
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0f4f8 0%, #c4d7e7 100%);
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

        <!-- Forgot Password Header -->
        <h1 class="text-3xl font-extrabold text-gray-900 mb-2 text-center">
            Reset Password
        </h1>
        <p class="text-gray-500 mb-8 text-center">
            Enter your email address and we'll send you a link to reset your password.
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

        <!-- Forgot Password Form -->
        <form method="POST" action="#" class="space-y-6">
            @csrf
            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="you@example.com"
                    value="{{ old('email') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-purple-500 focus:border-purple-500 transition duration-150 shadow-sm placeholder:text-gray-400 @error('email') border-red-500 @enderror"
                >
                @error('email')
                    <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full py-3 bg-purple-600 text-white font-semibold rounded-lg shadow-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition duration-150 ease-in-out transform hover:scale-[1.005]"
            >
                Send Reset Link
            </button>
        </form>

        <!-- Back to Login Link -->
        <p class="mt-8 text-center text-sm text-gray-600">
            Remember your password?
            <a href="{{ route('login') }}" class="font-medium text-purple-600 hover:text-purple-700 transition duration-150">
                Back to login
            </a>
        </p>

        <!-- Info Note -->
        <div class="mt-6 p-4 bg-amber-50 border border-amber-200 rounded-lg">
            <div class="text-xs text-amber-700 text-center">
                <span class="font-medium">Note:</span> Password reset functionality is currently under development. Please contact your administrator for password reset assistance.
            </div>
        </div>
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
            e.preventDefault(); // Prevent actual submission since it's not implemented
            
            const emailInput = document.getElementById('email');
            const email = emailInput.value.trim();

            // Client-side validation
            if (email === '') {
                displayMessage('Email address is required.', 'bg-red-100 border-red-400 text-red-700');
                return false;
            }

            // Email format validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                displayMessage('Please enter a valid email address.', 'bg-red-100 border-red-400 text-red-700');
                return false;
            }

            // Show demo success message since functionality is not implemented
            displayMessage('Reset link would be sent to your email (feature under development).', 'bg-blue-100 border-blue-400 text-blue-700');

            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.textContent;
            submitButton.disabled = true;
            submitButton.textContent = 'Sending...';
            submitButton.classList.add('opacity-75');

            // Re-enable button after 3 seconds
            setTimeout(() => {
                submitButton.disabled = false;
                submitButton.textContent = originalText;
                submitButton.classList.remove('opacity-75');
            }, 3000);
        });

        // Set the initial focus to the email field on load
        window.addEventListener('load', () => {
            document.getElementById('email').focus();
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
