@extends('templates.app')
@section('container')
    @php
        $lat_kantor = $data_user->Lokasi->lat_kantor;
        $long_kantor = $data_user->Lokasi->long_kantor;
        $radius = $data_user->Lokasi->radius;
    @endphp

    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <h3 class="mb-4 text-gray-800">{{ $lat }}, {{ $long }}</h3>
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
    <br>
    <br>
    <br>
    <br>
@endsection
