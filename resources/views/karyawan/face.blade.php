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
    @push('style')
        <style>
            canvas {
                position: absolute;
                top: 0;
                left: 0;
                width: 50%;
                height: 50%;
            }
        </style>
    @endpush
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="p-4">
                    <div class="form-group">
                        <label for="name" class="float-left">Nama</label>
                        <input type="text" class="form-control" value="{{ $karyawan->name }}" disabled id="name">
                    </div>
                    <input type="hidden" name="username" id="username" value="{{ $karyawan->username }}">
                    <div class="d-flex justify-content-center align-items-center">
                        <video id="video" autoplay playsinline class="col-lg-6 col-md-6 col-sm-6 mx-auto"></video>
                    </div>
                    <br>
                    <center>
                        <button id="capture" class="btn btn-primary mt-4">Capture Image</button>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
    @push('script')
        <script src="{{ url('/face/dist/face-api.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            let video = document.getElementById("video");
            let width = 640;
            let height = 480;

            const startStream = () => {
                navigator.mediaDevices.getUserMedia({
                    video: { facingMode: "user", width, height },
                    audio: false
                }).then((stream) => {
                    video.srcObject = stream;
                });
            }

            Promise.all([
                faceapi.nets.tinyFaceDetector.loadFromUri("{{ url('/face/weights') }}"),
                faceapi.nets.faceLandmark68Net.loadFromUri("{{ url('/face/weights') }}"),
                faceapi.nets.faceRecognitionNet.loadFromUri("{{ url('/face/weights') }}")
            ]).then(startStream);

            $(document).ready(function(){
                const descriptions = [];

                $("#capture").click(async function(){
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Detecting face, please wait.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });

                    var username = $('#username').val();
                    const label = username;

                    var canvas = document.createElement('canvas');
                    canvas.width = width;
                    canvas.height = height;
                    var context = canvas.getContext('2d');
                    context.drawImage(video, 0, 0, width, height);

                    var img = document.createElement('img');
                    img.src = canvas.toDataURL('image/png');

                    const detections = await faceapi.detectSingleFace(img, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceDescriptor();

                    if(detections) {
                        descriptions.push(detections.descriptor);
                        var descrip = descriptions;

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type : 'POST',
                            url : "{{ url('/pegawai/face/ajaxPhoto') }}",
                            data :  {image: img.src ,path: username},
                            cache : false,
                            success: function(msg){
                                console.log(msg);
                            },
                            error: function(data){
                                console.log('error:', data);
                            }
                        });

                        var postData = new faceapi.LabeledFaceDescriptors(label, descrip);
                        $.ajax({
                            type : 'POST',
                            url : "{{ url('/pegawai/face/ajaxDescrip') }}",
                            data :  { myData: JSON.stringify(postData), user_id:{{ $karyawan->id }} },
                            datatype : 'json',
                            cache : false,
                            success: function(msg){
                                Swal.fire('Berhasil Daftar Wajah!', '', 'success');
                                setTimeout(function() {
                                    window.location.href = "{{ url('/pegawai') }}";
                                }, 2000);
                            },
                            error: function(data){
                                console.log('error:', data);
                            }
                        });
                    } else {
                        Swal.fire('Gagal Deteksi Wajah!', 'Silakan coba lagi.', 'error');
                    }
                });
            });
        </script>
    @endpush
@endsection
