@extends('mandor.temp_mandor.index')
@section('content')
    <div class="container-fluid">
        @if (session('showSuccessModal'))
            <script>
                $(document).ready(function() {
                    // Your jQuery-dependent code
                    $('#successModal').modal('show');
                });
            </script>
            <div class="modal" tabindex="-1" id="successModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Berhasil Login Sebagai Mandor</h5>
                        </div>
                        <div class="modal-body">
                            <p>Selamat Anda Berhasil Melakukan Login :v</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="d-sm-flex align-items-center justify-content-between text-light">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="teks-manajemen h3 mb-0" style="color: black">Dashboard</h1>
            </div>
        </div>
        <div class="card w-100" style="overflow: auto; background-color: #D9D9D9">
            <div class="card-body">
                @auth
                    <h1 style="color: #006F1F">Selamat Datang {{ auth()->user()->name }} :v</h1>
                @endauth
            </div>
        </div>
    </div>
@endsection
