@extends('templates.dashboard')
@section('isi')
    @php
        $lat_kantor = $data_user->Lokasi->lat_kantor;
        $long_kantor = $data_user->Lokasi->long_kantor;
        $radius = $data_user->Lokasi->radius;
    @endphp
    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 p-0 d-flex mt-2">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="col-md-6 p-0">                    
                        <a href="{{ url()->previous() }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                   <h1 class="h3 mb-2 text-gray-800">{{ $lat }}, {{ $long }}</h1>
               </div>
                <div class="card-body">
                   <div id="map" style="width:100%;height:600px;"></div>
                   <script>
                       var map = L.map('map').setView([{{ $lat }}, {{ $long }}], 18);
                       L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                       maxZoom: 19,
                       attribution: '© OpenStreetMap'
                       }).addTo(map);
                       var marker = L.marker([{{ $lat }}, {{ $long }}]).addTo(map);
                       var circle = L.circle([{{ $lat_kantor }}, {{ $long_kantor }}], {
                       color: 'red',
                       fillColor: '#f03',
                       fillOpacity: 0.5,
                       radius: {{ $radius }}
                       }).addTo(map);
    
                       marker.bindPopup("<b>Lokasi Saya</b>").openPopup();
                       circle.bindPopup("<b>Radius {{ $data_user->Lokasi->nama_lokasi ?? '' }}</b>");
                   </script>
    
                </div>
            </div>
        </div>
    </div>
@endsection
