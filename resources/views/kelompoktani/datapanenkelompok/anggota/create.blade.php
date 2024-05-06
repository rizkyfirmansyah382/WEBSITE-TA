@extends('kelompoktani.temp_kelompok.index')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0" style="color: black">Tambah Data Panen Anggota</h1>
        </div>
        <a href="/data-panen-kelompok/{{ $id_tanggal_panen }}" class="btn btn-primary btn-sm mb-4">
            <i class="fas fa-arrow-circle-left"></i>
        </a>
        <div class="card w-100" style="background-color: #D9D9D9">
            <div class="card-body">
                <form action="/data-panen-kelompok/createData/{{ $id_tanggal_panen }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Anggota</label>
                        <select class="custom-select" name="id_anggota_tervalidasi">
                            <option selected disabled>Pilih Anggota</option>
                            @foreach ($nama_anggota as $item)
                                <option value="{{ $item->id_anggota_tervalidasi }}">{{ $item->nama_anggota }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tonase Panen</label>
                        <input type="text" class="form-control" name="tonase_panen" id="tonaseInput">
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

            if (!/^\d+$/.test(tonaseInput)) {
                tonaseError.textContent = 'Tonase harus berupa angka.';
            } else {
                tonaseError.textContent = '';
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const idAnggotaSelect = document.querySelector('select[name="id_anggota_tervalidasi"]');

            const form = document.querySelector('form');

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                // Menggunakan Fetch API untuk memeriksa keunikan tanggal panen pada sisi server
                fetch('/check-data/data-panen-create/{{ $id_tanggal_panen }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({

                            id_anggota_tervalidasi: idAnggotaSelect
                                .value, // Menggunakan value dari elemen select
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.isUnique) {
                            // Jika tanggal panen unik, lanjutkan pengiriman formulir
                            form.submit();
                        } else {
                            // Jika tanggal panen sudah ada, beri peringatan
                            showAlert('Data anggota sudah tersedia.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });

            function showAlert(message) {
                const alertContainer = document.createElement('div');
                alertContainer.classList.add('alert', 'alert-danger', 'mt-3');
                alertContainer.textContent = message;

                document.querySelector('.card-body').prepend(alertContainer);

                // Automatically remove the alert after 5 seconds (5000 milliseconds)
                setTimeout(() => {
                    alertContainer.remove();
                }, 5000);
            }

        });
    </script>
@endsection
