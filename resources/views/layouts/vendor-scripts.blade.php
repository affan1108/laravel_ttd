<script src="{{ URL::asset('my-scripts-bottom-bundle.js') }}"></script>
<script src="{{ URL::asset('my-scripts-content-bundle.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Cegah SweetAlert muncul saat back-forward cache aktif
        if (performance.getEntriesByType("navigation")[0]?.type === "back_forward") {
            return;
        }

        const successMessage = @json(session('success'));
        const errorMessage = @json(session('error'));

        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: successMessage,
                showConfirmButton: false,
                timer: 2000
            });
        }

        if (errorMessage) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: errorMessage,
                showConfirmButton: true
            });
        }
    });
</script>
@yield('script')
@yield('script-bottom')
