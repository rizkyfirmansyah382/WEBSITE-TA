@extends('admin.temp_admin.index')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0" style="color: black">Form Ubah User</h1>
        </div>
        <a href="/user-admin" class="btn btn-primary mb-4">
            <i class="fas fa-arrow-circle-left"></i>
        </a>
        <div class="card w-100" style="background-color: #D9D9D9">
            <div class="card-body">
                @if (session('error'))
                    <div id="success-alert" class="alert alert-success" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="/user-admin/{{ $user->id }}/updateData" method="POST">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" placeholder="Isi Nama Pengguna" name="name"
                            value="{{ $user->name }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" placeholder="Isi Username Pengguna" name="username"
                            value="{{ $user->username }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="text" class="form-control" placeholder="Isi Password Pengguna" name="password"
                            value="{{ $user->password }}">
                        <span class="text-danger">Passworrd Wajib Diganti</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role Pengguna</label>
                        <select class="custom-select" name="role">
                            <option selected disabled>Pilih Role Pengguna</option>
                            @foreach ($role as $item)
                                <option value="{{ $item->id_role_admin }}"
                                    {{ $user->id_role_admin == $item->id_role_admin ? 'selected' : '' }}>
                                    {{ $item->role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" value="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
@endsection
