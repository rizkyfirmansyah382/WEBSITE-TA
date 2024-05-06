@extends('kelompoktani.temp_kelompok.index')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0" style="color: black">Tambah Tanggal Panen</h1>
        </div>
        <a href="/tanggal-panen-kelompok" class="btn btn-primary mb-4">
            <i class="fas fa-arrow-circle-left"></i>
        </a>
        <div class="card w-100" style="background-color: #D9D9D9">
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
            <div class="card-body">
                <form action="/tanggal-panen-kelompok/createData" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Tanggal Panen</label>
                        <input type="date" class="form-control" name="tgl_panen" max="{{ date('Y-m-d') }}">
                    </div>
                    {{-- <div class="mb-3">
                        <label class="form-label">Tanggal Panen</label>
                        <input type="date" class="form-control" name="tgl_panen"
                            min="{{ date('Y-m-d', strtotime('-2 weeks')) }}" max="{{ date('Y-m-d') }}">
                    </div> --}}
                    <div class="mb-3">
                        <label class="form-label">Kelompok</label>
                        <select class="custom-select" name="id_kelompok">
                            <option selected disabled>Pilih Kelompok</option>
                            @foreach ($kelompok as $item)
                                <option value="{{ $item->id_kelompok }}">{{ $item->nama_kelompok }}</option>
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
            const idkelompokSelect = document.querySelector('select[name="id_kelompok"]');
            const tglpanenInput = document.querySelector('input[name="tgl_panen"]');
            const form = document.querySelector('form');

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                // Menggunakan Fetch API untuk memeriksa keunikan tanggal panen pada sisi server
                fetch('/check-data/tgl-panen', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({
                            tgl_panen: tglpanenInput.value,
                            id_kelompok: idkelompokSelect
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
                            showAlert(
                                'Tanggal panen dan nama kelompok sudah tersedia tidak bisa dibuat kembali.'
                            );
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
