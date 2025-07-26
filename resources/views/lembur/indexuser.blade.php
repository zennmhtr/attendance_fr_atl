@extends('templates.app')
@section('container')

    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="inner-left d-flex justify-content-between align-items-center">
                        <span>Tanggal</span>
                    </div>
                    <span>{{ date('Y-m-d') }}</span>
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
        @if (!$lembur)
            <form method="post" action="{{ url('/lembur/masuk') }}">
                @csrf
                <div class="tf-container">
                    <center>
                        <h2>Masuk Lembur: </h2>
                        <div class="webcam" id="results"></div>
                    </center>
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="tanggal" value="{{ date('Y-m-d') }}">
                            <input type="hidden" name="jam_masuk" value="{{ date('Y-m-d H:i') }}">
                            <input type="hidden" name="lat_masuk" id="lat">
                            <input type="hidden" name="long_masuk" id="long">
                            <input type="hidden" name="jarak_masuk">
                            <input type="hidden" name="status" value="Pending">
                            <input type="hidden" name="foto_jam_masuk" class="image-tag">
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
                width: 310,
                height: 420,
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
        @elseif($lembur && $lembur->jam_keluar == null)
            <form method="post" action="{{ url('/lembur/pulang/'.$lembur->id) }}">
                @method('PUT')
                @csrf
                <div class="tf-container">
                    <center>
                        <h2>Pulang Lembur: </h2>
                        <div class="webcam" id="results"></div>
                    </center>
                            <input type="hidden" name="jam_keluar" value="{{ date('Y-m-d H:i') }}">
                            <input type="hidden" name="lat_keluar" id="lat">
                            <input type="hidden" name="long_keluar" id="long">
                            <input type="hidden" name="jarak_keluar">
                            <input type="hidden" name="foto_jam_keluar" class="image-tag">
                            <input type="hidden" name="total_lembur">
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
                width: 310,
                height: 420,
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
                    <h2>Anda Sudah Selesai Lembur Hari Ini</h2>
            </center>
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