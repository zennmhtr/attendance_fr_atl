@extends('templates.login')
@section('container')
    <form class="tf-form" action="{{ url('/register-proses') }}" method="POST">
        @csrf
        <h1>{{ $title }}</h1>
        <div class="group-input">
            <label>Full Name</label>
            <input type="text" placeholder="Full Name" class="@error('name') is-invalid @enderror" value="{{ old('name') }}" name="name">
            @error('name')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
        </div>
        <div class="group-input">
            <label>Username</label>
            <input type="text" placeholder="Username" class="@error('username') is-invalid @enderror" value="{{ old('username') }}" name="username">
            @error('username')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
        </div>
        <div class="group-input mt-4">
            <label>Email</label>
            <input type="email" placeholder="Example@mail.com" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" name="email">
            @error('email')
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
        <div class="group-input auth-pass-input last mt-4">
            <label>Re-type Password</label>
            <input type="password" class="password-input @error('password_confirmation') is-invalid @enderror" placeholder="Re-type Password" name="password_confirmation">
            <a class="icon-eye password-addon" id="password-addon"></a>
            @error('password_confirmation')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
        </div>

        <div class="group-input mt-4">
            <label>Jabatan</label>
            <select name="jabatan_id" id="jabatan_id">
              <option value="">- - Pilih - -</option>
              @foreach ($data_jabatan as $dj)
                @if(old('jabatan_id') == $dj->id)
                  <option value="{{ $dj->id }}" selected>{{ $dj->nama_jabatan }}</option>
                @else
                  <option value="{{ $dj->id }}">{{ $dj->nama_jabatan }}</option>
                @endif
              @endforeach
            </select>
            @error('jabatan_id')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
        </div>

        <div class="group-input mt-4">
            <label>Lokasi</label>
            <select name="lokasi_id" id="lokasi_id">
              <option value="">- - Pilih - -</option>
              @foreach ($data_lokasi as $dl)
                @if(old('lokasi_id') == $dl->id)
                  <option value="{{ $dl->id }}" selected>{{ $dl->nama_lokasi }}</option>
                @else
                  <option value="{{ $dl->id }}">{{ $dl->nama_lokasi }}</option>
                @endif
              @endforeach
            </select>
            @error('lokasi_id')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
        </div>
        

        <button type="submit" class="tf-btn accent large">Register</button>
    </form>
    <p class="mb-9 fw-3 text-center ">Already have an Account? <a href="{{ url('/') }}" class="auth-link-rg" >Log In</a></p>
    
@endsection
