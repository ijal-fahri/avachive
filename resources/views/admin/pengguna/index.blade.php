<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Data Pengguna - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f4f7fc;
            color: #333;
        }

        .admin-wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            width: 250px;
            background: #1e272e;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 1rem;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1.6rem;
            font-weight: 600;
            color: #00cec9;
        }

        .sidebar a {
            color: #dcdde1;
            text-decoration: none;
            margin: 0.4rem 0;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s ease;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #00cec9;
            color: #fff;
        }

        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        .topbar {
            background: #fff;
            padding: 1rem 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar .user-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }

        .user-section {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.04);
        }

        .user-section h3 {
            margin-top: 0;
            font-weight: 600;
            color: #0984e3;
        }

        .add-btn {
            margin-bottom: 1rem;
            background: #00cec9;
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }

        th,
        td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f1f2f6;
            color: #2f3640;
        }

        tr:hover {
            background-color: #f9fbff;
        }

        .aksi-buttons button {
            margin-right: 5px;
            padding: 0.4rem 0.8rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.85rem;
        }

        .btn-detail {
            background: #0984e3;
            color: white;
        }

        .btn-edit {
            background: #f1c40f;
            color: white;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: #fff;
            padding: 2rem;
            border-radius: 12px;
            min-width: 300px;
            max-width: 90%;
        }

        .modal-content h4 {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        .modal-content label {
            display: block;
            margin-bottom: 0.5rem;
        }

        .modal-content input,
        .modal-content select {
            width: 100%;
            padding: 0.6rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .modal-content button {
            background: #00cec9;
            border: none;
            color: #fff;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            cursor: pointer;
        }

        /* Fade in */
        .fade-in {
            opacity: 0;
            animation: fadeIn 0.6s ease forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .admin-wrapper {
                flex-direction: column;
            }

            .sidebar {
                flex-direction: row;
                overflow-x: auto;
                width: 100%;
                padding: 0.5rem;
            }

            .sidebar a {
                flex: 1;
                justify-content: center;
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>Avachive</h2>
            <a href="admin/dashboard"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="{{ route('produk.index') }}"><i class="bi bi-list-check"></i> Layanan</a>
            <a href="{{ route('dataorder') }}"><i class="bi bi-cart-check"></i> Order</a>
            <a href="{{ route('datauser') }}" class="active"><i class="bi bi-people"></i> Karyawan</a>
            <a href="{{ route('pengaturan') }}"><i class="bi bi-gear"></i> Pengaturan</a>
        </aside>

        <!-- Main Content -->
        <main class="main-content fade-in">
      <div class="topbar fade-in">
        <div>Karyawan</div>
        <div class="user-info">
          <i class="bi bi-person-circle fs-5"></i> {{ Auth::user()->name }}
        </div>
      </div>

            <section class="user-section fade-in">
                <h3>Daftar Karyawan</h3>

                @if (session('success'))
                    <div
                        style="background:#dff9fb; padding:10px; border-radius:8px; margin-bottom:15px; color:#0984e3;">
                        {{ session('success') }}
                    </div>
                @endif

                <button class="add-btn" onclick="openForm()">Tambah Karyawan</button>

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Password</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->usertype }}</td>
                                <td>{{ $user->plain_password }}</td>
                                <td class="aksi-buttons">
                                    <button class="btn-edit"
                                        onclick="openEditForm('{{ $user->id }}','{{ $user->name }}','{{ $user->usertype }}')">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form method="POST" action="{{ route('pengguna.destroy', $user->id) }}"
                                        style="display:inline;" onsubmit="return confirm('Yakin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            style="background:red; color:white; border:none; padding:4px 8px; border-radius:5px;">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <!-- Modal Tambah -->
    <!-- Modal Tambah/Edit -->
    <div class="modal" id="userModal">
        <div class="modal-content fade-in">
            <h4 id="modalTitle">Tambah Karyawan</h4>
            <form id="userForm" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" name="id" id="editId">
                <label>Nama</label>
                <input type="text" name="name" id="name" required>
                <label>Password</label>
                <input type="password" name="password" id="password"> <label>Role</label>
                <select name="usertype" id="usertype" required>
                    <option value="kasir">Kasir</option>
                    <option value="driver">Driver</option>
                </select>
                <button type="submit">Simpan</button>
            </form>
        </div>
    </div>

    <script>
        function openForm() {
            document.getElementById('userModal').style.display = 'flex';
            document.getElementById('modalTitle').innerText = 'Tambah Karyawan';
            document.getElementById('userForm').action = "{{ route('pengguna.store') }}";
            document.getElementById('formMethod').value = 'POST';

            // Kosongkan form
            document.getElementById('name').value = '';
            document.getElementById('password').value = '';
            document.getElementById('usertype').value = 'kasir';
        }

        function openEditForm(id, name, usertype) {
            document.getElementById('userModal').style.display = 'flex';
            document.getElementById('modalTitle').innerText = 'Edit Karyawan';
            document.getElementById('userForm').action = '/pengguna/' + id;
            document.getElementById('formMethod').value = 'PUT';

            document.getElementById('name').value = name;
            document.getElementById('password').value = ''; // kosongkan
            document.getElementById('usertype').value = usertype;
        }

        window.onclick = function(e) {
            if (e.target.id === 'userModal') {
                document.getElementById('userModal').style.display = 'none';
            }
        };
    </script>

</body>

</html>
