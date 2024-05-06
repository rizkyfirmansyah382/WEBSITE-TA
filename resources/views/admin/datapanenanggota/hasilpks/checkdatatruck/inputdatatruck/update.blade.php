@extends('admin.temp_admin.index')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h1 class="h3 mb-0" style="color: black">Input Hasil PKS</h1>
        </div>
        <a href="/input-hasil-pks/{{ $id_data_spb }}/{{ $id_tanggal_panen }}" class="btn btn-primary mb-4">
            <i class="fas fa-arrow-circle-left"></i>
        </a>
        <div class="card w-100 mb-4" style="background-color: #D9D9D9">
            <div class="card-body">
                <form action="/input-hasil-pks/{{ $id_data_spb }}/{{ $id_tanggal_panen }}/updateData" method="POST">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Isi Bruto</label>
                        <input type="text" class="form-control" placeholder="Isi Bruto" name="bruto" id="brutoInput"
                            value="{{ $inputhasilpks->bruto }}">
                        <small class="text-danger" id="brutoError"></small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Isi Tarra</label>
                        <input type="text" class="form-control" placeholder="Isi Tarra" name="tarra" id="tarraInput"
                            value="{{ $inputhasilpks->tarra }}">
                        <small class="text-danger" id="tarraError"></small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Isi Netto Terima</label>
                        <input type="text" class="form-control" placeholder="Isi Netto Terima" name="netto_terima"
                            id="nettoTerimaInput" value="{{ $inputhasilpks->netto_terima }}">
                        <small class="text-danger" id="nettoTerimaError"></small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Isi Sortasi</label>
                        <input type="text" class="form-control" placeholder="Isi Sortasi" name="sortasi"
                            id="sortasiInput" value="{{ $inputhasilpks->sortasi }}">
                        <small class="text-danger" id="sortasiError"></small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Isi Netto Bersih</label>
                        <input type="text" class="form-control" placeholder="Isi Netto Bersih" name="netto_bersih"
                            id="nettoBersihInput" value="{{ $inputhasilpks->netto_bersih }}">
                        <small class="text-danger" id="nettoBersihError"></small>
                    </div>
                    <button type="submit" value="submit" class="btn btn-primary">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function setInputError(inputId, errorId, errorMessage) {
            var inputElement = document.getElementById(inputId);
            var errorElement = document.getElementById(errorId);

            if (!/^\d+$/.test(inputElement.value)) {
                errorElement.textContent = errorMessage;
            } else {
                errorElement.textContent = '';
            }
        }

        document.getElementById('brutoInput').addEventListener('input', function() {
            setInputError('brutoInput', 'brutoError', 'Bruto harus berupa angka.');
        });

        document.getElementById('tarraInput').addEventListener('input', function() {
            setInputError('tarraInput', 'tarraError', 'Tarra harus berupa angka.');
        });

        document.getElementById('nettoTerimaInput').addEventListener('input', function() {
            setInputError('nettoTerimaInput', 'nettoTerimaError', 'Netto Terima harus berupa angka.');
        });

        document.getElementById('sortasiInput').addEventListener('input', function() {
            setInputError('sortasiInput', 'sortasiError', 'Sortasi harus berupa angka.');
        });

        document.getElementById('nettoBersihInput').addEventListener('input', function() {
            setInputError('nettoBersihInput', 'nettoBersihError', 'Netto Bersih harus berupa angka.');
        });
    </script>
@endsection
