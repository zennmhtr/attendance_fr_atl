@extends('templates.login')
@section('container')
    <form class="tf-form" action="{{ url('/login-proses') }}" method="POST">
        @csrf
        <h1>{{ $title }}</h1>
        <div class="group-input">
            <label>Username</label>
            <input type="text" placeholder="Username" class="@error('username') is-invalid @enderror" value="{{ old('username') }}" name="username">
            @error('username')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
        </div>
        <div class="group-input auth-pass-input last">
            <label>Password</label>
            <input type="password" class="password-input @error('password') is-invalid @enderror" placeholder="Password" name="password">
            <a class="icon-eye password-addon" id="password-addon"></a>
            @error('password')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
        </div>
        
        <div class="group-input mt-4">
            <div class="icheck-primary">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember" class="mt-2">
                    Remember Me
                </label>
            </div>
        </div>

        <button type="submit" class="tf-btn accent large">Login</button>
    </form>
    <p class="mb-9 fw-3 text-center ">Don't have an Account? <a href="{{ url('/register') }}" class="auth-link-rg" >Sign up</a></p>
    <div class="auth-line"><b>Face Recognition</b></div>
    <ul class="bottom socials-login mb-4">
        <li><a href="{{ url('/presensi') }}">Absen Masuk</a></li>
        <li><a href="{{ url('/presensi-pulang') }}">Absen Pulang</a></li>
    </ul>
@endsection
