<!DOCTYPE html>
<html lang="en">
<head>
    @section('title', 'Đăng Nhập')
    @include("Admin.auth.style")
</head>
<body class="bg-white">
<!-- begin app -->
<div class="app">
    <!-- begin app-wrap -->
    <div class="app-wrap">
        <!-- begin pre-loader -->
        <div class="loader">
            <div class="h-100 d-flex justify-content-center">
                <div class="align-self-center">
                    <img src="assets/img/loader/loader.svg" alt="loader">
                </div>
            </div>
        </div>
        <!-- end pre-loader -->

        <!--start login contant-->
        <div class="app-contant">
            <div class="bg-white">
                <div class="container-fluid p-0">
                    <div class="row no-gutters">
                        <div class="col-sm-6 col-lg-5 col-xxl-3  align-self-center order-2 order-sm-1">
                            <div class="d-flex align-items-center h-100-vh">
                                <div class="login p-50">
                                    <h1 class="mb-2">We Are Mentor</h1>
                                    <p>Welcome back, please login to your account.</p>
                                    <form action="{{ route('admin.plogin') }}" method="POST" class="mt-3 mt-sm-5">
                                        @csrf
                                        @include("Admin.custom.flash-noti")
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="control-label">User Name*</label>
                                                    <input type="text" class="form-control" placeholder="Username" name="username" />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="control-label">Password*</label>
                                                    <input type="password" class="form-control" placeholder="Password" name="password" />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-block d-sm-flex  align-items-center">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="gridCheck">
                                                        <label class="form-check-label" for="gridCheck">
                                                            Remember Me
                                                        </label>
                                                    </div>
                                                    <a href="javascript:void(0);" class="ml-auto">Forgot Password ?</a>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <button type="submit" class="btn btn-primary text-uppercase">Sign In</button>
                                            </div>
                                            <div class="col-12  mt-3">
                                                <p>Don't have an account ?<a href="{{ route('admin.register') }}"> Sign Up</a></p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xxl-9 col-lg-7 bg-gradient o-hidden order-1 order-sm-2">
                            <div class="row align-items-center h-100">
                                <div class="col-7 mx-auto ">
                                    <img class="img-fluid" src="assets/img/bg/login.svg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end login contant-->
    </div>
    <!-- end app-wrap -->
</div>
<!-- end app -->
@include("Admin.auth.script")
</body>


</html>
