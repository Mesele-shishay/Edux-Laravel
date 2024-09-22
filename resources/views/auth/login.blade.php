<x-app-layout>
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-10 col-md-6 col-sm-9 col-12">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <div class="p-5 h-100 d-flex align-items-center">
                                   <div class="text-light w-100 text-center">
                                    <h6 class="small">Nice to see u again</h6>
                                    <h2 class="text-uppercase">Welcome Back</h2>
                                    <p class="p-5">Sign in to continue to your account</p>
                                   </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login Account</h1>
                                    </div>
                                    <x-form class="user">
                                        {{-- Email input --}}
                                        <x-form-input id="email" name="email" type="email"
                                                    class="form-control-user"
                                                    placeholder="Enter Email Address..."
                                                    required />
                                        {{-- Password input --}}
                                        <x-form-input id="password" name="password" type="password"
                                                    class="form-control-user"
                                                    placeholder="Password"
                                                    required />

                                        {{-- Remember me button Note: will be change to cpmponent --}}

                                        <x-form-check  id="rememberMe" name="rememberMe" label="Remember Me"/>

                                        {{-- Form submit button --}}
                                        <div class="d-grid">
                                            <x-form-submit name="submit" class="btn-user btn-block">Login</x-form-submit>
                                        </div>
                                    </x-form>
                                    <hr>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

