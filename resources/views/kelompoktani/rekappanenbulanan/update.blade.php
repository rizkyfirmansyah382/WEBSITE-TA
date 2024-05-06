@extends('kelompoktani.temp_kelompok.index')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0" style="color: black">Ubah Data Panen Anggota</h1>
        </div>
        <a href="/rekap-bulanan/checkData/{{ $id_tanggal_panen }}/{{ $id_tanggal_panen_revisi }}"
            class="btn btn-primary btn-sm mb-4">
            <i class="fas fa-arrow-circle-left"></i>
        </a>
        <div class="card w-100" style="background-color: #D9D9D9">
            <div class="card-body">
                <form
                    action="/rekap-bulanan/checkData/updateData/{{ $tonase->id_data_panen_kelompok }}/{{ $id_tanggal_panen }}/{{ $id_tanggal_panen_revisi }}"
                    method="POST">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Tonase Panen</label>
                        <input type="text" class="form-control" name="tonase_anggota" id="tonaseInput"
                            value="{{ $tonase->tonase_anggota }}">
                        <small id="tonaseError" class="text-danger"></small>
                    </div>
                    <button type="submit" value="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('tonaseInput').addEventListener('input', function() {
            var tonaseInput = this.value;
            var tonaseError = document.getElementById('tonaseError');

            if (!/^\d+$/.test(tonaseInput) || parseInt(tonaseInput, 10) <= 0) {
                tonaseError.textContent = 'Tonase harus berupa angka positif.';
            } else {
                tonaseError.textContent = '';
            }
        });
    </script>
@endsection
