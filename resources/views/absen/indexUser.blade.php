@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="inner-left d-flex justify-content-between align-items-center">
                        <span>Tanggal Jadwal</span>
                    </div>
                    <span>{{ $shift_karyawan->tanggal ?? '-' }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="inner-left d-flex justify-content-between align-items-center">
                        <span>Jadwal</span>
                    </div>
                    <span>{{ $shift_karyawan->Shift->nama_shift ?? '' }} ({{ $shift_karyawan->Shift->jam_masuk ?? '' }} - {{ $shift_karyawan->Shift->jam_keluar ?? '' }})</span>
                </div>
            </div>
        </div>
    </div>
    
    <br>
    <style>
        .jam-digital-malasngoding {
          overflow: hidden;
          float: center;
          width: 100px;
          margin: 2px auto;
          border: 0px solid #efefef;
        }

        .kotak {
          float: left;
          width: 30px;
          height: 30px;
          background-color: #189fff;
        }

        .jam-digital-malasngoding p {
          color: #fff;
          font-size: 16px;
          text-align: center;
          margin-top: 3px;
        }
    </style>

    <div class="jam-digital-malasngoding">
        <div class="kotak">
          <p id="jam"></p>
        </div>
        <div class="kotak">
          <p id="menit"></p>
        </div>
        <div class="kotak">
          <p id="detik"></p>
        </div>
    </div>

    <script>
        window.setTimeout("waktu()", 1000);

        function waktu() {
          var waktu = new Date();
          setTimeout("waktu()", 1000);
          document.getElementById("jam").innerHTML = waktu.getHours();
          document.getElementById("menit").innerHTML = waktu.getMinutes();
          document.getElementById("detik").innerHTML = waktu.getSeconds();
        }
    </script>
    <br>
    
    <div class="d-flex justify-content-center mb-4">
        <form action="{{ url('/my-location') }}" method="get">
            @csrf
            <input type="hidden" name="lat" id="lat2">
            <input type="hidden" name="long" id="long2">
            <input type="hidden" name="userid" value="{{ auth()->user()->id }}">
            <button type="submit" class="btn btn-success">Lihat Lokasi Saya</button>
        </form>
    </div>

    <div class="transfer-content">
        @if (!$shift_karyawan)
            <center>
                <h2>Hubungi Manager Untuk Input Jadwal Anda</h2>
            </center>
        @elseif($shift_karyawan->status_absen == 'Libur')
            <center>
                <h2>Hari Ini Anda Libur</h2>
            </center>
        @elseif($shift_karyawan->status_absen == "Cuti")
            <center>
                <h2>Hari Ini Anda Cuti</h2>
            </center>
        @else
            @if ($shift_karyawan->jam_absen == null)
                <form class="tf-form" action="{{ url('/absen/masuk/'.$shift_karyawan->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="tf-container">
                        <center>
                            <h2>Absen Masuk : </h2>
                            <div class="webcam mb-4" id="results"></div>
                        </center>
                        @if ($shift_karyawan->lock_location == null)
                            <div class="group-input">
                                <label>Keterangan Masuk</label>
                                <textarea name="keterangan_masuk" class="@error('keterangan_masuk') is-invalid @enderror">{{ old('keterangan_masuk') }}</textarea>
                                @error('keterangan_masuk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            @endif
                            <input type="hidden" name="jam_absen">
                            <input type="hidden" name="foto_jam_absen" class="image-tag">
                            <input type="hidden" name="lat_absen" id="lat">
                            <input type="hidden" name="long_absen" id="long">
                            <input type="hidden" name="telat">
                            <input type="hidden" name="jarak_masuk">
                            <input type="hidden" name="status_absen">
                        <button type="submit" class="tf-btn accent large" onClick="take_snapshot()">Save</button>
                    </div>
                </form>
                <br>
                <br>
                <br>
                <br>
                <br>
                <script type="text/javascript" src="{{ url('webcamjs/webcam.min.js') }}"></script>
                <script language="JavaScript">
                Webcam.set({
                    width: 700,
                    height: 700,
                    image_format: 'jpeg',
                    jpeg_quality: 50
                });
                Webcam.attach( '.webcam' );
                </script>
                <script language="JavaScript">
                function take_snapshot() {
                    Webcam.snap( function(data_uri) {
                            $(".image-tag").val(data_uri);
                    document.getElementById('results').innerHTML =
                        '<img src="'+data_uri+'"/>';
                    } );
                }
                </script>
            @elseif($shift_karyawan->jam_pulang == null)
                <form class="tf-form" action="{{ url('/absen/pulang/'.$shift_karyawan->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="tf-container">
                        <center>
                            <h2>Absen Pulang : </h2>
                            <div class="webcam mb-4" id="results"></div>
                        </center>
                        @if ($shift_karyawan->lock_location == null)
                            <div class="group-input">
                                <label>Keterangan Pulang</label>
                                <textarea name="keterangan_pulang" class="@error('keterangan_pulang') is-invalid @enderror">{{ old('keterangan_pulang') }}</textarea>
                                @error('keterangan_pulang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            @endif
                            <input type="hidden" name="jam_pulang">
                            <input type="hidden" name="foto_jam_pulang" class="image-tag">
                            <input type="hidden" name="lat_pulang" id="lat">
                            <input type="hidden" name="long_pulang" id="long">
                            <input type="hidden" name="pulang_cepat">
                            <input type="hidden" name="jarak_pulang">
                        <button type="submit" class="tf-btn accent large" onClick="take_snapshot()">Save</button>
                    </div>
                </form>
                <br>
                <br>
                <br>
                <br>
                <br>
                <script type="text/javascript" src="{{ url('webcamjs/webcam.min.js') }}"></script>
                <script language="JavaScript">
                Webcam.set({
                    width: 700,
                    height: 700,
                    image_format: 'jpeg',
                    jpeg_quality: 50
                });
                Webcam.attach( '.webcam' );
                </script>
                <script language="JavaScript">
                function take_snapshot() {
                    Webcam.snap( function(data_uri) {
                            $(".image-tag").val(data_uri);
                    document.getElementById('results').innerHTML =
                        '<img src="'+data_uri+'"/>';
                    } );
                }
                </script>
            @else
                <center>
                    <h2>Anda Sudah Selesai Absen</h2>
                </center>
            @endif
        @endif
    </div>

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
                $('#lat2').val(position.coords.latitude);
                $('#long').val(position.coords.longitude);
                $('#long2').val(position.coords.longitude);
            }

            setInterval(getLocation, 1000);
        </script>
    @endpush
    
@endsection