@extends('kelompoktani.temp_kelompok.index')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0" style="color: black">Update Anggota</h1>
        </div>
        <a href="/daftar-anggota-baru" class="btn btn-primary btn-sm mb-4">
            <i class="fas fa-arrow-circle-left"></i>
        </a>
        <div class="card w-100 mb-4" style="background-color: #D9D9D9">
            <div class="card-body">
                <form action="/daftar-anggota-baru/{{ $anggota->id_daftar_anggota_baru }}/updateData" method="POST"
                    enctype="multipart/form-data" onsubmit="return validateForm()">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Photo</label>
                        <input type="file" class="form-control" name="photo" accept=".jpeg,.jpg"
                            onchange="validateFile(this, 2)">
                        <small>File harus dalam bentuk Jpeg dan maksimal size 2 MB</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kartu Keluarga</label>
                        <input type="file" class="form-control" name="KkPdf" accept=".pdf"
                            onchange="validateFile(this, 2)">
                        <small>File harus dalam bentuk pdf dan maksimal size 2 MB</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sertifikat Tanah (PDF only)</label>
                        <input type="file" class="form-control" name="SertifPdf" accept=".pdf"
                            onchange="validateFile(this, 2)">
                        <small>File harus dalam bentuk pdf dan maksimal size 2 MB</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Surat Jual Beli (PDF only)</label>
                        <input type="file" class="form-control" name="JBPdf" accept=".pdf"
                            onchange="validateFile(this, 2)">
                        <small>File harus dalam bentuk pdf dan maksimal size 2 MB</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pilih Kelompok</label>
                        <select class="custom-select" name="id_kelompok" id="id_kelompok" onchange="fetchMembers()">
                            <option selected disabled>Pilih Kelompok</option>
                            @foreach ($kelompok as $item)
                                <option value="{{ $item->id_kelompok }}"
                                    {{ $anggota->id_kelompok == $item->id_kelompok ? 'selected' : '' }}>
                                    {{ $item->nama_kelompok }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Anggota Lama</label>
                        <select class="custom-select" name="id_anggota_tervalidasi" id="id_anggota_tervalidasi">
                            <option selected disabled>Pilih Anggota</option>
                            {{-- Options will be dynamically populated with JavaScript --}}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Anggota Baru</label>
                        <input type="text" class="form-control" name="nama_anggota_baru"
                            value="{{ $anggota->nama_anggota_baru }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Induk Keluarga</label>
                        <input type="text" class="form-control" name="nik" value="{{ $anggota->nik }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" max="{{ date('Y-m-d') }}"
                            value="{{ date('Y-m-d', strtotime($anggota->tanggal_lahir)) }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select class="custom-select" name="jenis_kelamin">
                            <option value="Laki-laki" {{ $anggota->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="Perempuan" {{ $anggota->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="{{ $anggota->alamat }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pekerjaan</label>
                        <input type="text" class="form-control" name="pekerjaan" value="{{ $anggota->pekerjaan }}">
                    </div>
                    <button type="submit" value="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            fetchMembers();
        };

        function fetchMembers() {
            var kelompokId = document.getElementById('id_kelompok').value;
            var membersSelect = document.getElementById('id_anggota_tervalidasi');

            // Clear existing options
            while (membersSelect.options.length > 0) {
                membersSelect.remove(0);
            }

            // Fetch members using AJAX (assuming you have a route to get members by kelompok)
            fetch('/daftar-anggota-baru/getMembers/' + kelompokId)
                .then(response => response.json())
                .then(data => {
                    // Populate members dropdown with fetched data
                    data.forEach(member => {
                        var option = document.createElement('option');
                        option.value = member.id_anggota_tervalidasi;
                        option.text = member.nama_anggota;
                        membersSelect.add(option);
                    });
                })
                .catch(error => console.error('Error fetching members:', error));
        }


        function validateFile(input, maxSizeMB) {
            var file = input.files[0];
            if (file) {
                var maxSizeBytes = maxSizeMB * 1024 * 1024; // Konversi MB ke byte
                if (file.size > maxSizeBytes) {
                    showAlert('Ukuran file melebihi batas yang diizinkan ' + maxSizeMB + ' MB');
                    input.value = ''; // Hapus input file
                    return false;
                }
            }
            return true;
        }

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

        function validateForm() {
            // Anda dapat menambahkan logika validasi formulir tambahan di sini jika diperlukan
            return true;
        }
    </script>
@endsection
