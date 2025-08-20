<!-- Container -->
<header class="flex">
  <!-- Sidebar (hanya muncul saat layar besar) - Menggunakan gaya kode pertama -->
  <nav class="hidden lg:flex flex-col w-64 h-screen bg-[#1e272e] shadow-2xl fixed top-0 left-0 z-20">
    <!-- Logo Section -->
    <div class="flex flex-col items-center justify-center py-8">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20 w-auto mb-4">
      <h2 class="text-2xl font-bold text-[#00cec9]">Kasir</h2>
    </div>

    <ul class="mt-6 space-y-1 px-4">
      <li>
        <a href="../kasir/dashboard" class="flex items-center px-4 py-3 text-[#dcdde1] hover:bg-[#00cec9] hover:text-white rounded-lg transition-all duration-200 group {{ request()->is('kasir/dashboard*') ? 'bg-[#00cec9] text-white' : '' }}">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
          </svg>
          Dashboard
        </a>
      </li>
      <li>
        <a href="../kasir/pelanggan" class="flex items-center px-4 py-3 text-[#dcdde1] hover:bg-[#00cec9] hover:text-white rounded-lg transition-all duration-200 group {{ request()->is('kasir/pelanggan*') ? 'bg-[#00cec9] text-white' : '' }}">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
          Pelanggan
        </a>
      </li>
      <li>
        <a href="../kasir/buat_order" class="flex items-center px-4 py-3 text-[#dcdde1] hover:bg-[#00cec9] hover:text-white rounded-lg transition-all duration-200 group {{ request()->is('kasir/buat_order*') ? 'bg-[#00cec9] text-white' : '' }}">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
          </svg>
          Buat Order
        </a>
      </li>
      <li>
        <!-- Data Order with submenu -->
        <div x-data="{ open: {{ request()->is('kasir/data_order*') || request()->is('kasir/riwayat_order*') ? 'true' : 'false' }} }" class="relative">
          <button @click="open = !open" class="flex items-center justify-between w-full px-4 py-3 text-[#dcdde1] hover:bg-[#00cec9] hover:text-white rounded-lg transition-all duration-200 group {{ request()->is('kasir/data_order*') || request()->is('kasir/riwayat_order*') ? 'bg-[#00cec9] text-white' : '' }}">
            <div class="flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              Data Order
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200" :class="{'transform rotate-90': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </button>
          
          <!-- Submenu -->
          <div x-show="open" x-transition:enter="transition ease-out duration-100" 
               x-transition:enter-start="opacity-0 scale-95" 
               x-transition:enter-end="opacity-100 scale-100" 
               x-transition:leave="transition ease-in duration-75" 
               x-transition:leave-start="opacity-100 scale-100" 
               x-transition:leave-end="opacity-0 scale-95"
               class="ml-8 mt-1 space-y-1">
            <a href="../kasir/data_order" class="flex items-center px-4 py-2 text-sm text-[#dcdde1] hover:bg-[#00cec9] hover:text-white rounded-lg transition-all duration-200 group {{ request()->is('kasir/data_order*') ? 'bg-[#00cec9] text-white' : '' }}">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
              List Order
            </a>
            <a href="../kasir/riwayat_order" class="flex items-center px-4 py-2 text-sm text-[#dcdde1] hover:bg-[#00cec9] hover:text-white rounded-lg transition-all duration-200 group {{ request()->is('kasir/riwayat_order*') ? 'bg-[#00cec9] text-white' : '' }}">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
              Riwayat Order
            </a>
          </div>
        </div>
      </li>
      <li>
        <a href="../kasir/pengaturan" class="flex items-center px-4 py-3 text-[#dcdde1] hover:bg-[#00cec9] hover:text-white rounded-lg transition-all duration-200 group {{ request()->is('kasir/pengaturan*') ? 'bg-[#00cec9] text-white' : '' }}">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          Pengaturan
        </a>
      </li>
    </ul>
    
    <!-- Footer sidebar -->
    <div class="mt-auto p-4 text-[#dcdde1] text-sm">
      © 2025 Kasir App
    </div>
  </nav>

  <!-- Header Navbar for Mobile - Tetap menggunakan warna biru untuk mobile -->
  <div class="w-full lg:ml-64">
    <div class="bg-white fixed top-0 left-0 w-full flex items-center justify-between p-4 lg:hidden z-10 shadow-md">
      <div class="font-bold text-blue-800 text-xl">Kasir</div>
      <button id="hamburger" type="button" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>

    <!-- Mobile menu - Tetap menggunakan warna biru untuk mobile -->
    <nav id="nav-menu" class="hidden fixed mt-16 bg-white w-full p-4 shadow-lg lg:hidden z-10 border-t border-gray-100">
      <!-- ... (isi menu mobile sama seperti sebelumnya) ... -->
    </nav>
  </div>
</header>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>