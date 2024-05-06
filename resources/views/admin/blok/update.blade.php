@extends('admin.temp_admin.index')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0" style="color: black">Ubah Blok</h1>
        </div>
        <a href="/blok-admin" class="btn btn-primary mb-4">
            <i class="fas fa-arrow-circle-left"></i>
        </a>
        <div class="card w-100" style="background-color: #D9D9D9">
            <div class="card-body">
                <form action="/blok-admin/{{ $blok->id_blok }}}/updateData" method="POST">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nomor Blok</label>
                        <input type="text" class="form-control" placeholder="Isi Nomor Blok" name="blok"
                            value="{{ $blok->blok }}">
                    </div>
                    <button type="submit" value="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
@endsection
