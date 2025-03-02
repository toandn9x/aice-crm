<!DOCTYPE html>
<html lang="en">


<head>
    @include("Admin.auth.style");
</head>

<body>
<!-- begin app -->
<div class="app">
    <!-- begin app-wrap -->
    <div class="app-wrap">
        @include("Admin.menu.topmenu")
        <div class="app-container">
            @include("Admin.menu.leftmenu")
            <!-- begin app-main -->
            <div class="app-main" id="main">
                <!-- begin container-fluid -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- end container-fluid -->
            </div>
            <!-- end app-main -->
        </div>
        <!-- end app-container -->
        <!-- begin footer -->
        @include("Admin.layout.footer")
        <!-- end footer -->
    </div>
    <!-- end app-wrap -->
</div>
<!-- end app -->

<!-- plugins -->
@include('Admin.auth.script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
{{-- data table --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
{{-- end data table --}}

{{-- Sweetalert2 --}}
<script src="assets/js/sweetalert2.js"></script>
<script src="assets/js/confirmSubmit.js"></script>
{{-- Sweetalert2 --}}

@yield('script')
</body>


</html>
