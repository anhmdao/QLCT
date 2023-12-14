<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Focus - Quản Lý Chi Tiêu Cá Nhân </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('FE/images/favicon.png') }}">
    <link href="{{ asset('FE/css/style.css') }}" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Đăng ký tài khoản</h4>
                                    <form action="{{ URL::to('/register/home') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label><strong>Username</strong></label>
                                            <input type="text" class="form-control" name="username" hint="Nhập tên người dùng" required="" >
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input type="email" class="form-control" name="email" hint="Nhập email của bạn" required="">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password"  hint="Nhập mật khẩu" required="">
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Đã có tài khoản? <a class="text-primary" href="{{ URL::to('/login') }}">Đăng nhập</a></p>
                                    </div>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('FE/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('FE/js/quixnav-init.js') }}"></script>
    <script src="{{ asset('FE/js/thainn/register.js') }}"></script>
    <!--endRemoveIf(production)-->
</body>

</html>