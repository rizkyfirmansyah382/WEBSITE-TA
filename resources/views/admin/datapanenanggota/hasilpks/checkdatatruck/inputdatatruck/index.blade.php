@extends('admin.temp_admin.index')
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between text-light">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                <h1 class="teks-manajemen h3 mb-0" style="color: black">Input Hasil PKS</h1>
            </div>
        </div>
        <div class="d-flex justify-content-between mb-4">
            <a href="/check-data-truck/{{ $id_tanggal_panen }}" class="btn btn-primary">
                <i class="fas fa-arrow-circle-left"></i>
            </a>
            <a href="/input-hasil-pks/{{ $id_data_spb }}/{{ $id_tanggal_panen }}/update" class="btn btn-sm btn-primary">Ubah
                Data</a>
        </div>

        <div class="card w-100" style="overflow: auto; background-color: #D9D9D9">
            <div class="card-body">
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

                @if (session('error'))
                    <div id="error-alert" class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <table class="table table-sm table-borderless" style="background-color: white; border-radius: 10px">
                    <thead>
                        <tr>
                            <th>Bruto</th>
                            <th>Tarra</th>
                            <th>Netto Terima</th>
                            <th>Sortasi</th>
                            <th>Netto Bersih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inputhasilpks as $item)
                            <tr>
                                <td>{{ number_format($item->bruto) }}</td>
                                <td>{{ number_format($item->tarra) }}</td>
                                <td>{{ number_format($item->netto_terima) }}</td>
                                <td>{{ number_format($item->sortasi) }}</td>
                                <td>{{ number_format($item->netto_bersih) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
