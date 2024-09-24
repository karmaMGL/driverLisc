<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .dynamic-bg {
            background: linear-gradient(135deg, #42a5f5, #ab47bc);
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

    <div class="max-w-md w-full bg-white shadow-lg rounded-lg p-6">
        <!-- Site Name -->
        <h1 class="text-3xl font-bold text-center text-purple-600 mb-4">Smart Drive</h1>

        <p class="text-center text-gray-600 mb-6">Өнөөдөр бидэнтэй нэгдээрэй! Бүртгэлээ үүсгэ нүү .</p>

        @if($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Oops!</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Registration Form -->
        <form action="{{ route('registerFuncs') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-gray-700 font-medium">Нэр</label>
                <input type="text" name="name" id="name" placeholder="Нэрээ оруулна уу" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400">
            </div>

            <div>
                <label for="email" class="block text-gray-700 font-medium">Имэйл хаяг</label>
                <input type="email" name="email" id="email" placeholder="Имэйлээ оруулна уу" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400">
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-medium">Нууц үг</label>
                <input type="password" name="password" id="password" placeholder="Нууц үгээ оруулна уу" required class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400">
            </div>

            <button type="submit" class="w-full bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 rounded-lg transition duration-300">Бүртгүүлэх</button>
        </form>

        <!-- Link to Login -->
        <div class="text-center mt-4">
            <p class="text-gray-600">Бүртгэлтэй юу?<a href="{{ route('login') }}" class="text-purple-500 hover:underline">Энд нэвтэрнэ үү</a>.</p>
        </div>
    </div>
</body>
</html>
