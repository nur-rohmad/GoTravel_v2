@extends('layout.admin')
@section('addcss')
<link rel="stylesheet" href="/assets/plugins/leaflet-routing-machine/dist/leaflet-routing-machine.css">
@endsection
@section('main')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Detail Open Trip</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="/admin">Admin</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/admin">Open Trip</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $openTrip->title }}</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<div class="container-fluid">
    <div class="card show">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('storage/'.$openTrip->poster) }}" alt="poster">
                </div>
                <div class="col-md-8">
                    <h3 class="fw-semibold">{{ $openTrip->title }}</h3>
                    <div class="d-flex flex-row" style="margin-top: -8px">
                        <span class="badge rounded-pill bg-success badge-sm me-2"> <i class="fa fa-user me-1"></i> {{
                            $openTrip->jumlah_peserta }} orang </span>
                        <span class="badge rounded-pill bg-primary badge-sm"> <i
                                class="fa fa-calendar-check-o me-1"></i>
                            {{
                            date("d M Y H:i", strtotime($openTrip->tgl_berangkat)) }} </span>
                    </div>
                    <h4 class="mt-4"><b> Deshripsi</b></h4>
                    <div class="">
                        {!! $openTrip->deskripsi !!}
                    </div>
                    <h4 class="mb-4"><span class="me-2 fw-bold fs-25 d-inline-flex"> {{
                            number_format($openTrip->harga)
                            }} </h4>
                </div>
            </div>
        </div>
    </div>

    <div class="card show">
        <div class="card-body">
            <div class="panel panel-primary">
                <div class="tab-menu-heading">
                    <div class="tabs-menu1">
                        <ul class="nav panel-tabs">
                            <li><a href="#wisataTujuan" class="active" data-bs-toggle="tab">Wisata Tujuan</a></li>
                            <li><a href="#titikKumpul"
                                    onclick="showMap({{ $openTrip->lokasi_penjemputan->latitude }}, {{ $openTrip->lokasi_penjemputan->longitude }})"
                                    data-bs-toggle="tab">Titik Kumpul</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="wisataTujuan">
                            @foreach ($openTrip->lokasi_tujuan as $lokasi)
                            <div class="row g-0 py-3">
                                <div class="col-md-2">
                                    <img src="{{ asset('storage/'.$lokasi->image) }}" class="card-img-left h-100"
                                        alt="img" width="200px">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title" style="margin-bottom: 5px!important">{{
                                            $lokasi->nama_wisata }}</h5>
                                        <span class="badge rounded-pill bg-primary badge-sm mb-4"> <i
                                                class="fa fa-building me-1 text-white"></i> {{
                                            $lokasi->kota }} </span>
                                        {!! $lokasi->deskripsi !!}
                                        <p class="card-text"><small class="text-muted">Last updated : {{ date("d M Y
                                                H:i",
                                                strtotime($lokasi->updated_at)) }}</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="tab-pane active" id="titikKumpul">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('addscript')
<!-- INTERNAL leaflet js -->
<script src="/assets/plugins/leaflet/leaflet.js"></script>
<script src="/assets/plugins/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

<script>
    function showMap(latitude, longitude) {
                if ($('#leaflet2').length <= 0) {
                    $('#titikKumpul').append('<button class="btn btn-success mb-2" id="getRoute">Lihat rute </button>')
                    $('#titikKumpul').append('<div class="ht-300" id="leaflet2" style="height: 400px;"></div>')
                }
                // inisialisasi map
                var peta = L.map('leaflet2').setView([latitude, longitude], 13);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(peta);
                L.marker([latitude, longitude]).addTo(peta)
                // .bindPopup(nama_wisata)
                $('#getRoute').click(() => {
                    // get location user
                    let user_latitude = null
                    let user_longitude = null
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition((location) => {
                            user_latitude = location.coords.latitude
                            user_longitude = location.coords.longitude
                            console.log(user_latitude, user_longitude)
                           L.Routing.control({
                            waypoints: [
                                L.latLng(user_latitude ,user_longitude),
                                // L.latLng(-7.4214517 ,111.5110576),
                                L.latLng(latitude, longitude)
                            ],
                           
                            showAlternatives: true,
                            altLineOptions: {
                                styles: [
                                    {color: 'black', opacity: 0.15, weight: 9},
                                    {color: 'white', opacity: 0.8, weight: 6},
                                    {color: 'blue', opacity: 0.5, weight: 2}
                                ]
                            }
                            }).addTo(peta);
                        });
                    } else {
                        x.innerHTML = "Geolocation is not supported by this browser.";
                    }
                    // L.marker([user_latitude, user_longitude]).addTo(peta)
                    
                })

    }

</script>
@endsection