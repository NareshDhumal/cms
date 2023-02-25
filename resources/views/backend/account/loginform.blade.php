@extends('backend.layouts.login')
@section('title', 'Admin Login')
@section('login')

{{-- <style>
    input,
input::placeholder {
    font: 13px sans-serif;
    padding-left: 30px !important;
    color: #ced4da;
}
</style> --}}
    {{-- <main class=""> --}}

<body>
    {{-- <section class="login-section">
        <div class="container">
            <div class="login-form">
                <div class="flex">
                <div class="img-div text-center">
                </div>
                <div class="content" style="padding:50px">
                    <div class="col p-30">
                    <h1 class="form-heading text-center">Propery Listing</h1>
                    <h3 class="credentials">
                        Enter your Credentials to access your account
                    </h3>
                    <form method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf

                        <div class="form-group">
                            <i class="fa-solid fa-user"></i>
                            <input type="email" name="email" class="form-control" placeholder="Enter Username" />
                        </div>
                        <div class="form-group">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password" />
                        </div>
                        <a class="forgot-pass" href="{{ url('/frgtpassword') }}">Forgot Password</a>
                        <div class="text-center">
                            <input type="submit" class="btn sign-in-btn btn-lg" value="Sign In">
                        </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section> --}}

    <section class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        {{-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> --}}
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>PL</h3>
                            </a>
                            <h3>Sign In</h3>
                        </div>
                        <form method="POST" action="{{ route('admin.login.submit') }}">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                <a href="{{ url('/frgtpassword') }}">Forgot Password</a>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4" value="Sign In">Sign In</button>
                            <p class="text-center mb-0">Don't have an Account? <a href="">Sign Up</a></p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </section>
</body>

@endsection
