@extends('layout.admin')
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
    <div class="col-sm-6 col-lg-6 col-md-12 col-xl-3">
        <div class="card">
            <div class="row">
                <div class="col-4">
                    <div
                        class="card-img-absolute circle-icon bg-primary text-center align-self-center box-primary-shadow bradius">
                        <img src="/assets/images/circle.svg" alt="img" class="card-img-absolute">
                        <i class="lnr lnr-user fs-30  text-white mt-4"></i>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card-body p-4">
                        <h2 class="mb-2 fw-normal mt-2">{{ $jumlahUser }}</h2>
                        <h5 class="fw-normal mb-0">Total Pelanggan</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-6 col-md-12 col-xl-3">
        <div class="card">
            <div class="row">
                <div class="col-4">
                    <div
                        class="card-img-absolute circle-icon bg-info text-center align-self-center box-info-shadow bradius">
                        <img src="/assets/images/circle.svg" alt="img" class="card-img-absolute">
                        <i class="fas fa-umbrella-beach fa-2x text-white mt-4"></i>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card-body p-4">
                        <h2 class="mb-2 fw-normal mt-2">{{ $jumlahWisata }}</h2>
                        <h5 class="fw-normal mb-0">Total Wisata</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-6 col-md-12 col-xl-3">
        <div class="card">
            <div class="row">
                <div class="col-4">
                    <div
                        class="card-img-absolute circle-icon bg-success text-center align-self-center box-success-shadow bradius">
                        <img src="/assets/images/circle.svg" alt="img" class="card-img-absolute">
                        <i class="fas fa-plane-departure fa-2x text-white mt-4"></i>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card-body p-4">
                        <h2 class="mb-2 fw-normal mt-2">{{ $jumlahOpenTrip }}</h2>
                        <h5 class="fw-normal mb-0">Total Open Trip</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-6 col-md-12 col-xl-3">
        <div class="card">
            <div class="row">
                <div class="col-4">
                    <div
                        class="card-img-absolute circle-icon bg-warning text-center align-self-center box-warning-shadow bradius">
                        <img src="/assets/images/circle.svg" alt="img" class="card-img-absolute">
                        <i class="fas fa-hand-holding-usd fa-2x text-white mt-4"></i>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card-body py-4">
                        <h5 class="mb-2 fw-normal mt-2 fw-bold">{{ number_format($pendapatanInMounth) }}</h5>
                        <h6 class="fw-normal mb-0">Pendapatan {{ date('M Y') }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- chart --}}
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Grafik Pendapatan Tahun {{ date("Y") }}</h3>
            </div>
            <div class="card-body">
                <div id="grafikPendapatan" class="none"></div>
            </div>
        </div>
    </div>
    {{-- card booking unpaid --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Booking Menunggu Pembayaran</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Booking</th>
                                <th>Nama Pemesan</th>
                                <th>Jumlah Bayar</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($bookingUnpaid as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td class="text-center">{{ number_format($item->invoice->amount) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Data Tidak Ditemukan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- best seller --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Open Trip Terlaris</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Open Trip</th>
                                <th class="text-center">Jumlah Booking</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($openTripBestselling as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td><a href="/admin/open-trip/show/{{ $item->open_trip->slug }}">{{
                                        $item->open_trip->title }}</a>
                                </td>
                                <td class="text-center">{{ $item->jumlah }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">Data Tidak Ditemukan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Row -->
@endsection
@section('addscript')
<script src="/assets/js/apexcharts.js"></script>
<script>
    $.ajax({
    url: "/admin/get-grafik",
    dataType: "json",
    success: (res) => {
        console.log(res)
    // var data = JSON.parse(res)
    var options = {
    series: [{
    data: res.pendapatan,
    name: 'Pendapatan',
    }],
    chart: {
    height: 350,
    type: 'line',
    dropShadow: {
    enabled: true,
    color: '#000',
    top: 18,
    left: 7,
    blur: 10,
    opacity: 0.2
    },
    toolbar: {
    show: true
    }
    },
    markers: {
    size: 1
    },
    colors: ['#fc0335', '#545454'],
    dataLabels: {
    enabled: true,
    },
    stroke: {
    stroke: {
    width: [0, 4]
    },
    },
    xaxis: {
    categories: res.bulan,
    title: {
    text: 'Bulan Pendapatan',
    },
    },
    yaxis: [{
    title: {
    text: 'Jumlah Pendapatan',
    },
    }]
    }
    
    var chart = new ApexCharts(document.getElementById('grafikPendapatan'), options);
    chart.render();
    },
    error: (err) => {
    console.log(err);
    },
    });


    
</script>
@endsection