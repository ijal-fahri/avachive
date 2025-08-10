<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Platform</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 font-sans">
    <div class="flex flex-col items-center justify-center min-h-screen p-4">
        <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-2xl shadow-xl transform transition-all hover:scale-[1.01]">
            <div class="text-center">
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 w-auto">
                </div>
                <h1 class="text-3xl font-bold text-gray-800">Selamat Datang</h1>
                <p class="mt-2 text-gray-600">Silahkan login sesuai akun dan role nya masing masing</p>
            </div>

            <div class="mt-8 space-y-4">
                <a href="{{ route('login') }}" class="w-full flex items-center justify-center px-6 py-3 text-lg font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg shadow hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 transform hover:-translate-y-1">
                    Login
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</body>
</html>