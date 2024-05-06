<!-- Bootstrap core JavaScript-->
<script src="{{ asset('asset_admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('asset_admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('asset_admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('asset_admin/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('asset_admin/vendor/chart.js/Chart.min.js') }}"></script>

<script>
    // Sembunyikan pesan sukses setelah 3 detik (3000 milidetik)
    setTimeout(function() {
        document.getElementById('success-alert').style.display = 'none';
    }, 3000);
</script>
