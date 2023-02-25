@extends('backend.layouts.fullempty')
{{-- @section('content') --}}

<style>
/* input, input::placeholder {
    font: 13px sans-serif;
    padding-left: 6px !important;
    color: #ced4da;
} */

    .pass-field:focus{
    border: 1.5px solid rgb(9, 131, 231) !important;
    box-shadow: 0px 0px 0px 2px rgba(9, 131, 231, 0.459) !important;

}
.pass-field{
    border-radius: 6px !important;
}

.logo-img img{
    height: 150px;
}

    .submit-btn{
    background: #0059aa;
    border: 2px solid #0059aa;
    color: rgb(255, 255, 255);
    padding: 10px;
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.5s ease-in;
}

.submit-btn:hover{
    background: transparent;
    border: 2px solid #0059aa;
    color: black;
}
</style>
    <section class="container top-padding login-page common-space">
        <div class="login-box">
            <div class="row">
                <div class="col-md-12">
                    <div class="container container-custom">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="border-login">
                                    <div class="login-inner-head text-center">
                                        <div class="logo-img text-center mb-2">
                                            <img src="{{ asset('public/backend-assets/images/logo/podar-logo.png') }}" class="img-fluid" alt="">
                                        </div>
                                        <h2 class="font-weight-bold text-dark">Reset Your Password?</h2>
                                        <h6>Authentication is necessary in order to change password</h6>
                                    </div>
                                    <div class="using-box py-2">

                                        <div class="row ">
                                            <div class="col-md-12 col-sm-12 col-12">
                                                <div class="login">

                                                    <form class="login-form form-field"
                                                        action="{{ route('changeforgotpassword.store') }}" method="post">
                                                        {{ csrf_field() }}

                                                        <div class="form-group col-md-12">
                                                            <div class="input-wrapper">
                                                         <input type="hidden" name="id" value="{{$user[0]['admin_user_id']}}">
                                                         <label for="user">Password</label>
                                                                <input class="password form-control pass-field mb-2"
                                                                    id="password" name="password" type="password" placeholder="Password" required>

                                                                    <label for="user">Confirm Password</label>
                                                                <input class="password form-control pass-field mb-2"
                                                                    id="password_conformation" name="password_conformation" placeholder="Confirm Password"
                                                                     type="password" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12 mb-0 terms-conditions-size1">
                                                            <button type="submit" value="reset-password"
                                                                class="submit-btn btn-block  text-center ">Submit</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- login end-->
{{-- @endsection --}}
