@extends('front.includes.front_design')

@section('content')
    <section class="signup">
        <main class="main">
            <div class="container">
                <section class="wrapper">
                    <h4>Register</h4>

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


                    <form action="{{ route('registerUser') }}" method="post" >
                        @csrf
                        <div class="form-example">
                            <div class="form-example mb-3">
                                <label for="name">Full Name <span>*</span> </label>
                                <input type="text" class="name" name="name" id="name" placeholder="Enter Your Full Name" required>
                            </div>
                            <div class="form-example mb-3">
                                <label for="email">Email Address <span>*</span> </label>
                                <input type="email" class="email" name="email" id="email" placeholder="Enter Your Email" required>
                            </div>
                            <div class="form-example mb-3">
                                <label for="pass">Password <span>*</span> </label>
                                <input type="password" class="pass" name="password" id="pass" minlength="8" placeholder="Enter your password" required>
                            </div>
                            <div class="form-example mb-3">
                                <label for="pass">Confirm Password <span>*</span> </label>
                                <input type="password" class="pass" name="confirm_password" id="pass" minlength="8" placeholder="Enter your password" required>
                            </div>
                        </div>
                        <div class="form-example">
                            <input type="submit" class="input-submit" value="REGISTER">
                        </div>
                    </form>
                </section>
            </div>
        </main>
    </section>
@endsection
