@extends('layout.pelanggan')
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
                    <p class="text-muted fs-16  me-2"> <i
                            class="fa fa-user me-1 p-3 fe-16 bg-secondary-transparent text-secondary bradius"></i> {{
                        $openTrip->sisa_kuota }} orang </p>
                    <span class="text-muted fs-16"> <i
                            class="ion ion-calendar me-1 p-3 fe-16 bg-primary-transparent text-primary bradius"></i>
                        {{
                        date("d M Y", strtotime($openTrip->tgl_berangkat)) }} </span>
                    <span class="text-muted fs-16 ms-5"> <i
                            class="fe fe-clock me-1 p-3 fe-16 bg-success-transparent text-success bradius"></i>
                        {{
                        date("H:i", strtotime($openTrip->tgl_berangkat)) }} </span>

                    <h4 class="mt-4" style="margin-top: 2em!important"><span class="me-2 fw-bold fs-26"> <i
                                class="me-1 p-3  bg-danger-transparent text-danger bradius">Rp</i> {{
                            number_format($openTrip->harga)
                            }} </h4>
                    <a class="btn btn-outline-success float-end" href="/pelanggan/booking/{{ $openTrip->slug }}">Booking
                        <i class="fa fa-arrow-right ms-2"></i></a>
                    <a class="btn btn-danger float-end me-2" href="/pelanggan/open-trip"><i
                            class="fa fa-arrow-left me-2"></i>Kembali</a>
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
                            <li><a href="#deskripsi" class="active" data-bs-toggle="tab">Deskripsi</a></li>
                            <li><a href="#wisataTujuan" data-bs-toggle="tab">Wisata Tujuan</a></li>
                            <li><a href="#titikKumpul"
                                    onclick="showMap({{ $openTrip->lokasi_penjemputan->latitude }}, {{ $openTrip->lokasi_penjemputan->longitude }})"
                                    data-bs-toggle="tab">Titik Kumpul</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="deskripsi">
                            {!! $openTrip->deskripsi !!}
                        </div>
                        <div class="tab-pane " id="wisataTujuan">
                            <!-- ACCORDION BEGIN -->
                            <ul class="demo-accordion accordionjs m-0" data-bs-active-index="false">
                                @foreach ($openTrip->lokasi_tujuan as $lokasi)
                                <li>
                                    <div>
                                        <h3>{{ $lokasi->nama_wisata }}</h3>
                                    </div>
                                    <div>
                                        <div class="card">
                                            <img class="card-img-top " src="{{ asset('storage/'. $lokasi->image) }}"
                                                alt="Card image cap" height="300px">
                                            <div class="card-body">
                                                <div class="d-md-flex">
                                                    <a href="javascript:void(0);" class="d-flex me-4 mb-2"><i
                                                            class="fa fa-building fs-16 me-1 p-3 bg-secondary-transparent text-secondary bradius"></i>
                                                        <div class="mt-0 mt-3 ms-1 text-muted font-weight-semibold">
                                                            {{ $lokasi->kota }}</div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                {!! $lokasi->deskripsi !!}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="tab-pane " id="titikKumpul">

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

{{-- accordion --}}
<!-- ACCORDION JS -->
<script src="/assets/plugins/accordion/accordion.min.js"></script>
<script src="/assets/plugins/accordion/accordion.js"></script>

<script>
    function showMap(latitude, longitude) {
                if ($('#leaflet2').length <= 0) {
                    $('#titikKumpul').append('<button class="btn btn-success mb-2" id="getRoute">Lihat rute </button>')
                    $('#titikKumpul').append('<div class="ht-300" id="leaflet2" style="height: 400px;"></div>')
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