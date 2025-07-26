@extends('templates.dashboard')
@section('isi')
    @if($shift_karyawan)
        <?php $skid = $shift_karyawan->id ?>
        <?php $sktanggal = $shift_karyawan->tanggal ?>
        <?php $sknamas = $shift_karyawan->Shift->nama_shift  ?>
        <?php $skjamas = $shift_karyawan->Shift->jam_masuk ?>
        <?php $skjamkel = $shift_karyawan->Shift->jam_keluar ?>
        <?php $skjamab = $shift_karyawan->jam_absen ?>
        <?php $skjampul = $shift_karyawan->jam_pulang ?>
        <?php $skstatus = $shift_karyawan->status_absen ?>
        <?php $lock_location = $shift_karyawan->lock_location ?>
    @else
        <?php $skid = "-" ?>
        <?php $sktanggal = "-" ?>
        <?php $sknamas = "-"  ?>
        <?php $skjamas = "-" ?>
        <?php $skjamkel = "-" ?>
        <?php $skjamab = "-" ?>
        <?php $skjampul = "-" ?>
        <?php $skstatus = "-" ?>
        <?php $lock_location = null ?>
    @endif
    <div class="container-fluid">
        <center>
            <p class="p mb-2 text-gray-800">Tanggal Shift : {{ $sktanggal }}</p>
            <p class="p mb-2 text-gray-800">Shift : {{ $sknamas}} ({{ $skjamas }} - {{  $skjamkel }})</p>
        </center>

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

        <div class="d-flex justify-content-center">
            <form action="{{ url('/my-location') }}" method="get">
                @csrf
                <input type="hidden" name="lat" id="lat2">
                <input type="hidden" name="long" id="long2">
                <input type="hidden" name="userid" value="{{ auth()->user()->id }}">
                <button type="submit" class="btn btn-success">Lihat Lokasi Saya</button>
            </form>
        </div>

        @if(!$shift_karyawan)
        <br>
        <div class="col-lg-12">
            <div class="card">
                <div class="p-4">
                    <center>
                        <h2>Hubungi Manager Untuk Input Jadwal Anda</h2>
                    </center>
                </div>
            </div>
        </div>
        @elseif($skstatus == "Libur")
        <br>
        <div class="col-lg-12">
            <div class="card">
                <div class="p-4">
                    <center>
                        <h2>Hari Ini Anda Libur</h2>
                    </center>
                </div>
            </div>
        </div>
        @elseif($skstatus == "Cuti")
        <br>
        <div class="col-lg-12">
            <div class="card">
                <div class="p-4">
                    <center>
                        <h2>Hari Ini Anda Cuti</h2>
                    </center>
                </div>
            </div>
        </div>
        @else
            @if($skjamab == null)
                <br>
                <div class="col-lg-12">
                    <div class="card">
                        <form method="post" action="{{ url('/absen/masuk/'.$skid) }}" class="p-4">
                            @method('put')
                            @csrf
                            <div class="form-row">
                                <div class="col"></div>
                                <div class="col">
                                    <center>
                                        <h2>Absen Masuk : </h2>
                                        <div class="webcam" id="results"></div>
                                        @if ($lock_location == null)
                                            <div class="form-group">
                                                <label for="keterangan_masuk">Keterangan Masuk</label>
                                                <textarea type="text" class="form-control @error('keterangan_masuk') is-invalid @enderror" id="keterangan_masuk" name="keterangan_masuk">{{ old('keterangan_masuk') }}</textarea>
                                                @error('keterangan_masuk')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        @endif
                                    </center>
                                </div>
                                <div class="col">
                                    <input type="hidden" name="jam_absen">
                                    <input type="hidden" name="foto_jam_absen" class="image-tag">
                                    <input type="hidden" name="lat_absen" id="lat">
                                    <input type="hidden" name="long_absen" id="long">
                                    <input type="hidden" name="telat">
                                    <input type="hidden" name="jarak_masuk">
                                    <input type="hidden" name="status_absen">
                                </div>
                            </div>
                            <center>
                                <button type="submit" class="btn btn-primary" value="Ambil Foto" onClick="take_snapshot()">Masuk</button>
                            </center>
                            </form>
                    </div>
                </div>

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
                    // take snapshot and get image data
                    Webcam.snap( function(data_uri) {
                            $(".image-tag").val(data_uri);
                    // display results in page
                    document.getElementById('results').innerHTML =
                        '<img src="'+data_uri+'"/>';
                    } );
                }
                </script>

            @elseif($skjampul == null)
                <br>
                <div class="col-lg-12">
                    <div class="card">
                        <form method="post" class="p-4" action="{{ url('/absen/pulang/'.$skid) }}">
                            @method('put')
                            @csrf
                            <div class="form-row">
                                <div class="col"></div>
                                <div class="col">
                                    <center>
                                        <h2>Absen Pulang : </h2>
                                        <div class="webcam" id="results"></div>
                                        @if ($lock_location == null)
                                            <div class="form-group">
                                                <label for="keterangan_pulang">Keterangan Pulang</label>
                                                <textarea type="text" class="form-control @error('keterangan_pulang') is-invalid @enderror" id="keterangan_pulang" name="keterangan_pulang">{{ old('keterangan_pulang') }}</textarea>
                                                @error('keterangan_pulang')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        @endif
                                    </center>
                                </div>
                                <div class="col">
                                    <input type="hidden" name="jam_pulang">
                                    <input type="hidden" name="foto_jam_pulang" class="image-tag">
                                    <input type="hidden" name="lat_pulang" id="lat">
                                    <input type="hidden" name="long_pulang" id="long">
                                    <input type="hidden" name="pulang_cepat">
                                    <input type="hidden" name="jarak_pulang">
                                </div>
                            </div>
                            <center>
                                <button type="submit" class="btn btn-primary" value="Ambil Foto" onClick="take_snapshot()">Pulang</button>
                            </center>
                        </form>
                    </div>
                </div>

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
                    // take snapshot and get image data
                    Webcam.snap( function(data_uri) {
                            $(".image-tag").val(data_uri);
                    // display results in page
                    document.getElementById('results').innerHTML =
                        '<img src="'+data_uri+'"/>';
                    } );
                }
                </script>
            @else
                <br>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="p-4">
                            <center>
                                <h2>Anda Sudah Selesai Absen</h2>
                            </center>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
@endsection
