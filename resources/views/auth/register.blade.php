
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Register | {{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/app.min.css')}}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{asset('css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="dark-style" />

</head>

<body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card">


                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto">
                            <h4 class="mt-0">Free Sign Up</h4>
                            <p class="text-muted mb-4">Don't have an account? Create your account, it takes less than a minute</p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{route('registering')}}" method="post">
                            @csrf
                            @auth
                                <div class="form-group">
                                    <label>Avatar</label>
                                    <img src="{{auth()->user()->avatar}}" class="img-thumbnail avatar-lg rounded-circle">
                                </div>
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input class="form-control" type="text" disabled value="{{auth()->user()->name}}">
                                </div>
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input class="form-control" type="email" disabled value="{{auth()->user()->email}}">
                                </div>
                            @endauth

                            @guest
                                    <div class="form-group">
                                        <label for="fullname">Full Name</label>
                                        <input class="form-control" type="text" id="fullname" placeholder="Enter your name" required="" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="emailaddress">Email address</label>
                                        <input class="form-control" type="email" id="emailaddress" required="" placeholder="Enter your email" value="" name="email">
                                    </div>@endguest

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control" type="password" required="" id="password" placeholder="Enter your password" name="password">
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="applicant" name="role" class="custom-control-input" value="1" checked>
                                    <label class="custom-control-label" for="customRadio3">Applicant</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="hr" name="role" class="custom-control-input" value="2">
                                    <label class="custom-control-label" for="customRadio3">HR</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-signup">
                                    <label class="custom-control-label" for="checkbox-signup">I accept
                                        <a href="javascript: void(0);" class="text-muted">Terms and Conditions</a>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit"><i class="mdi mdi-account-circle"></i> Sign Up </button>
                            </div>
                        </form>
                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-muted">Already have account? <a href="{{route('login')}}" class="text-muted ml-1"><b>Log In</b></a></p>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<footer class="footer footer-alt">
    2022
    @if(date('Y') != 2022)
        - {{date('Y')}}
    @endif
    © {{config('app.name')}}
</footer>

<!-- bundle -->
<script src="{{asset('js/vendor.min.js')}}"></script>
<script src="{{asset('js/app.min.js')}}"></script>

</body>
</html>
