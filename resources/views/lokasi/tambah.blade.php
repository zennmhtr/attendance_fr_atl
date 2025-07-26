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
                        <a href="{{ url('/lokasi-kantor') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="p-4">
                    <center>
                        <h2>MANUAL</h2>
                    </center>
                    <br>
                    <form method="post" action="{{ url('/lokasi-kantor/tambah-proses') }}">
                        @csrf
                            <div class="form-group">
                                <label for="nama_lokasi">Nama Lokasi</label>
                                <input type="text" class="form-control @error('nama_lokasi') is-invalid @enderror" id="nama_lokasi" name="nama_lokasi" autofocus value="{{ old('nama_lokasi') }}">
                                @error('nama_lokasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="lat_kantor">Latitude Kantor</label>
                                <input type="text" class="form-control @error('lat_kantor') is-invalid @enderror" id="lat_kantor" name="lat_kantor" autofocus value="{{ old('lat_kantor') }}">
                                @error('lat_kantor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="long_kantor">Longitude Kantor</label>
                                <input type="text" class="form-control @error('long_kantor') is-invalid @enderror" id="long_kantor" name="long_kantor" autofocus value="{{ old('long_kantor') }}">
                                @error('long_kantor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="radius">Radius (Meter)</label>
                                <input type="text" class="form-control @error('radius') is-invalid @enderror" id="radius" name="radius" autofocus value="{{ old('radius') }}">
                                @error('radius')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <input type="hidden" name="status" value="approved">
                            <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <center>
                <h1 style="color: white">Or</h1>
            </center>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="p-4">
                    <center>
                        <h2>OTOMATIS</h2>
                    </center>
                    <br>
                    <form method="post" action="{{ url('/lokasi-kantor/tambah-proses') }}">
                        @csrf
                            <input type="hidden" name="lat_kantor" id="lat">
                            <input type="hidden" name="long_kantor" id="long">
                            <div class="form-group">
                                <label for="nama_lokasi">Nama Lokasi</label>
                                <input type="text" class="form-control @error('nama_lokasi') is-invalid @enderror" id="nama_lokasi" name="nama_lokasi" autofocus value="{{ old('nama_lokasi') }}">
                            </div>
                            <div class="form-group">
                                <label for="radius">Radius (Meter)</label>
                                <input type="text" class="form-control @error('radius') is-invalid @enderror" id="radius" name="radius" autofocus value="{{ old('radius') }}">
                            </div>
                            <input type="hidden" name="status" value="approved">
                            <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">
                            <button type="submit" class="btn btn-success float-left"><i class="fa fa-map-marker-alt me-2"></i> Ambil Lokasi Saat Ini</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection