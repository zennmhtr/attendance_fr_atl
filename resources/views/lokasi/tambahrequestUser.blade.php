@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <center>
                    <h2>MANUAL</h2>
                </center>
                <br>
                <br>
                <form method="post" class="tf-form" action="{{ url('/request-location/tambah-proses') }}">
                    @csrf
                        <div class="group-input">
                            <label for="nama_lokasi">Nama Lokasi</label>
                            <input type="text" class="@error('nama_lokasi') is-invalid @enderror" id="nama_lokasi" name="nama_lokasi" autofocus value="{{ old('nama_lokasi') }}">
                            @error('nama_lokasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="group-input">
                            <label for="lat_kantor">Latitude Kantor</label>
                            <input type="text" class="@error('lat_kantor') is-invalid @enderror" id="lat_kantor" name="lat_kantor" autofocus value="{{ old('lat_kantor') }}">
                            @error('lat_kantor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="group-input">
                            <label for="long_kantor">Longitude Kantor</label>
                            <input type="text" class="@error('long_kantor') is-invalid @enderror" id="long_kantor" name="long_kantor" autofocus value="{{ old('long_kantor') }}">
                            @error('long_kantor')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="group-input">
                            <label for="radius">Radius (Meter)</label>
                            <input type="text" class="@error('radius') is-invalid @enderror" id="radius" name="radius" autofocus value="{{ old('radius') }}">
                            @error('radius')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <input type="hidden" name="status" value="pending">
                        <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
   <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <center>
                    <h2>OTOMATIS</h2>
                </center>
                <br>
                <br>
                <form method="post" class="tf-form" action="{{ url('/request-location/tambah-proses') }}">
                    @csrf
                        <input type="hidden" name="lat_kantor" id="lat">
                        <input type="hidden" name="long_kantor" id="long">
                        <div class="group-input">
                            <label for="nama_lokasi">Nama Lokasi</label>
                            <input type="text" class="@error('nama_lokasi') is-invalid @enderror" id="nama_lokasi" name="nama_lokasi" autofocus value="{{ old('nama_lokasi') }}">
                        </div>
                        <div class="group-input">
                            <label for="radius">Radius (Meter)</label>
                            <input type="text" class="@error('radius') is-invalid @enderror" id="radius" name="radius" autofocus value="{{ old('radius') }}">
                        </div>
                        <input type="hidden" name="status" value="pending">
                        <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">
                        <button type="submit" class="btn btn-success float-left"><i class="fa fa-map-marker-alt"></i> Ambil Lokasi Saat Ini</button>
                </form>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    @push('script')
        <script>
            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else {
                    x.innerHTML = "Geolocation is not supported by this browser.";
                }
            }
            function showPosition(position) {
                $('#lat').val(position.coords.latitude);
                $('#long').val(position.coords.longitude);
            }

            setInterval(getLocation, 1000);
        </script>
    @endpush
@endsection