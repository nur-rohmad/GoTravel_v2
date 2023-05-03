@extends('layout.pelanggan')
@section('main')
      <!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Booking</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Booking</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<div class="row">
    <div class="col-md-7">
        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title">Item Open Trip </h3>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <img class="avatar-xxl br-7" src="{{ asset('storage/'. $openTrip->poster) }}" alt="img">
                    <div class="ms-3">
                        <h4 class="mb-1 fw-semibold fs-14"><a href="shop-description.html">{{ $openTrip->title}}</a></h4>
                        <div class="text-warning fs-14 mb-2">
                            <span class="badge rounded-pill bg-success badge-sm me-2 py-1"> <i class="fa fa-user me-1"></i> {{
                                $openTrip->sisa_kuota }} orang </span>
                            <span class="badge rounded-pill bg-primary badge-sm py-1"> <i
                                    class="fa fa-calendar-check-o me-1"></i>
                                {{
                                date("d M Y H:i", strtotime($openTrip->tgl_berangkat)) }} </span>
                        </div>
                        {!! $openTrip->deskripsi !!}
                            <div class="handle-counter" id="handleCounter1">
                                <button type="button" class="counter-minus btn btn-white lh-2 shadow-none" >
                                    <i class="fa fa-minus text-muted"></i>
                                </button>
                                <input type="text" value="1" class="qty" name="jumlah_booking">
                                <button type="button" class="counter-plus btn btn-white lh-2 shadow-none">
                                    <i class="fa fa-plus text-muted"></i>
                                </button>
                            </div>
                        </div>
                    <div class="ms-auto">
                        <span class="fs-16 fw-semibold">{{ number_format($openTrip->harga) }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- metodew pembayaran --}}
        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title">Metode Pembayran</h3>
            </div>
            <div class="card-body"></div>
        </div>
    </div>
    <div class="col-md-5"></div>
</div>
@endsection
@section('addscript')
       <!-- Handle Counter js -->
       <script src="/assets/js/handlecounter.js"></script>
@endsection