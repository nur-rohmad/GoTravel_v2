@extends('layout.pelanggan')
@section('addcss')
<link rel="stylesheet" href="/assets/plugins/leaflet-routing-machine/dist/leaflet-routing-machine.css">
@endsection
@section('main')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Open Trip</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Open Trip</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<!-- ROW-1 OPEN -->
<!-- Row -->
<div class="row row-cards">
    <div class="col-12">
        <div class="row">
            <div class="col-xl-12">
                <div class="card p-0">
                    <div class="card-body p-4">
                        <form action="/pelanggan/open-trip" method="GET">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control  my-2" name="search"
                                            placeholder="Open Trip" value="{{ Request::get('search') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="date" name="tgl_berangkat" class="form-control my-2"
                                            placeholder="Tanggal Berangkat" value="{{ Request::get('tgl_berangkat') }}">
                                    </div>
                                </div>
                                <div class=" col-md-2">
                                    <button class="btn btn-success   my-2">
                                        <i class="fe fe-search " aria-hidden="true"></i>
                                    </button>
                                    <a href="/pelanggan/open-trip" class="btn btn-outline-dark  my-2">
                                        <i class="fa fa-undo " aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse ($openTrip as $item)
            <div class="col-xl-3 col-md-6 col-sm-12">
                <div class="card ribbone-card overflow-hidden">
                    <img src="{{ asset('storage/'. $item->poster) }}" class="card-img-top border" height="200px"
                        alt="img">
                    <div class="card-body">
                        <h5 class="card-title"><a href="/pelanggan/open-trip/{{ $item->slug }}">{{ $item->title
                                }}</a></h5>
                        <span class="text-muted"> <i class="ion-calendar me-3"></i> {{ date("d M Y",
                            strtotime($item->tgl_berangkat)) }} </span>
                        <span class="text-muted float-end"> <i class="ion-clock me-3"></i> {{ date("H:i",
                            strtotime($item->tgl_berangkat)) }} </span>
                        <p class="text-muted mt-2"> <i class="ion-person me-3"></i> {{ $item->sisa_kuota }}
                        </p>
                        <p class="card-text ">{{ substr(strip_tags($item->deskripsi),0, 150) }}...</p>
                    </div>
                    <div class="card-footer text-center">
                        <a class="btn btn-primary w-100 my-2" href="/pelanggan/booking/{{ $item->slug }}">Booking <i
                                class="fa fa-arrow-right ms-2"></i></a>
                        <a class="btn btn-light w-100 my-2" href="/pelanggan/open-trip/{{ $item->slug }}">
                            Detail <i class="fe fe-search ms-2"></i></a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card overflow-hidden">
                    <div class="card-body text-center">
                        <i class="fa fa-folder-open fa-3x"></i>
                        <h4>Data tidak ditemukan</h4>
                    </div>
                </div>
            </div>
            @endforelse
            <div class="mb-5">
                <div class="float-end">
                    {{ $openTrip->appends(request()->except('page'))->links() }}
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
                <h6 class="modal-title">Lokasi Penjemputan <span id="nama-wisata"></span></h6><button aria-label="Close"
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
{{-- modal detail lokasi --}}
<div class="modal fade effect-rotate-bottom" id="modal-detail-lokasi">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Lokasi Yang dikunjungi <span id="nama-wisata"></span></h6><button
                    aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" id="modal-body-detail-lokasi">

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
    function ShowLocation(latitude, longitude){

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
    // show detail lokasi tujuan
    function showDetailLokasi(lokasi)
    {
        const detail_lokasi = lokasi.map((item)=>{

            return `<div class="col-xl-12 col-lg-12 col-md-12" id="detail-wisata">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="row g-0">
                            <div class="col-xl-3 col-lg-12 col-md-12">
                                <div class="product-list">
                                    <div class="br-be-0 br-te-0">
                                        <a href="shop-description.html" class="">
                                            <img src="/storage/${item.image}" alt="img"
                                                class="cover-image br-7 w-100">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-12 col-md-12 border-end my-auto">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <h3 class="fw-bold fs-30 mb-3 text-info"> ${item.nama_wisata}</h3>
                                        <div class="mb-2">
                                            <span class="badge rounded-pill bg-success badge-sm me-2"> <i
                                                    class="fa fa-building me-1"></i> 
                                                ${item.kota}  </span>
                                        </div>
                                         ${item.deskripsi}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`
        })

        $('#modal-body-detail-lokasi').html(detail_lokasi);
        $('#modal-detail-lokasi').modal('show')
    }

    $('#modal-detail-lokasi').on('hide.bs.modal', function(){
        $('#detail-wisata').remove()
    })

</script>
@endsection