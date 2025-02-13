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
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>
@yield('script')
</body>


</html>
