@extends('templates.app')
@section('container')
    
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <form method="post" class="tf-form" action="{{ url('/my-profile/edit-password-proses/'.auth()->user()->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="group-input">
                        <label>Nama</label>
                        <input type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name', auth()->user()->name) }}" readonly />
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="group-input">
                        <label for="password" class="float-left">Password</label>
                        <input type="password" class="@error('password') is-invalid @enderror" id="password" name="password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="group-input">
                        <label for="password_confirmation" class="float-left">Password Confirmation</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="tf-btn accent large">Save</button>
                </form>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
@endsection