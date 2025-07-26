@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                    <form method="post" class="tf-form p-2" action="{{ url('/kunjungan/update/'.$kunjungan->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="group-input">
                            <label for="pegawai">Nama Pegawai</label>
                            <input type="text" class="@error('pegawai') is-invalid @enderror" id="pegawai" name="pegawai" value="{{ old('pegawai', $kunjungan->user->name ?? '') }}" readonly>
                            <input type="hidden" name="user_id" id="user_id" value="{{ $kunjungan->user->id ?? '' }}">
                        </div>

                        <div class="group-input">
                            <label for="tanggal">Tanggal</label>
                            <input type="datetime" class="@error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $kunjungan->tanggal) }}">
                            @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="visit_in" class="float-left">Visit In</label>
                            <input type="text" class="clockpicker @error('visit_in') is-invalid @enderror" id="visit_in" name="visit_in" value="{{ old('visit_in', $kunjungan->visit_in) }}">
                            @error('visit_in')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="visit_out" class="float-left">Visit Out</label>
                            <input type="text" class="clockpicker @error('visit_out') is-invalid @enderror" id="visit_out" name="visit_out" value="{{ old('visit_out', $kunjungan->visit_out) }}">
                            @error('visit_out')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="lat" class="float-left">Latitude</label>
                            <input type="text" class="@error('lat') is-invalid @enderror" id="lat" name="lat" value="{{ old('lat') }}" readonly>
                            @error('lat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="long" class="float-left">Longitude</label>
                            <input type="text" class="@error('long') is-invalid @enderror" id="long" name="long" value="{{ old('long') }}" readonly>
                            @error('long')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto" name="foto">
                            @error('foto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="group-input">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="@error('keterangan') is-invalid @enderror" cols="30" rows="10">{{ old('keterangan', $kunjungan->keterangan) }}</textarea>
                            @error('keterangan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </form>
            </div>
        </div>
    </div>
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

            $(document).ready(function(){
                $('.clockpicker').clockpicker({
                    donetext: 'Done'
                });

                $('body').on('keyup', '.clockpicker', function (event) {
                    var val = $(this).val();
                    val = val.replace(/[^0-9:]/g, '');
                    val = val.replace(/:+/g, ':');
                    $(this).val(val);
                });
            });
        </script>
    @endpush
@endsection
