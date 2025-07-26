@extends('layouts.dashboard')
@section('isi')
<div class="container-fluid">
    <div class="row">
        <div class="card col-lg-5">
            <div class="p-4">
                <form method="post" action="{{ url('/request-location/update/'.$lokasi->id) }}">
                    @method('put')
                    @csrf
                        <div class="form-group">
                            <label for="nama_lokasi">Nama Lokasi</label>
                            <input type="text" class="form-control @error('nama_lokasi') is-invalid @enderror" id="nama_lokasi" name="nama_lokasi" autofocus value="{{ old('nama_lokasi', $lokasi->nama_lokasi) }}">
                            @error('nama_lokasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lat_kantor">Latitude Kantor</label>
                            <input type="text" class="form-control @error('lat_kantor') is-invalid @enderror" id="lat_kantor" name="lat_kantor" autofocus value="{{ old('lat_kantor', $lokasi->lat_kantor) }}">
                            @error('lat_kantor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="long_kantor">Longitude Kantor</label>
                            <input type="text" class="form-control @error('long_kantor') is-invalid @enderror" id="long_kantor" name="long_kantor" autofocus value="{{ old('long_kantor', $lokasi->long_kantor) }}">
                            @error('long_kantor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <input type="hidden" name="status" value="pending">
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
                  <br>
            </div>
        </div>
        <div class="col-lg-2">
            <center>
                <h1 style="color: white">Or</h1>
            </center>
        </div>
        <div class="card col-lg-5">
            <div class="p-4">
                <form method="post" action="{{ url('/request-location/update/'.$lokasi->id) }}">
                    @method('put')
                    @csrf
                        <input type="hidden" name="nama_lokasi" value="{{ $lokasi->nama_lokasi }}">
                        <input type="hidden" name="lat_kantor" id="lat">
                        <input type="hidden" name="long_kantor" id="long">
                        <input type="hidden" name="status" value="pending">
                        <br><br><br>
                        <center>
                            <button type="submit" class="btn btn-success"><i class="fa fa-map-marker-alt"></i> Ambil Lokasi Saat Ini</button>
                        </center>
                </form>
            </div>
            <br><br>
        </div>
    </div>
    <center>
        <div class="card col-lg-4">
            <div class="p-4">
                <form method="post" action="{{ url('/request-location/radius/'.$lokasi->id) }}">
                    @method('put')
                    @csrf
                        <div class="form-group">
                            <label for="radius" class="float-left">Radius (Meter)</label>
                            <input type="text" class="form-control @error('radius') is-invalid @enderror" id="radius" name="radius" autofocus value="{{ old('radius', $lokasi->radius) }}">
                            @error('radius')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <input type="hidden" name="status" value="pending">
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                  </form>
                  <br>
            </div>
        </div>
    </center>
</div>
<br>
@endsection