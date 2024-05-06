@extends('mandor.temp_mandor.index')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0" style="color: black">Ubah Data Surat Perintah Bongkar</h1>
        </div>
        <a href="/data-spb/{{ $id_tanggal_panen }}" class="btn btn-primary mb-4">
            <i class="fas fa-arrow-circle-left"></i>
        </a>
        <div class="card w-100 mb-4" style="background-color: #D9D9D9">
            <div class="card-body">
                <form action="/data-spb/{{ $dataSpb->id_tanggal_panen }}/{{ $dataSpb->id_data_spb }}/updateData"
                    method="POST">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Blok</label>
                        <select class="custom-select" name="id_blok">
                            <option selected disabled>Pilih Blok</option>
                            @foreach ($blok as $item)
                                <option value="{{ $item->id_blok }}"
                                    {{ $dataSpb->id_blok == $item->id_blok ? 'selected' : '' }}>{{ $item->blok }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sopir</label>
                        <select class="custom-select" name="id_sopir">
                            <option selected disabled>Pilih Sopir</option>
                            @foreach ($sopir as $item)
                                <option value="{{ $item->id_sopir }}"
                                    {{ $dataSpb->id_sopir == $item->id_sopir ? 'selected' : '' }}>{{ $item->nama_sopir }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kendaraan</label>
                        <select class="custom-select" name="id_kendaraan">
                            <option selected disabled>Pilih Kendaraan</option>
                            @foreach ($kendaraan as $item)
                                <option value="{{ $item->id_kendaraan }}"
                                    {{ $dataSpb->id_kendaraan == $item->id_kendaraan ? 'selected' : '' }}>
                                    {{ $item->no_polisi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Surat Perintah Bongkar</label>
                        <input type="text" class="form-control" name="no_spb" value="{{ $dataSpb->no_spb }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Total Janjang</label>
                        <input type="text" class="form-control" name="total_janjang" id="total_janjang"
                            value="{{ $dataSpb->total_janjang }}">
                        <small id="total_janjangError" class="text-danger"></small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tujuan PKS</label>
                        <input type="text" class="form-control" name="tujuan_pks" value="{{ $dataSpb->tujuan_pks }}">
                    </div>
                    <button type="submit" value="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('total_janjang').addEventListener('input', function() {
            var total_janjang = this.value;
            var total_janjangError = document.getElementById('total_janjangError');

            if (!/^\d+$/.test(total_janjang)) {
                total_janjangError.textContent = 'Total janjang harus berupa angka.';
            } else {
                total_janjangError.textContent = '';
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Content Loaded');

            const no_spbInput = document.querySelector('input[name="no_spb"]');
            const form = document.querySelector('form');

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                // Menggunakan Fetch API untuk memeriksa keunikan username pada sisi server
                fetch('/data-spb/checkNospb/{{ $id_tanggal_panen }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        },
                        body: JSON.stringify({
                            no_spb: no_spbInput.value,
                            userId: {{ $dataSpb->id_data_spb }},
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.isUnique) {
                            // Jika nomor anggota unik, lanjutkan pengiriman formulir
                            form.submit();
                        } else {
                            // Jika nomor anggota sudah ada, tampilkan alert
                            showAlert(
                                'Nomor surat perintah bongkar sudah digunakan. Silahkan ganti nomor surat perintah bongkar.'
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
