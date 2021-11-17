@extends('front.includes.front_design')

@section('content')
    <section class="login">
        <main class="main">
            <div class="container">
                <section class="wrapper">
                    <div class="heading">
                        <h4>Sign In</h4>
                        <p class="text text-normal">New user? <span><a href="{{ route('userRegister') }}" class="text text-links">Create an account</a></span>
                        </p>
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

                    @if(Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('success_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(Session::has('error_message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('error_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif


                    <form action="{{ route('login_user') }}" method="post" >
                        @csrf
                        <div class="form-example">
                            <div class="form-example mb-3">
                                <label for="email">Email Address <span>*</span> </label>
                                <input type="email" class="email" name="email" id="email" placeholder="Enter Your Email" required>
                            </div>
                            <div class="form-example mb-3">
                                <label for="pass">Password <span>*</span> </label>
                                <input type="password" class="pass" name="password" id="pass" minlength="8" placeholder="Enter your password" required>
                            </div>
                        </div>

                        <div class="form-example">
                            <input type="submit" class="input-submit" value="LOGIN!">
                        </div>
                    </form>
                   <!--  <div class="striped">
                        <span class="striped-line"></span>
                        <span class="striped-text">Or</span>
                        <span class="striped-line"></span>
                    </div>
                    <div class="method">
                        <div class="method-control">
                            <a href="#" class="method-action">
                                <i class="fab fa-google gg"></i>
                                <span class="gg-right">Sign in with Google</span>
                            </a>
                        </div>
                        <div class="method-control">
                            <a href="#" class="method-action">
                                <i class="fab fa-facebook-f fb"></i>
                                <span class="fb-right"></i>Sign in with Facebook</span>
                            </a>
                        </div>
                    </div> -->
                </section>
            </div>
        </main>
    </section>
@endsection
