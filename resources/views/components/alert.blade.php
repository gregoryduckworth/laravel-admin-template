<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    toastr.options = {
        progressBar: true,
        closeButton: true,
    };
</script>

@if (session()->has('success'))
    <script>
        toastr.success('{{ session()->get('success') }}');
    </script>
@endif

@if (session()->has('warning'))
    <script>
        toastr.warning('{{ session()->get('warning') }}');
    </script>
@endif

@if (session()->has('info'))
    <script>
        toastr.info('{{ session()->get('info') }}');
    </script>
@endif

@if (session()->has('error'))
    <script>
        toastr.error('{{ session()->get('error') }}');
    </script>
@endif
