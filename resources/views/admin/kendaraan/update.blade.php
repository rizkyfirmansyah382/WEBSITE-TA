@extends('admin.temp_admin.index')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0" style="color: black">Ubah Kendaraan</h1>
        </div>
        <a href="/kendaraan-admin" class="btn btn-primary mb-4">
            <i class="fas fa-arrow-circle-left"></i>
        </a>
        <div class="card w-100" style="background-color: #D9D9D9">
            <div class="card-body">
                <form action="/kendaraan-admin/{{ $kendaraan->id_kendaraan }}/updateData" method="POST">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nomor Polisi</label>
                        <input type="text" class="form-control" placeholder="Isi Nomor Polisi" name="no_polisi"
                            value="{{ $kendaraan->no_polisi }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kendaraan</label>
                        <input type="text" class="form-control" placeholder="Isi Jenis Kendaraan" name="jenis_kendaraan"
                            value="{{ $kendaraan->jenis_kendaraan }}">
                    </div>
                    <button type="submit" value="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
@endsection
