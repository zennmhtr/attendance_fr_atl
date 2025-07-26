@extends('templates.dashboard')
@section('isi')
    <div class="container-fluid">

        <?php
            $cek_lembur = $lembur->count();

            if($cek_lembur > 0) {
                foreach($lembur as $l) {
                    $id = $l->id;
                    $jam_masuk = $l->jam_masuk;
                    $jam_keluar = $l->jam_keluar;
                }
            } else {
                    $id = "";
                    $jam_masuk = "";
                    $jam_keluar = "";
            }
        ?>

        <center>
            <p class="p mb-2 text-gray-800">Tanggal : {{ date('Y-m-d') }}</p>
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

        <br>

        @if($cek_lembur == 0)
            <div class="col-lg-12">
                <div class="card">
                    <form method="post" action="{{ url('/lembur/masuk') }}" class="p-4">
                        @csrf
                        <div class="form-row">
                            <div class="col"></div>
                            <div class="col">
                                <center>
                                    <h2>Masuk Lembur: </h2>
                                    <div class="webcam" id="results"></div>
                                </center>
                            </div>
                            <div class="col">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="tanggal" value="{{ date('Y-m-d') }}">
                                <input type="hidden" name="jam_masuk" value="{{ date('Y-m-d H:i') }}">
                                <input type="hidden" name="lat_masuk" id="lat">
                                <input type="hidden" name="long_masuk" id="long">
                                <input type="hidden" name="jarak_masuk">
                                <input type="hidden" name="status" value="Pending">
                                <input type="hidden" name="foto_jam_masuk" class="image-tag">
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
                    width: 240,
                    height: 320,
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

        @elseif($cek_lembur > 0 && $jam_masuk == true && $jam_keluar == null)
            <div class="col-lg-12">
                <div class="card">
                    <form method="post" action="{{ url('/lembur/pulang/'.$id) }}" class="p-4">
                        @method('put')
                        @csrf
                        <div class="form-row">
                            <div class="col"></div>
                            <div class="col">
                                <center>
                                    <h2>Pulang Lembur: </h2>
                                    <div class="webcam" id="results"></div>
                                </center>
                            </div>
                            <div class="col">
                                <input type="hidden" name="jam_keluar" value="{{ date('Y-m-d H:i') }}">
                                <input type="hidden" name="lat_keluar" id="lat">
                                <input type="hidden" name="long_keluar" id="long">
                                <input type="hidden" name="jarak_keluar">
                                <input type="hidden" name="foto_jam_keluar" class="image-tag">
                                <input type="hidden" name="total_lembur">
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
            width: 240,
            height: 320,
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="p-4">
                        <center>
                            <h2>Anda Sudah Selesai Lembur Hari Ini</h2>
                        </center>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

