<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .dynamic-bg {
            background: linear-gradient(135deg, #4c84ff, #d391fa);
            background-size: 300% 300%;
            animation: gradientAnimation 12s ease infinite;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body class="dynamic-bg min-h-screen flex items-center justify-center">

    @isset($success)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
          alert("{{$success}}");
        });
      </script>

    @endisset
    <div class="max-w-md w-full bg-white shadow-lg rounded-lg p-6">
        <!-- Site Name -->
        <h1 class="text-3xl font-bold text-center text-blue-600 mb-4">Admin login</h1>

        <!-- Welcome Message -->
        <p class="text-center text-gray-600 mb-6">Welcome back! Please login to your account.</p>

        @if (session()->has('error'))
            <div class="bg-red-500 text-white p-3 mb-4 rounded-lg text-center">
                {{ session('error') }}
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('adminLoginFunc') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-gray-700 font-medium">Email Address</label>
                <input type="email" name="email" id="email" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-medium">Password</label>
                <input type="password" name="password" id="password" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 rounded-lg transition duration-300">Login</button>
        </form>

        <!-- Additional Links -->
        <div class="flex justify-between items-center mt-4">
            <a href="#" class="text-blue-500 hover:underline">Forgot Password?</a>
            <a href="{{route('registerPage')}}" class="text-blue-500 hover:underline">Create New Account</a>
        </div>
    </div>
</body>
</html>
