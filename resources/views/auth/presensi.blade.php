@extends('templates.login')
@section('container')
  @push('style')
    <style>
      canvas {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
      }
    </style>
  @endpush
  <h1>{{ $title }}</h1>
  <video id="video" autoplay playsinline class="col-lg-12 col-md-12 col-sm-12 mx-auto"></video>
  <input type="hidden" name="lat" id="lat">
  <input type="hidden" name="long" id="long">
  <a href="{{ url('/') }}" class="tf-btn accent large"><i class="fas fa-arrow-left mr-2"></i>Back</a>
  @push('script')
    <script src="{{ url('/face/dist/face-api.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        let faceMatcher = undefined;
        let video = document.getElementById("video");
        let canvas = document.createElement("canvas");
        let ctx = canvas.getContext("2d");
        document.body.appendChild(canvas);  // Pastikan kanvas ditambahkan ke DOM

        let width = 320;  // Resolusi lebih rendah untuk kinerja lebih baik
        let height = 240;

        const startStream = async () => {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: { facingMode: "user", width, height },
                    audio: false
                });
                video.srcObject = stream;
            } catch (error) {
                console.error('Error accessing camera:', error);
            }
        }

        // Memuat model yang diperlukan
        Promise.all([
            faceapi.nets.tinyFaceDetector.loadFromUri("{{ url('/face/weights') }}"),
            faceapi.nets.faceLandmark68Net.loadFromUri("{{ url('/face/weights') }}"),
            faceapi.nets.faceRecognitionNet.loadFromUri("{{ url('/face/weights') }}")
        ]).then(startStream);

        video.onloadedmetadata = () => {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            start();
        };

        async function start() {
            Swal.fire({
                title: 'Loading...',
                text: 'Loading face data, please wait.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Mengambil data neural untuk menciptakan faceMatcher
            $.ajax({
                datatype: 'json',
                url: "{{ url('/ajaxGetNeural') }}",
                data: ""
            }).done(async function(data) {
                if (data.length > 2) {
                    var json_str = "{\"parent\":" + data + "}"
                    var content = JSON.parse(json_str);
                    for (let x = 0; x < content.parent.length; x++) {
                        for (let y = 0; y < content.parent[x].descriptors.length; y++) {
                            let results = Object.values(content.parent[x].descriptors[y])
                            content.parent[x].descriptors[y] = new Float32Array(results)
                        }
                    }
                    faceMatcher = await createFaceMatcher(content);
                    onPlay();
                }
            });
        }

        async function createFaceMatcher(data) {
            const labeledFaceDescriptors = await Promise.all(data.parent.map(className => {
                return new faceapi.LabeledFaceDescriptors(
                    className.label,
                    className.descriptors.map(d => new Float32Array(d))
                );
            }));
            return new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6);
        }

        async function onPlay() {
            if (faceMatcher) {
                const displaySize = { width: video.videoWidth, height: video.videoHeight };
                faceapi.matchDimensions(canvas, displaySize);

                const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
                    .withFaceLandmarks()
                    .withFaceDescriptors();
                const resizedDetections = faceapi.resizeResults(detections, displaySize);
                const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor));

                ctx.clearRect(0, 0, canvas.width, canvas.height);

                results.forEach((result, i) => {
                    const box = resizedDetections[i].detection.box;
                    const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() });
                    drawBox.draw(canvas);

                    let label = result.label;
                    let distance = result.distance;
                    Swal.close()
                    if (label !== "unknown" && distance < 0.5) {
                        let imageURL = canvas.toDataURL();
                        var canvas2 = document.createElement('canvas');
                        canvas2.width = 600;
                        canvas2.height = 600;
                        var ctx = canvas2.getContext('2d');
                        ctx.drawImage(video, 0, 0, 600, 600);
                        var new_image_url = canvas2.toDataURL();
                        var img = document.createElement('img');
                        img.src = new_image_url;
                        let lat = $('#lat').val();
                        let long = $('#long').val();
                        $.ajax({
                            type: 'POST',
                            url: "{{ url('/presensi/store') }}",
                            data: { username: label, image: img.src, lat: lat, long:long },
                            cache: false,
                            success: function(msg) {
                                let message = '';
                                switch (msg) {
                                    case 'masuk':
                                        message = 'Berhasil Masuk';
                                        break;
                                    case 'outlocation':
                                        message = 'Anda Berada Di Luar Radius Kantor';
                                        break;
                                    case 'selesai':
                                        message = 'Anda Sudah Selesai Absen Masuk Hari Ini';
                                        break;
                                    case 'noMs':
                                        message = 'Hubungi Admin Untuk Input Shift Anda';
                                        break;
                                    default:
                                        message = 'Tidak Ada Data User';
                                }
                                Swal.fire(message, '', msg === 'masuk' ? 'success' : 'error');
                                setTimeout(() => Swal.close(), 2000);
                            },
                            error: function(data) {
                                console.error('Error:', data);
                            }
                        });
                    }
                });
            }

            setTimeout(() => onPlay(), 5000); // Interval untuk deteksi ulang setiap 5 detik
        }
    </script>
  @endpush
@endsection
