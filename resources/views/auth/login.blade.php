<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="name" :value="__('name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="name" name="name" :value="old('name')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avacive - Sistem Laundry</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/0948e65078.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 400px;
            padding: 30px;
        }

        .logo {
            background-color: #4f46e5;
            color: white;
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            font-size: 32px;
            font-weight: bold;
        }

        .role-btn {
            border: 2px solid;
            padding: 12px 16px;
            margin-bottom: 12px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .role-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .role-btn i:first-child {
            margin-right: 10px;
        }

        /* Modified modal styles */
        #loginModal {
            backdrop-filter: blur(5px);
            background-color: rgba(255, 255, 255, 0.5);
        }

        #loginModal>div {
            background-color: white;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="login-card">
        <!-- Logo dan Judul -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Avacive" class="w-20 h-20 object-contain">
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Avachive</h1>
            <p class="text-lg text-gray-600 mb-2">Selamat Datang Di Avachive</p>
            <p class="text-gray-700 font-medium mb-6">Solusi Kelola Bisnis Laundry Anda</p>
        </div>

        <!-- Pilihan Login -->
        <div class="space-y-4">
            <!-- Admin -->
            <button onclick="showLoginForm('admin')"
                class="role-btn border-purple-500 text-purple-600 bg-purple-50 hover:bg-purple-100 w-full">
                <div class="flex items-center">
                    <i class="fas fa-user-shield"></i>
                    <span>Login sebagai Admin</span>
                </div>
                <i class="fas fa-chevron-right"></i>
            </button>

            <!-- Kasir -->
            <button onclick="showLoginForm('kasir')"
                class="role-btn border-blue-500 text-blue-600 bg-blue-50 hover:bg-blue-100 w-full">
                <div class="flex items-center">
                    <i class="fas fa-cash-register"></i>
                    <span>Login sebagai Kasir</span>
                </div>
                <i class="fas fa-chevron-right"></i>
            </button>

            <!-- Driver -->
            <button onclick="showLoginForm('driver')"
                class="role-btn border-green-500 text-green-600 bg-green-50 hover:bg-green-100 w-full">
                <div class="flex items-center">
                    <i class="fas fa-motorcycle"></i>
                    <span>Login sebagai Driver</span>
                </div>
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>

    <!-- Login Form Modal with blur background -->
    <div id="loginModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="rounded-lg p-6 w-full max-w-sm">
            <div class="flex justify-between items-center mb-5">
                <h2 id="modalTitle" class="text-xl font-bold text-gray-800">Login</h2>
                <button onclick="closeLoginForm()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf

                <input type="hidden" id="usertypeInput" name="usertype" value="">

                <div class="mb-4">
                    <input type="text" name="name" placeholder="Username"
                        class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-5">
                    <input type="password" name="password" placeholder="Password"
                        class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 font-medium">
                    Masuk
                </button>
            </form>
        </div>
    </div>

    <script>
        function showLoginForm(role) {
            const modal = document.getElementById('loginModal');
            const title = document.getElementById('modalTitle');
            const roles = {
                'admin': 'Admin',
                'kasir': 'Kasir',
                'driver': 'Driver'
            };
            title.textContent = `Login sebagai ${roles[role]}`;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeLoginForm() {
            document.getElementById('loginModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Baris ini yang mencegah form dikirim ke server
            alert('Login berhasil!');
            closeLoginForm();
        });

        document.getElementById('loginModal').addEventListener('click', function(e) {
            if (e.target === this) closeLoginForm();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLoginForm();
            }
        });
    </script>
</body>

</html> --}}
