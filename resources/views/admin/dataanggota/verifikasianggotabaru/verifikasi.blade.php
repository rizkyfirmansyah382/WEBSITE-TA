@extends('admin.temp_admin.index')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0" style="color: black">Verifikasi Anggota Baru</h1>
        </div>
        <a href="/verifikasi-anggota-baru" class="btn btn-primary mb-4">
            <i class="fas fa-arrow-circle-left"></i>
        </a>
        <div class="card w-100 mb-4" style="background-color: #D9D9D9;">
            <div class="card-body">
                <form
                    action="/verifikasi-anggota-baru/{{ $id_anggota_tervalidasi }}/{{ $id_daftar_anggota_baru }}/verifikasiData"
                    method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Tanggal Keluar & Masuk</label>
                        <input type="date" class="form-control" name="tanggalkeluarmasuk" max="{{ date('Y-m-d') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Anggota</label>
                        <input type="text" class="form-control" placeholder="Isi Nomor Anggota Baru" name="no_anggota">
                    </div>

                    <button type="submit" value="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Content Loaded');

            const no_anggotaInput = document.querySelector('input[name="no_anggota"]');
            const form = document.querySelector('form');

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                // Menggunakan Fetch API untuk memeriksa keunikan nomor anggota pada sisi server
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
