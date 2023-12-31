
@extends('layout.layout')

@section('content')



    @include('inc/_header')
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">My Account</li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container">
            <div class="mb-4">
                <h1 class="text-center">My Account</h1>
            </div>
            <div class="my-4 my-xl-8">
                <div class="row">
                    <div class="col-md-5 ml-xl-auto mr-md-auto mr-xl-0 mb-8 mb-md-0">
                        <!-- Title -->
                        <div class="border-bottom border-color-1 mb-6">
                            <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Login</h3>
                        </div>
                        <p class="text-gray-90 mb-4">Welcome back! Sign in to your account.</p>
                        <!-- End Title -->
                        <form class="js-validate" method="POST" action="{{route('login.post')}}" novalidate="novalidate">
                            @csrf
                            <!-- Form Group -->
                            <div class="js-form-message form-group">
                                <label class="form-label" for="signinSrEmailExample3">Username or Email address
                                        <span class="text-danger">*</span>
                                    </label>
                                <input type="email" class="form-control" name="email" id="signinSrEmailExample3" placeholder="Username or Email address" aria-label="Username or Email address" required data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">
                            </div>
                            <!-- End Form Group -->

                            <!-- Form Group -->
                            <div class="js-form-message form-group">
                                <label class="form-label" for="signinSrPasswordExample2">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" id="signinSrPasswordExample2" placeholder="Password" aria-label="Password" required data-msg="Your password is invalid. Please try again." data-error-class="u-has-error" data-success-class="u-has-success">
                            </div>
                            <!-- End Form Group -->

                            <!-- Checkbox -->
                            <div class="js-form-message mb-3">
                                <div class="custom-control custom-checkbox d-flex align-items-center">
                                    <input type="checkbox" class="custom-control-input" id="rememberCheckbox" name="rememberCheckbox" required data-error-class="u-has-error" data-success-class="u-has-success">
                                    <label class="custom-control-label form-label" for="rememberCheckbox">
                                            Remember me
                                        </label>
                                </div>
                            </div>
                            <!-- End Checkbox -->
                            @error('message')
                            <p  style="color: red; margin-bottom: 0px"> {{$message}}</p>
                         @enderror
                            <!-- Button -->
                            <div class="mb-1">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary-dark-w px-5">Login</button>
                                </div>
                                <div class="mb-2">
                                    <a class="text-blue" href="#">Lost your password?</a>
                                </div>
                            </div>
                            <!-- End Button -->
                        </form>
                    </div>
                    <div class="col-md-1 d-none d-md-block">
                        <div class="flex-content-center h-100">
                            <div class="width-1 bg-1 h-100"></div>
                            <div class="width-50 height-50 border border-color-1 rounded-circle flex-content-center font-italic bg-white position-absolute">or</div>
                        </div>
                    </div>
                    <div class="col-md-5 ml-md-auto ml-xl-0 mr-xl-auto">
                        <!-- Title -->
                        <div class="border-bottom border-color-1 mb-6">
                            <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Register</h3>
                        </div>
                        <header class="text-center mb-7">
                            <h2 class="h4 mb-0">Welcome to Electro.</h2>
                            <p>Fill out the form to get started.</p>
                        </header>
                        <!-- End Title -->
                        <!-- Form Group -->
                        <form method="POST" action="{{route('register.post')}}" class="js-validate">
                            @csrf

                        <!-- End Title -->

                        <!-- Form Group -->
                        <div class="form-group">
                            <div class="js-form-message js-focus-state">
                                <label class="sr-only" for="signupName">Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="signupEmailLabel">
                                                <span class="fas fa-user"></span>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="name" id="signupName" placeholder="Username" aria-label="Name" aria-describedby="signupEmailLabel" required data-msg="Please enter a valid user name." data-error-class="u-has-error" data-success-class="u-has-success">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="js-form-message js-focus-state">
                                <label class="sr-only" for="signupEmail">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="signupEmailLabel">
                                                <span class="fas fa-user"></span>
                                        </span>
                                    </div>
                                    <input type="email" class="form-control" name="email" id="signupEmail" placeholder="Email" aria-label="Email" aria-describedby="signupEmailLabel" required data-msg="Please enter a valid email address." data-error-class="u-has-error" data-success-class="u-has-success">

                                </div>
                                @error('email')
                               <p  style="color: red; margin-bottom: 0px"> {{$message}}</p>
                            @enderror
                            </div>
                        </div>
                        <!-- End Input -->

                        <!-- Form Group -->
                        <div class="form-group">
                            <div class="js-form-message js-focus-state">
                                <label class="sr-only" for="signupPassword">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="signupPasswordLabel">
                                                <span class="fas fa-lock"></span>
                                        </span>
                                    </div>
                                    <input type="password" class="form-control" name="password" id="signupPassword" placeholder="Password" aria-label="Password" aria-describedby="signupPasswordLabel" required data-msg="Your password is invalid. Please try again." data-error-class="u-has-error"
                                        data-success-class="u-has-success">
                                </div>
                                @error('password')
                                <p  style="color: red; margin-bottom: 0px"> {{$message}}</p>
                             @enderror
                            </div>
                        </div>
                        <!-- End Input -->

                        <!-- Form Group -->
                        <div class="form-group">
                            <div class="js-form-message js-focus-state">
                                <label class="sr-only" for="signupConfirmPassword">Confirm Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="signupConfirmPasswordLabel">
                                            <span class="fas fa-key"></span>
                                        </span>
                                    </div>
                                    <input type="password" class="form-control" name="confirmPassword" id="signupConfirmPassword" placeholder="Confirm Password" aria-label="Confirm Password" aria-describedby="signupConfirmPasswordLabel" required data-msg="Password does not match the confirm password."
                                        data-error-class="u-has-error" data-success-class="u-has-success">
                                </div>
                            </div>
                        </div>
                        <!-- End Input -->

                        <div class="mb-2">
                            <button type="submit" class="btn btn-block btn-sm btn-primary transition-3d-hover">Get Started</button>
                        </div>

                        <div class="text-center mb-4">
                            <span class="small text-muted">Already have an account?</span>
                            <a class="js-animation-link small text-dark" href="javascript:;" data-target="#login" data-link-group="idForm" data-animation-in="slideInUp">Login
                                </a>
                        </div>

                        <div class="text-center">
                            <span class="u-divider u-divider--xs u-divider--text mb-4">OR</span>
                        </div>

                        <!-- Login Buttons -->
                        <div class="d-flex  " style="margin-bottom: 2rem">
                            <a class="btn btn-block btn-sm btn-soft-facebook transition-3d-hover mr-1" href="#">
                                    <span class="fab fa-facebook-square mr-1"></span>
                                    Facebook
                                </a>
                            <a class="btn btn-block btn-sm btn-soft-google transition-3d-hover ml-1 mt-0" href="#">
                                    <span class="fab fa-google mr-1"></span>
                                    Google
                                </a>
                        </div>
                        <!-- End Login Buttons -->
                    </form>
                        <h3 class="font-size-18 mb-3">Sign up today and you will be able to :</h3>
                        <ul class="list-group list-group-borderless">
                            <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i> Speed your way through checkout</li>
                            <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i> Track your orders easily</li>
                            <li class="list-group-item px-0"><i class="fas fa-check mr-2 text-green font-size-16"></i> Keep a record of all your purchases</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->



    @endsection
