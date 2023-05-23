@extends('layout.pelanggan')
@section('main')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<!-- ROW-1 OPEN -->
<!-- Row -->
<div class="row ">
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
        <div class="card bg-primary img-card box-primary-shadow">
            <div class="card-body">
                <div class="d-flex">
                    <div class="text-white">
                        <h2 class="mb-0 number-font">{{ $data['booking'] }}</h2>
                        <p class="text-white mb-0">Terbooking </p>
                    </div>
                    <div class="ms-auto"> <i class="fas fa-calendar-check text-white fs-30 me-2 mt-2"></i> </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
        <div class="card bg-success img-card box-success-shadow">
            <div class="card-body">
                <div class="d-flex">
                    <div class="text-white">
                        <h2 class="mb-0 number-font">{{ $data['jumlah_openTrip'] }}</h2>
                        <p class="text-white mb-0">Total open trip </p>
                    </div>
                    <div class="ms-auto"> <i class="fas fa-suitcase-rolling text-white fs-30 me-2 mt-2"></i> </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
        <div class="card bg-warning img-card box-warning-shadow">
            <div class="card-body">
                <div class="d-flex">
                    <div class="text-white">
                        <h2 class="mb-0 number-font">{{ $data['jumlah_wisata'] }}</h2>
                        <p class="text-white mb-0">Total Wisata </p>
                    </div>
                    <div class="ms-auto"> <i class="fas fa-umbrella-beach text-white fs-30 me-2 mt-2"></i> </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Postingan Wisata terbaru</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($data['wisata_lastest'] as $item)
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="card ribbone-card overflow-hidden">
                            <img src="{{ asset('storage/'. $item->image) }}" class="card-img-top" height="200px"
                                alt="img">
                            <div class="card-body">
                                <div class="arrow-ribbone-left bg-teal">
                                    <i class="fa fa-building ml-2"></i> {{ $item->kota }}
                                </div>
                                <div class="mt-4">
                                    <h5 class="card-title"><a href="/pelanggan/wisata/{{ $item->id }}">{{
                                            $item->nama_wisata
                                            }}</a></h5>
                                    <p class="card-text ">{{ substr(strip_tags($item->deskripsi),0, 70) }}...</p>
                                    <a href="/pelanggan/wisata/{{ $item->id }}" class="">Lihat lainnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">open trip terlaris</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($data['bestselling_opentrip'] as $item)
                    <div class="col-xl-6 col-md-6 col-sm-12">
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
                                <p class="card-text ">{{ substr(strip_tags($item->deskripsi),0, 20) }}...</p>
                            </div>
                            <div class="card-footer text-center">
                                <a class="btn btn-primary w-100 my-2"
                                    href="/pelanggan/booking/{{ $item->slug }}">Booking <i
                                        class="fa fa-arrow-right ms-2"></i></a>
                                <a class="btn btn-light w-100 my-2" href="/pelanggan/open-trip/{{ $item->slug }}">
                                    Detail <i class="fe fe-search ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tanggal Open Trip Terbooking</h3>
            </div>
            <div class="card-body">
                <div id='calendar2'></div>
            </div>
        </div>
    </div>
</div>
<!-- /Row -->
@endsection
@section('addscript')
<!-- FULL CALENDAR JS -->
<script src='/assets/plugins/fullcalendar/moment.min.js'></script>
<script src='/assets/plugins/fullcalendar/fullcalendar.min.js'></script>
<script src="/assets/js/fullcalendar.js"></script>
@endsection