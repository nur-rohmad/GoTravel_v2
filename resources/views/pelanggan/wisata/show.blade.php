@extends('layout.pelanggan')
@section('addcss')
<link rel="stylesheet" href="/assets/plugins/leaflet-routing-machine/dist/leaflet-routing-machine.css">
<style>
    .title {
        margin-bottom: -9px !important;
    }

    @media(max-width: 660px) {
        .title {
            margin-bottom: 0px !important;
        }
    }
</style>
@endsection
@section('main')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Detail Wisata</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item " aria-current="page"><a href="">wisata</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $wisata->nama_wisata }}</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="body mx-4 my-4">
                <img src="{{ asset('storage/'. $wisata->image) }}" width="100%" alt="{{ $wisata->nama_wisata }}">
                <h1 class="title text-center">{{ $wisata->nama_wisata }}</h1>
                <div class="panel panel-primary">
                    <div class="tab-menu-heading">
                        <div class="tabs-menu1">
                            <ul class="nav panel-tabs">
                                <li><a href="#deskripsi" class="active" data-bs-toggle="tab">Deskripsi</a></li>
                                <li><a href="#lokasi"
                                        onclick="showMap({{ $wisata->location->latitude }}, {{ $wisata->location->longitude }})"
                                        data-bs-toggle="tab">Lokasi</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body tabs-menu-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="deskripsi">
                                {!! $wisata->deskripsi !!}
                            </div>

                            <div class="tab-pane" id="lokasi">
                            </div>

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
                    $('#lokasi').append('<button class="btn btn-success mb-2" id="getRoute"><i class="ion ion-navigate mx-2"></i> Lihat rute </button>')
                    $('#lokasi').append('<div class="ht-300" id="leaflet2" style="height: 400px;"></div>')
                }
                // inisialisasi map
                var peta = L.map('leaflet2').setView([latitude, longitude], 20);
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