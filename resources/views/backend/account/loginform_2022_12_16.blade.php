@extends('backend.layouts.fullempty')
@section('title', 'Admin Login')
@section('content')
    {{-- <main class=""> --}}
        <body>

    <section class="login-section">
        <div class="container">
            <div class="login-form">
                <div class="flex">
                <div class="img-div text-center">
                    <img src="{{ asset('public/backend-assets/images/logo/podar-logo.png') }}"
                        class="img-fluid text-center" />
                </div>
                <div class="content" style="padding:50px">
                    <div class="col p-30">
                    <h1 class="form-heading text-center">Marketing Expense  Manager</h1>
                    <h3 class="credentials">
                        Enter your Credentials to access your account
                    </h3>
                    <form method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf
                        <div class="form-group">
                            {!! Form::select('year', $years, NULL, ['class'=>'form-control', 'placeholder'=>'Select Marketing Year', 'required'=>'true']) !!}
                        </div>
                        <div class="form-group">
                            <i class="fa-solid fa-user"></i>
                            <input type="email" name="email" class="form-control" placeholder="Enter Username" />
                        </div>
                        <div class="form-group">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password" />
                        </div>
                        <div class="text-center">
                            <input type="submit" class="btn sign-in-btn btn-lg" value="Sign In">
                        </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>
</body>

@endsection
