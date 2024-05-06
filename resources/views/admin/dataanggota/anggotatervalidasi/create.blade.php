@extends('admin.temp_admin.index')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0" style="color: black">Tambah Anggota Tervalidasi</h1>
        </div>
        <a href="/anggota-tervalidasi" class="btn btn-primary mb-4">
            <i class="fas fa-arrow-circle-left"></i>
        </a>
        <div class="card w-100 mb-4" style="background-color: #D9D9D9;">
            <div class="card-body">
                <form action="/anggota-tervalidasi/createData" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Photo</label>
                        <input type="file" class="form-control" name="photo" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Anggota</label>
                        <input type="text" class="form-control" placeholder="Isi Nama Anggota" name="nama_anggota">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Induk Keluarga</label>
                        <input type="text" class="form-control" placeholder="Isi Nomor Induk Keluarga" name="nik">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tgl Lahir</label>
                        <input type="date" class="form-control" name="tgl_lahir" max="{{ date('Y-m-d') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select class="custom-select" name="jenis_kelamin">
                            <option selected disabled>Pilih Jenis Kelamin</option>

                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Tinggal</label>
                        <input type="text" class="form-control" placeholder="Isi Alamat Tinggal" name="alamat_tinggal">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" placeholder="Isi Pekerjaan" name="pekerjaan">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Anggota</label>
                        <input type="text" class="form-control" placeholder="Isi Nomor Anggota" name="no_anggota">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date" class="form-control" name="tgl_masuk_anggota" max="{{ date('Y-m-d') }}">
                    </div>
                    {{-- <div class="mb-3">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date" class="form-control" name="tgl_masuk_anggota"
                            min="{{ date('Y-m-d', strtotime('-2 weeks')) }}" max="{{ date('Y-m-d') }}">
                    </div> --}}
                    <div class="mb-3">
                        <label class="form-label">Luas Lahan</label>
                        <input type="text" placeholder="Isi Luas Lahan" class="form-control" name="luas_lahan"
                            id="luasLahanInput">
                        <small id="luasLahanError" class="text-danger"></small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kelompok</label>
                        <select class="custom-select" name="id_kelompok">
                            <option selected disabled>Pilih Kelompok</option>
                            @foreach ($kelompok as $item)
                                <option value="{{ $item->id_kelompok }}">{{ $item->nama_kelompok }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kelompok</label>
                        <select class="custom-select" name="id_blok">
                            <option selected disabled>Pilih Blok</option>
                            @foreach ($blok as $item)
                                <option value="{{ $item->id_blok }}">{{ $item->blok }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" value="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('luasLahanInput').addEventListener('input', function() {
            var luasLahanInput = this.value;
            var luasLahanError = document.getElementById('luasLahanError');

            // Allow positive integers and numbers with commas
            if (!/^\d+(,\d{1,3})*$/.test(luasLahanInput)) {
                luasLahanError.textContent = 'Luas lahan harus berupa angka atau angka dengan koma.';
            } else {
                luasLahanError.textContent = '';
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Content Loaded');

            const no_anggotaInput = document.querySelector('input[name="no_anggota"]');
            const form = document.querySelector('form');

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                // Menggunakan Fetch API untuk memeriksa keunikan username pada sisi server
                fetch('/anggota-tervalidasi/checkNoanggota', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({
                            no_anggota: no_anggotaInput.value
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.isUnique) {
                            // Jika nomor anggota unik, lanjutkan pengiriman formulir
                            form.submit();
                        } else {
                            // Jika nomor anggota sudah ada, beri peringatan
                            alert('Nomor anggota sudah digunakan. Pilih nomor anggota lain.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
@endsection
