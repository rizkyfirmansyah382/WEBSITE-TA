@extends('admin.temp_admin.index')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between text-light">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="teks-manajemen h3 mb-0" style="color: black">Data Role</h1>
            </div>
            <a href="/role-admin/create" class="btn btn-primary btn-sm mb-4">Tambah Data</a>
        </div>

        <div class="card w-100 mb-4" style="overflow: auto; background-color: #D9D9D9">
            <div class="card-body mt-3">
                @if (session('success'))
                    <div id="success-alert" class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div id="error-alert" class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <table class="table table-sm table-borderless" style="background-color: white; border-radius: 10px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($role as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->role }}</td>
                                <td>
                                    <a href="/role-admin/{{ $item->id_role_admin }}/update"
                                        class="btn btn-warning my-1 btn-sm">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="/role-admin/{{ $item->id_role_admin }}/delete"
                                        class="btn btn-danger my-1 btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
