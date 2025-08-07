<!-- Container -->
<header class="flex">
  <!-- Sidebar (hanya muncul saat layar besar) -->
  <nav class="hidden lg:flex flex-col w-64 h-screen bg-blue-800 shadow-lg fixed top-0 left-0 z-20">
    <div class="p-6 text-lg font-bold text-white">Kasir</div>
    <ul class="mt-4 space-y-2">
      <li><a href="../kasir/dashboard" class="block px-6 py-3 text-white hover:bg-teal-500 rounded-md transition duration-200">Dashboard</a></li>
      <li><a href="../kasir/pelanggan" class="block px-6 py-3 text-white hover:bg-teal-500 rounded-md transition duration-200">Pelanggan</a></li>
      <li><a href="../kasir/buat_order" class="block px-6 py-3 text-white hover:bg-teal-500 rounded-md transition duration-200">Buat Order</a></li>
      <li><a href="../kasir/data_order" class="block px-6 py-3 text-white hover:bg-teal-500 rounded-md transition duration-200">Data Order</a></li>
      <li><a href="../kasir/pengaturan" class="block px-6 py-3 text-white hover:bg-teal-500 rounded-md transition duration-200">Pengaturan</a></li>
    </ul>
  </nav>

  <!-- Header Navbar for Mobile -->
  <div class="w-full lg:ml-64">
    <div class="bg-transparent fixed top-0 left-0 w-full flex items-center justify-end p-4 lg:hidden z-10">
      <button id="hamburger" type="button" class="block">
        <span class="w-[30px] h-[2px] my-2 block bg-slate-900 transition duration-300 ease-in-out"></span>
        <span class="w-[30px] h-[2px] my-2 block bg-slate-900 transition duration-300 ease-in-out"></span>
        <span class="w-[30px] h-[2px] my-2 block bg-slate-900 transition duration-300 ease-in-out"></span>
      </button>
    </div>

    <!-- Mobile menu -->
    <nav id="nav-menu" class="hidden fixed mt-16 bg-white w-full p-6 shadow-lg lg:hidden">
      <ul class="space-y-4">
        <a href="#home" class="font-bold text-lg text-teal-500">Kasir</a>
        <li><a href="#dashboard" class="block text-slate-900 hover:text-teal-500">Dashboard</a></li>
        <li><a href="#about" class="block text-slate-900 hover:text-teal-500">Pelanggan</a></li>
        <li><a href="#portfolio" class="block text-slate-900 hover:text-teal-500">Buat Order</a></li>
        <li><a href="#clients" class="block text-slate-900 hover:text-teal-500">Data Order</a></li>
        <li><a href="#blog" class="block text-slate-900 hover:text-teal-500">Pelanggan</a></li>
      </ul>
    </nav>
  </div>
</header>