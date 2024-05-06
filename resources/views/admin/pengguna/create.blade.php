@extends('admin.temp_admin.index')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0" style="color: black">Form Tambah User</h1>
        </div>
        <a href="/user-admin" class="btn btn-primary mb-4">
            <i class="fas fa-arrow-circle-left"></i>
        </a>
        <div class="card w-100" style="background-color: #D9D9D9">
            <div class="card-body">
                <form action="/user-admin/createData" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" placeholder="Isi Nama Pengguna" name="name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" placeholder="Isi Username Pengguna" name="username">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="text" class="form-control" placeholder="Isi Password Pengguna" name="password">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role Pengguna</label>
                        <select class="custom-select" name="role">
                            <option selected disabled>Pilih Role Pengguna</option>
                            @foreach ($role as $item)
                                <option value="{{ $item->id_role_admin }}">{{ $item->role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" value="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log(
                'DOM Content Loaded'); // Tambahkan ini untuk memeriksa apakah event DOMContentLoaded dijalankan

            const usernameInput = document.querySelector('input[name="username"]');
            const form = document.querySelector('form');

            form.addEventListener('submit', function(event) {
                event.preventDefault();
                // Menggunakan Fetch API untuk memeriksa keunikan username pada sisi server
                fetch('/user-admin/checkUsername', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },

                        body: JSON.stringify({
                            username: usernameInput.value
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.isUnique) {
                            // Jika username unik, lanjutkan pengiriman formulir
                            form.submit();
                        } else {
                            // Jika username sudah ada, beri peringatan
                            alert('Username sudah digunakan. Pilih username lain.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
@endsection
