@extends('admin.temp_admin.index')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        List Polygons
                        <a href="/data-pemetaan/{{ $id_anggota_tervalidasi }}/create"
                            class="btn btn-info btn-sm float-end">Add new polygon</a>
                    </div>
                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <table class="table" id="dataPolygons">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Coordinates</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemetaan as $item)
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $item->coordinates }}</td>
                                        <td>
                                            <a href="/data-pemetaan/{{ $item->id_anggota_tervalidasi }}/update"
                                                class="btn btn-warning my-1 btn-sm">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a href="/data-pemetaan/{{ $item->id_anggota_tervalidasi }}/delete"
                                                class="btn btn-danger my-1 btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <form action="" method="POST" id="deleteForm">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Hapus" style="display:none">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(function() {
            var idAnggotaTervalidasi = "{{ $id_anggota_tervalidasi }}";

            $('#datapolygon').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                ajax: '{{ route('polygon.DataPemetaan', ['id_anggota_tervalidasi']) }}',
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    }, {
                        data: 'cordinate'
                    },
                    {
                        data: 'action'
                    }
                ]
            })
        })
    </script>

    <script>
        $(document).ready(function() {
            // Mendapatkan nama route saat ini
            var currentRoute = "{{ \Request::route()->getName() }}";

            // Memeriksa apakah route saat ini adalah 'polygons.index'
            if (currentRoute === 'polygons.index') {
                // Menambahkan kelas 'active' pada elemen navigasi
                $('#polygonsNav').addClass('active');
            }
        });
    </script> --}}
@endsection
