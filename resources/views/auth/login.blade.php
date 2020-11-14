@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}</div>
    @endif

    <div class="preloader">
        <img src="{{asset('panel/assets/images/preloader.gif')}}" alt="">
    </div>

    <div class="wrapper without_header_sidebar">
        <div class="login_page center_container">
            <div class="center_content">
                <div class="logo">
                    <img src="{{asset('panel/assets/images/logo.png')}}" alt="" class="img-fluid">
                </div>

                <form method="POST" class="d-block" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group icon_parent">
                        <label for="password">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Email Address *">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <span class="icon_soon_bottom_right"><i class="fas fa-envelope"></i></span>

                    </div>
                    <div class="form-group icon_parent">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name=" password" required autocomplete="current-password" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <span class="icon_soon_bottom_right"><i class="fas fa-unlock"></i></span>
                    </div>
                    <div class="form-group">
                        <label class="chech_container">Remember me
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group">
                        <a class="registration" href="{{route('register')}} ">Create new account</a><br>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-white">I forgot my password</a>
                        @endif
                        <button type="submit" class="btn btn-blue">Login</button>
                    </div>
                </form>
                <div class="footer">
                    <p>Copyright &copy; 2020 <a href="https://s-abasnezhad.ir/">siyamak</a>. All rights reserved.</p>
                </div>

            </div>
        </div>
    </div>

    @endsection
    