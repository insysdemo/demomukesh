<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ trans('app.Role | Log in') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('public/admin-fev.png') }}">
</head>

<body class="hold-transition login-page">
    <div class="flex justify-content-end">
        <div class="position-fixed m-2 " id="alerts"
            style="right: 0;top: 0; z-index: 99999; border-radius: 10px;  box-shadow: 3px 3px 6px #0000009e; ">
        </div>
    </div>
    <div class="login-box " style="width: 380px">
        <div class="login-logo">
            <a href="#"><b>{{ trans('app.Role Permission') }}</b></a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <form action="{{ route('login') }}" autocomplete="off" method="post" autocomplete="off"
                    redirect="{{ url('admin/' . app()->getLocale() . '/dashboard') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="password">{{ trans('app.Email Or Phone') }}</label>
                        <input type="text" class="form-control" name="email"
                            placeholder="{{ trans('app.Email Or Phone') }}" autocomplete="off" id="email">
                    </div>
                    <div class="mb-3" style="position: relative;">
                        <label for="password">{{ trans('app.Password') }}</label>
                        <input type="password" name="password" class="form-control" id="password"
                            autocomplete="new-password" placeholder="{{ trans('app.Enter Password') }}">
                        <span class="eye-icon" id="togglePassword"
                            style="position: absolute; right: 10px; top: 75%; transform: translateY(-50%);">
                            <i class="fa fa-eye" id="eyeIcon"></i>
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    {{ trans('app.Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="icheck-primary">
                                {{-- <a href="{{ route('admin.forget-password') }}" class="dropdown-item" style="color: #0d6efd;">Forget Password</a> --}}
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit"
                                class="btn btn-primary btn-block">{{ trans('app.Sign In') }}</button>
                        </div>

                    </div>
                </form>
            </div>
            {{-- <div class="col-4">
                <a class="nav-link" data-widget="fullscreen" href="{{ route('admin.register') }}" role="button">
                    register
                </a>
            </div> --}}
        </div>
    </div>
    <script src="{{ asset('public/dist/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('public/assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/admin/common.js') }}"></script>
    <script src="{{ asset('public/admin/formsubmit.js') }}"></script>
    <script src="{{ asset('public/dist/js/adminlte.min.js') }}"></script>

</body>

</html>

<script>
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    const togglePasswordButton = document.getElementById('togglePassword');

    togglePasswordButton.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    });
</script>
