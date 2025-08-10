<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Avachive</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-50 font-sans">
    <div class="flex flex-col items-center justify-center min-h-screen p-4">
        <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-2xl shadow-lg">
            <!-- Logo Section -->
            <div class="text-center">
                <div class="flex justify-center mb-6">
                    <div class="flex justify-center mb-6">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 w-auto">
                </div>
                </div>
                <h1 class="text-3xl font-bold text-gray-800">Selamat Datang</h1>
                <p class="mt-2 text-gray-600">Silahkan login menggunakan akun Avachive</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Username Field -->
                <div>
                    <x-input-label for="name" :value="__('Username')" class="text-gray-700" />
                    <div class="mt-2 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <x-text-input id="name" class="block w-full pl-12 py-3 text-lg border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-blue-400" 
                                     type="text" name="name" :value="old('name')" required autofocus 
                                     autocomplete="username" placeholder="Masukkan username" />
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Password Field -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
                    <div class="mt-2 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <x-text-input id="password" class="block w-full pl-12 py-3 text-lg border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-blue-400" 
                                     type="password" name="password" required 
                                     autocomplete="current-password" placeholder="Masukkan password" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" class="h-5 w-5 text-blue-500 focus:ring-blue-400 border-gray-300 rounded" name="remember">
                    <label for="remember_me" class="ml-3 block text-md text-gray-700">
                        Ingat saya
                    </label>
                </div>

                <!-- Login Button -->
                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center items-center py-4 px-6 rounded-xl shadow-md text-lg font-semibold text-white bg-gradient-to-r from-blue-400 to-indigo-500 hover:from-blue-500 hover:to-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-300 transition-all duration-200">
                        Masuk
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>