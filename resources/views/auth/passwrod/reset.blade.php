<app-layout>
    <div class="container mb-5">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image">
                                <div class="p-5 h-100 d-flex align-items-center">
                                   <div class="text-light w-100 text-center">
                                    <h2 class="text-uppercase">Forgot Your Password?</h2>
                                    <p class="pt-5">
                                        We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!
                                        </p>
                                   </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <p class="text-muted">Enter the email address registered on your account</p>
                                    </div>
                                    <form class="user" method="get" action="{{ route('forget') }}">
                                        {{ csrf() }}
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        </div>
                                        <input  type="submit" class="btn btn-primary btn-user btn-block" value="Reset Password">

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small lead text-reset" href="{{ route('login') }}">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

</app-layout>