@extends('templates.dashboard')
@section('isi')
    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 p-0 d-flex mt-2">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="col-md-6 p-0">                    
                        <a href="{{ url('/pegawai') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <form method="post" action="{{ url('/pegawai/edit-password-proses/'.$karyawan->id) }}" class="p-4">
                    @method('put')
                    @csrf
                        <div class="form-group">
                            <label for="name" class="float-start">Nama</label>
                            <input type="text" class="form-control" value="{{ $karyawan->name }}" disabled id="name">
                        </div>
                        <div class="form-group">
                            <label for="password" class="float-start">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    <button type="submit" class="btn btn-primary float-start">Submit</button>
                  </form>
            </div>
        </div>
    </div>
@endsection
