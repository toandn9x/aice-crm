<!-- plugins -->
<script src="assets/js/vendors.js"></script>
<!-- custom app -->
<script src="assets/js/app.js"></script>
@if($errors->any() || session('success') || session('error'))
    <script>
        @foreach($errors->all() as $error)
            toastr["error"]("{{ $error }}")
        @endforeach
        @if(session('success'))
            toastr["success"]("{{ session('success')  }}")
        @endif
        @if(session('error'))
            toastr["success"]("{{  session('error') }}")
        @endif
    </script>
@endif
