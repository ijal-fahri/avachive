<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Data Karyawan - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Poppins', sans-serif; background: #f4f7fc; color: #333; }
        .admin-wrapper { display: flex; height: 100vh; position: relative; overflow-x: hidden; }
        
        .sidebar { width: 250px; background: #1e272e; color: white; display: flex; flex-direction: column; padding: 1rem; transition: transform 0.3s ease-in-out; z-index: 1000; flex-shrink: 0; }
        .sidebar h2 { text-align: center; margin-bottom: 2rem; font-size: 1.6rem; font-weight: 600; color: #00cec9; }
        .sidebar a { color: #dcdde1; text-decoration: none; margin: 0.4rem 0; padding: 0.75rem 1rem; border-radius: 10px; display: flex; align-items: center; gap: 0.75rem; transition: all 0.3s ease; }
        .sidebar a:hover, .sidebar a.active { background: #00cec9; color: #fff; }
        
        .main-content { flex: 1; padding: 2rem; overflow-y: auto; }
        .topbar { background: #fff; padding: 1rem 2rem; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; }
        .topbar .user-info { display: flex; align-items: center; gap: 0.5rem; font-weight: 500; }
        
        .hamburger-btn { display: none; font-size: 1.8rem; background: none; border: none; cursor: pointer; color: #2f3640; line-height: 1; }
        .overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 999; }

        .user-section { background: white; padding: 2rem; border-radius: 16px; box-shadow: 0 6px 18px rgba(0,0,0,0.04); }
        .user-section h3 { margin-top: 0; font-weight: 600; color: #0984e3; }

        /* Header Section + Buttons */
       .section-header {
    display: flex;
    flex-direction: column; /* tombol di bawah judul */
    align-items: flex-start; /* rata kiri */
    margin-bottom: 1rem;
}
.button-group {
    display: flex;
    gap: 0.5rem;
    margin-top: 0.5rem; /* jarak antara teks & tombol */
}

         .tab-btn, .add-btn {
        padding: 0.6rem 1.2rem;
        border: none;
        border-radius: 50px; /* Biar rounded seperti foto */
        cursor: pointer;
        font-weight: 600;
        font-size: 0.95rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: auto;
        transition: all 0.3s ease;
    }

    .tab-btn {
        background: #00cec9;
        color: #fff;
    }

    .tab-btn.active {
        background: #00b2af;
        color: #fff;
    }

    .tab-btn:hover {
        background: #009b99;
        color: white;
    }

    .add-btn {
        background: #00cec9;
        color: white;
    }

    .add-btn i {
        margin-right: 6px;
        font-size: 1rem;
    }

    .add-btn:hover {
        background: #009b99;
    }
        .tab-btn { background: #dfe6e9; color: #2f3640; }
        .tab-btn.active { background: #00cec9; color: white; }
        .tab-btn:hover { background: #00b2af; color: white; }
        .add-btn { background: #00cec9; color: white; }
        .add-btn:hover { background: #009b99; }

        table { width: 100%; border-collapse: collapse; font-size: 0.95rem; }
        th, td { padding: 0.75rem; text-align: left; border-bottom: 1px solid #eee; }
        th { background-color: #f1f2f6; color: #2f3640; }
        .aksi-buttons { display: flex; gap: 5px; }
        .aksi-buttons button, .aksi-buttons a { padding: 0.4rem 0.8rem; border: none; border-radius: 6px; cursor: pointer; font-size: 0.85rem; }

        .btn-edit { background: #00a8ff; color: white; }
        .btn-edit:hover { background: #0b5ed7; }
        .btn-delete { background: red; color: white; }
        .btn-delete:hover { background: rgba(126, 0, 0, 1); }

        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.4); justify-content: center; align-items: center; z-index: 1000; }
        .modal-content { background: #fff; padding: 2rem; border-radius: 12px; width: 90%; max-width: 500px; }
        .modal-content h4 { margin-top: 0; margin-bottom: 1rem; }
        .modal-content label { display: block; margin-bottom: 0.5rem; }
        .modal-content input, .modal-content select { width: 100%; padding: 0.6rem; margin-bottom: 1rem; border: 1px solid #ccc; border-radius: 6px; }
        .modal-content button { background: #00cec9; border: none; color: #fff; padding: 0.6rem 1rem; border-radius: 8px; cursor: pointer; }

        @media (max-width: 768px) {
            .sidebar { position: fixed; left: 0; top: 0; height: 100%; transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); }
            .hamburger-btn { display: block; }
            .main-content { padding: 1rem; }
            .user-section { padding: 1rem; }
            table { border: 0; }
            table thead { clip: rect(0 0 0 0); height: 1px; position: absolute; width: 1px; }
            table tr { border-bottom: 3px solid #ddd; display: block; margin-bottom: .625em; }
            table td { border-bottom: 1px solid #ddd; display: block; font-size: .8em; text-align: right; }
            table td::before { content: attr(data-label); float: left; font-weight: bold; text-transform: uppercase; }
            table td:last-child { border-bottom: 0; }
            .aksi-buttons { justify-content: flex-end; }
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <aside class="sidebar" id="sidebar">
            <h2>Avachive</h2>
            <a href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="{{ route('produk.index') }}"><i class="bi bi-list-check"></i> Layanan</a>
            <a href="{{ route('dataorder') }}"><i class="bi bi-cart-check"></i> Order</a>
            <a href="{{ route('datauser') }}" class="active"><i class="bi bi-people"></i> Karyawan</a>
            <a href="{{ route('pengaturan') }}"><i class="bi bi-gear"></i> Pengaturan</a>
        </aside>

        <main class="main-content">
            <div class="topbar">
                <button class="hamburger-btn" id="hamburgerBtn"><i class="bi bi-list"></i></button>
                <div> Data Karyawan</div>
                <div class="user-info">
                    <i class="bi bi-person-circle fs-5"></i> {{ Auth::user()->name }}
                </div>
            </div>

            <section class="user-section">
              <div class="section-header">
    <div>
        <h3>Daftar Karyawan</h3>
       <div class="button-group">
    <button class="tab-btn" data-role="kasir">Kasir</button>
    <button class="tab-btn" data-role="driver">Driver</button>
    <button class="add-btn" onclick="openForm()">
        <i class="bi bi-plus-circle"></i> Tambah Karyawan
    </button>
</div>
    </div>
</div>


                <table id="userTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Password Terakhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $key => $user)
                        <tr data-role="{{ $user->usertype }}">
                            <td data-label="No">{{ $key + 1 }}</td>
                            <td data-label="Nama">{{ $user->name }}</td>
                            <td data-label="Role">{{ $user->usertype }}</td>
                            <td data-label="Password Terakhir">{{ $user->plain_password ?? 'Tidak Tersimpan' }}</td>
                            <td data-label="Aksi">
                                <div class="aksi-buttons">
                                    <button class="btn-edit" onclick="openEditForm('{{ $user->id }}','{{ $user->name }}','{{ $user->usertype }}')">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form method="POST" action="{{ route('pengguna.destroy', $user->id) }}" class="delete-form" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center;">Belum ada data karyawan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </section>
        </main>
    </div>
    
    <div class="overlay" id="overlay"></div>

    <div class="modal" id="userModal">
        <div class="modal-content">
            <h4 id="modalTitle">Tambah Karyawan</h4>
            <form id="userForm" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                
                <label>Nama</label>
                <input type="text" name="name" id="name" required>
                
                <label>Password</label>
                <input type="password" name="password" id="password" placeholder="Isi dengan 8 karakter*">
                
                <label>Role</label>
                <select name="usertype" id="usertype" required>
                    <option value="kasir">Kasir</option>
                    <option value="driver">Driver</option>
                </select>
                
                <button type="submit">Simpan</button>
            </form>
        </div>
    </div>

    <script>
        const userModal = document.getElementById('userModal');
        const modalTitle = document.getElementById('modalTitle');
        const userForm = document.getElementById('userForm');
        const formMethod = document.getElementById('formMethod');
        const nameInput = document.getElementById('name');
        const passwordInput = document.getElementById('password');
        const usertypeInput = document.getElementById('usertype');

        let activeRole = localStorage.getItem('activeRole') || 'kasir';

        function openForm() {
            userForm.reset();
            modalTitle.innerText = 'Tambah Karyawan';
            userForm.action = "{{ route('pengguna.store') }}";
            formMethod.value = 'POST';
            passwordInput.setAttribute('required', 'required');
            usertypeInput.value = activeRole;
            userModal.style.display = 'flex';
        }

        function openEditForm(id, name, usertype) {
    userForm.reset();
    modalTitle.innerText = 'Edit Karyawan';
    // Fix: gunakan URL sesuai route resource di dalam prefix /admin
    userForm.action = "{{ url('admin/pengguna') }}/" + id;
    formMethod.value = 'PUT';
    nameInput.value = name;
    usertypeInput.value = usertype;
    passwordInput.removeAttribute('required');
    userModal.style.display = 'flex';
        }

        window.onclick = function(e) {
            if (e.target == userModal) {
                userModal.style.display = 'none';
            }
        };

        @if (session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif

        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Data karyawan ini akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.target.submit();
                    }
                });
            });
        });

        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('active');
            overlay.style.display = sidebar.classList.contains('active') ? 'block' : 'none';
        }
        hamburgerBtn.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);

        // Tab filter logic
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tableRows = document.querySelectorAll('#userTable tbody tr');

        function filterRows(role) {
            let counter = 1;
            tableRows.forEach(row => {
                if (row.dataset.role === role) {
                    row.style.display = '';
                    row.querySelector('td[data-label="No"]').innerText = counter++;
                } else {
                    row.style.display = 'none';
                }
            });
        }

        tabButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                tabButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                activeRole = btn.dataset.role;
                localStorage.setItem('activeRole', activeRole);
                filterRows(activeRole);
            });
        });

        // Restore last active tab
        document.querySelector(`.tab-btn[data-role="${activeRole}"]`)?.classList.add('active');
        filterRows(activeRole);
    </script>
</body>
</html>