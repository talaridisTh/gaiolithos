
{{session($msg)}}
@if (session($msg))
    <script>
            Swal.fire({
                toast: 'true',
                position: 'top-end',
                icon: {{$icon}},
                title: "{{ session($msg) }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            })
    </script>
@endif
