@if (session('status'))
    <script type="text/javascript">
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: "success",
            title: '{{ session('status') }}',
            showConfirmButton: false,
            timer: 4000,
        })
    </script>
@endif

@if (session('error'))
    <script type="text/javascript">
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: "error",
            title: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 4000,
        })
    </script>
@endif

@if ($errors->any())
    <script type="text/javascript">
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: "error",
            title: '{{ $errors->first() }}',
            showConfirmButton: false,
            timer: 4000,
        })
    </script>
@endif
