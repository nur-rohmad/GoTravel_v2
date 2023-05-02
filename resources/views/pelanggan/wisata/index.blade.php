@extends('layout.pelanggan')
@section('addcss')
<link rel="stylesheet" href="/assets/plugins/leaflet-routing-machine/dist/leaflet-routing-machine.css">
@endsection
@section('main')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Wisata</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">wisata</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<!-- ROW-1 OPEN -->
<!-- Row -->
<div class="row row-cards">
    {{-- kiri --}}
    <div class="col-xl-3 col-lg-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Kota Tujuan</div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($kota_wisata as $item)
                            <li class="list-group-item border-0 p-0 {{ Request::get('kota') == $item->kota ? 'active' : '' }}"> <a href="/pelanggan/wisata?kota={{ $item->kota }}"><i
                                        class="fe fe-chevron-right"></i>
                                    {{ $item->kota }} </a> </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- kanan --}}
    <div class="col-xl-9 col-lg-8">
        <div class="row">
            <div class="col-xl-12">
                <div class="card p-0">
                    <div class="card-body p-4">
                        <div class="row">
                            <form action="/pelanggan/wisata" method="GET">
                            <div class="col-md-5">
                                <div class="input-group d-flex w-100 float-start">
                                    <input type="text" class="form-control border-end-0 my-2" name="search" placeholder="Nama Wisata" value="{{ Request::get('search') }}">
                                    <button class="btn input-group-text bg-success  my-2">
                                        <i class="fe fe-search " aria-hidden="true"></i>
                                    </button>
                                    <a href="/pelanggan/wisata" class="btn input-group-text bg-danger  my-2">
                                        <i class="fa fa-undo " aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse ($wisata as $item)
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="row g-0">
                            <div class="col-xl-3 col-lg-12 col-md-12">
                                <div class="product-list">
                                    <div class="br-be-0 br-te-0">
                                        <a href="shop-description.html" class="">
                                            <img src="{{ asset('storage/'. $item->image) }}" alt="img"
                                                class="cover-image br-7 w-100">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-12 border-end my-auto">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <h3 class="fw-bold fs-30 mb-3 text-info">{{ $item->nama_wisata }}</h3>
                                        <div class="mb-2">
                                            <span class="badge rounded-pill bg-success badge-sm me-2"> <i
                                                    class="fa fa-building me-1"></i> {{
                                                $item->kota }} </span>
                                        </div>
                                        {!! $item->deskripsi !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-12 col-md-12 my-auto">
                                <div class="card-body p-0">
                                    <button
                                        onclick="ShowDirection('{{ $item->location->latitude }}', '{{ $item->location->longitude }}')"
                                        class="btn btn-primary btn-block"><i class="fa fa-map mx-2"></i>Lihat Lokasi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card overflow-hidden">
                    <div class="card-body text-center">
                        <i class="fa fa-folder-open fa-3x" ></i> <h4>Data tidak ditemukan</h4>
                    </div>
                </div>
            </div>
            @endforelse
            <div class="mb-5">
                <div class="float-end">
                    {{ $wisata->appends(request()->except('page'))->links() }}
                </div>
            </div>
        </div>
        <!-- COL-END -->
    </div>
</div>
<!-- /Row -->

{{-- modal map --}}
<div class="modal fade effect-rotate-bottom" id="modal-location">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Lokasi wisata <span id="nama-wisata"></span></h6><button aria-label="Close"
                    class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" id="modal-body">

            </div>
            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
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
    function ShowDirection(latitude, longitude){

            // create canva
            $('#modal-body').append( `<div class="ht-300" id="leaflet2" style="height: 400px;"></div>`)
            $('#modal-body').append(`<button class="btn btn-success mt-2"  id="getRoute"> <i class="ion ion-navigate mx-2"></i> Lihat rute </button>`)
            // inisialisasi map
            var peta = L.map('leaflet2').setView([latitude, longitude],13);
            setTimeout(function(){ peta.invalidateSize()}, 400);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(peta);
            L.marker([latitude, longitude]).addTo(peta)
            $('#getRoute').click(() => {  
                let user_latitude = null
                let user_longitude = null
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition((location) => {
                        user_latitude = location.coords.latitude
                        user_longitude = location.coords.longitude
                        L.Routing.control({
                        waypoints: [
                            L.latLng(user_latitude ,user_longitude),
                            L.latLng(latitude, longitude)
                        ],
                        routeWhileDragging: true,
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
            })
    
            // tampilkan modal
            $('#modal-location').modal('show');
    }
    // remove canva map saat modal tertutup
    $('#modal-location').on('hide.bs.modal', function(){
         $('#leaflet2').remove()
         $('#getRoute').remove()
    })

</script>
@endsection